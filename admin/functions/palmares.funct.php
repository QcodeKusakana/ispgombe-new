<?php
$palmaresMessage = null;
$palmaresDepartments = [];
$palmaresSessions = [];
$palmaresLevels = [];
if (!$bdd instanceof PDO) {
    $palmaresMessage = ['type' => 'danger', 'text' => 'Base de données indisponible.'];
} else {
    try {
        $palmaresDepartments = $bdd->query('SELECT d.id, d.titre, f.titre AS section_titre FROM departement d LEFT JOIN faculte f ON f.id = d.faculte ORDER BY f.titre, d.titre')->fetchAll();
        $palmaresSessions = $bdd->query('SELECT id, nom_s FROM sessions ORDER BY id')->fetchAll();
        $palmaresLevels = $bdd->query('SELECT id, titre FROM niveau ORDER BY id')->fetchAll();

        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST' && in_array($_POST['admin_action'] ?? '', ['save_session', 'delete_session', 'save_level', 'delete_level'], true)) {
            if (!csrf_is_valid($_POST['csrf_token'] ?? null)) {
                throw new RuntimeException('Le formulaire a expiré. Rechargez la page.');
            }
            $action = (string) $_POST['admin_action'];
            $isSession = str_ends_with($action, 'session');
            $table = $isSession ? 'sessions' : 'niveau';
            $idColumn = 'id';
            $nameColumn = $isSession ? 'nom_s' : 'titre';
            $label = $isSession ? 'session' : 'niveau';
            $recordId = filter_var($_POST['record_id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
            if (str_starts_with($action, 'save_')) {
                $name = is_string($_POST['name'] ?? null) ? trim($_POST['name']) : '';
                if ($name === '' || mb_strlen($name, 'UTF-8') > 50) {
                    throw new RuntimeException('Le nom doit contenir entre 1 et 50 caractères.');
                }
                if ($recordId) {
                    $save = $bdd->prepare("UPDATE {$table} SET {$nameColumn} = ? WHERE {$idColumn} = ?");
                    $save->execute([$name, (int) $recordId]);
                    if (!$save->rowCount()) {
                        $exists = $bdd->prepare("SELECT 1 FROM {$table} WHERE {$idColumn} = ?");
                        $exists->execute([(int) $recordId]);
                        if (!$exists->fetchColumn()) { throw new RuntimeException('Cet élément est introuvable.'); }
                    }
                    admin_log_action($bdd, 'academic.' . $label . '.update', $table, (string) $recordId);
                    $_SESSION['admin_action_notice'] = ucfirst($label) . ' modifié(e).';
                } else {
                    $save = $bdd->prepare("INSERT INTO {$table} ({$nameColumn}) VALUES (?)");
                    $save->execute([$name]);
                    admin_log_action($bdd, 'academic.' . $label . '.create', $table, (string) $bdd->lastInsertId());
                    $_SESSION['admin_action_notice'] = ucfirst($label) . ' ajouté(e).';
                }
                header('Location: ?pages=palmares'); exit;
            }
            if (!$recordId) { throw new RuntimeException('Élément invalide.'); }
            if ($isSession) {
                $used = $bdd->prepare('SELECT COUNT(*) FROM palmaresetudiant WHERE session = ?');
                $used->execute([(int) $recordId]);
            } else {
                $used = $bdd->prepare('SELECT COUNT(*) FROM palmaresetudiant WHERE niveau = ?');
                $used->execute([(int) $recordId]);
            }
            if ((int) $used->fetchColumn() > 0) {
                throw new RuntimeException('Impossible de supprimer cet élément : il est utilisé par des résultats du palmarès.');
            }
            $remove = $bdd->prepare("DELETE FROM {$table} WHERE {$idColumn} = ?");
            $remove->execute([(int) $recordId]);
            if (!$remove->rowCount()) { throw new RuntimeException('Cet élément est introuvable.'); }
            admin_log_action($bdd, 'academic.' . $label . '.delete', $table, (string) $recordId);
            $_SESSION['admin_action_notice'] = ucfirst($label) . ' supprimé(e).';
            header('Location: ?pages=palmares'); exit;
        }

        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST' && in_array($_POST['admin_action'] ?? '', ['update', 'delete'], true)) {
            if (!csrf_is_valid($_POST['csrf_token'] ?? null)) {
                throw new RuntimeException('Le formulaire a expiré. Rechargez la page.');
            }
            $recordId = filter_var($_POST['record_id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
            if (!$recordId) { throw new RuntimeException('Résultat invalide.'); }
            if ($_POST['admin_action'] === 'delete') {
                $delete = $bdd->prepare('DELETE FROM palmaresetudiant WHERE id_pe = ?');
                $delete->execute([(int) $recordId]);
                if (!$delete->rowCount()) { throw new RuntimeException('Ce résultat est introuvable.'); }
                admin_log_action($bdd, 'results.delete', 'palmaresetudiant', (string) $recordId);
                $_SESSION['admin_action_notice'] = 'Le résultat a été supprimé du palmarès.';
                header('Location: ?pages=palmares'); exit;
            }
            $noms = is_string($_POST['noms'] ?? null) ? trim($_POST['noms']) : '';
            $anne = is_string($_POST['anne'] ?? null) ? trim($_POST['anne']) : '';
            $departmentId = filter_var($_POST['departement'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
            $sessionId = filter_var($_POST['session'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
            $levelId = filter_var($_POST['niveau'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
            if ($noms === '' || mb_strlen($noms, 'UTF-8') > 50 || !preg_match('/^\d{4}(?:-\d{4})?$/', $anne) || !$departmentId || !$sessionId || !$levelId) {
                throw new RuntimeException('Renseignez le nom, l’année, le département, la session et le niveau.');
            }
            $check = $bdd->prepare('SELECT (SELECT COUNT(*) FROM departement WHERE id = ?) + (SELECT COUNT(*) FROM sessions WHERE id = ?) + (SELECT COUNT(*) FROM niveau WHERE id = ?)');
            $check->execute([(int) $departmentId, (int) $sessionId, (int) $levelId]);
            if ((int) $check->fetchColumn() !== 3) { throw new RuntimeException('Un des choix académiques sélectionnés est introuvable.'); }
            $update = $bdd->prepare('UPDATE palmaresetudiant SET noms = ?, anne = ?, session = ?, departement = ?, niveau = ? WHERE id_pe = ?');
            $update->execute([$noms, $anne, (int) $sessionId, (int) $departmentId, (int) $levelId, (int) $recordId]);
            admin_log_action($bdd, 'results.update', 'palmaresetudiant', (string) $recordId);
            $_SESSION['admin_action_notice'] = 'Le résultat du palmarès a été modifié.';
            header('Location: ?pages=palmares'); exit;
        }

        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST' && isset($_POST['btn_palm'])) {
            $noms = is_string($_POST['noms'] ?? null) ? trim($_POST['noms']) : '';
            $anne = is_string($_POST['anne'] ?? null) ? trim($_POST['anne']) : '';
            $departement = filter_var($_POST['departement'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
            $sessionId = filter_var($_POST['session'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
            $niveauId = filter_var($_POST['niveau'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
            if ($noms === '' || mb_strlen($noms, 'UTF-8') > 50 || !preg_match('/^\d{4}(?:-\d{4})?$/', $anne) || !$departement || !$sessionId || !$niveauId) {
                throw new RuntimeException('Renseignez le nom, l’année académique, le département, la session et le niveau.');
            }

            $check = $bdd->prepare('SELECT (SELECT COUNT(*) FROM departement WHERE id = ?) + (SELECT COUNT(*) FROM sessions WHERE id = ?) + (SELECT COUNT(*) FROM niveau WHERE id = ?)');
            $check->execute([(int) $departement, (int) $sessionId, (int) $niveauId]);
            if ((int) $check->fetchColumn() !== 3) {
                throw new RuntimeException('Un des choix académiques sélectionnés est introuvable.');
            }

            $insert = $bdd->prepare('INSERT INTO palmaresetudiant (noms, anne, session, departement, niveau) VALUES (?, ?, ?, ?, ?)');
            $insert->execute([$noms, $anne, (int) $sessionId, (int) $departement, (int) $niveauId]);
            admin_log_action($bdd, 'results.create', 'palmaresetudiant', (string) $bdd->lastInsertId());
            $_SESSION['admin_action_notice'] = 'Le résultat a été ajouté au palmarès.';
            header('Location: ?pages=palmares');
            exit;
        }
        $palmaresRows = $bdd->query('SELECT pe.id_pe, pe.noms, pe.anne, pe.session, pe.departement, pe.niveau, d.titre AS departement_titre, f.titre AS section_titre, s.nom_s AS session_titre, n.titre AS niveau_titre FROM palmaresetudiant pe LEFT JOIN departement d ON d.id = pe.departement LEFT JOIN faculte f ON f.id = d.faculte LEFT JOIN sessions s ON s.id = pe.session LEFT JOIN niveau n ON n.id = pe.niveau ORDER BY pe.id_pe DESC LIMIT 200')->fetchAll();
    } catch (RuntimeException $exception) {
        $palmaresMessage = ['type' => 'warning', 'text' => $exception->getMessage()];
    } catch (Throwable $exception) {
        error_log('ISP-GOMBE results administration failed.');
        $palmaresMessage = ['type' => 'danger', 'text' => 'Le palmarès n’est pas disponible.'];
    }
}
?>
