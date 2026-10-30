<?php
if (!$bdd instanceof PDO) { http_response_code(503); exit('Base de données indisponible.'); }
admin_handle_record_action($bdd, 'departement', 'departement', 'id', ['delete' => null]);
$erreur = null;
$erreurs = null;
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST' && isset($_POST['update_department'])) {
    $id = filter_var($_POST['department_id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
    $titre = is_string($_POST['titre'] ?? null) ? trim($_POST['titre']) : '';
    $resume = is_string($_POST['resume'] ?? null) ? trim($_POST['resume']) : '';
    $faculte = filter_var($_POST['faculte'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
    if (!$id || $titre === '' || mb_strlen($titre, 'UTF-8') > 255 || $resume === '' || admin_rich_text_text_length($resume) > 20000 || !$faculte) {
        $erreur = 'Vérifiez le nom, le résumé et la section du département.';
    } else {
        $check = $bdd->prepare('SELECT 1 FROM faculte WHERE id = ?'); $check->execute([$faculte]);
        if (!$check->fetchColumn()) { $erreur = 'La section choisie est introuvable.'; }
        else {
            $update = $bdd->prepare('UPDATE departement SET titre = ?, faculte = ?, resume = ? WHERE id = ?');
            $update->execute([$titre, (int) $faculte, $resume, (int) $id]);
            admin_log_action($bdd, 'academic.update', 'departement', (string) $id);
            $_SESSION['admin_action_notice'] = 'Le département a été mis à jour.';
            header('Location: ?pages=departement'); exit;
        }
    }
}
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST' && isset($_POST['save'])) {
    $titre = is_string($_POST['titre'] ?? null) ? trim($_POST['titre']) : '';
    $resume = is_string($_POST['resume'] ?? null) ? trim($_POST['resume']) : '';
    $faculte = filter_var($_POST['faculte'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
    if ($titre === '' || mb_strlen($titre, 'UTF-8') > 255 || $resume === '' || admin_rich_text_text_length($resume) > 20000 || !$faculte) {
        $erreur = 'Renseignez le nom, le résumé et une section valide.';
    } else {
        try {
            $check = $bdd->prepare('SELECT 1 FROM faculte WHERE id = ?');
            $check->execute([$faculte]);
            if (!$check->fetchColumn()) {
                $erreur = 'La section sélectionnée est introuvable.';
            } else {
                $insert = $bdd->prepare('INSERT INTO departement (titre, faculte, resume) VALUES (?, ?, ?)');
                $insert->execute([$titre, (int) $faculte, $resume]);
                admin_log_action($bdd, 'academic.create', 'departement', (string) $bdd->lastInsertId());
                $_SESSION['admin_action_notice'] = 'Le département a été enregistré.';
                header('Location: ?pages=departement');
                exit;
            }
        } catch (Throwable $e) {
            error_log('ISP-GOMBE department creation failed.');
            $erreur = 'Le département n’a pas pu être enregistré.';
        }
    }
}
$reqMembres = $bdd->query('SELECT d.id AS id_dep, d.titre AS titre_dep, d.resume, d.faculte, f.titre AS titre_fac FROM departement d INNER JOIN faculte f ON d.faculte = f.id ORDER BY f.titre, d.titre');
$departmentSectionOptions = $bdd->query('SELECT id, titre FROM faculte ORDER BY titre')->fetchAll();
?>











