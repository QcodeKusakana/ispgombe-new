<?php
if (!$bdd instanceof PDO) { http_response_code(503); exit('Base de données indisponible.'); }
admin_handle_record_action($bdd, 'option', 'optioner', 'id', ['delete' => null]);
$erreur = null;
$erreurs = null;
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST' && isset($_POST['update_option'])) {
    $id = filter_var($_POST['option_id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
    $titre = is_string($_POST['titre'] ?? null) ? trim($_POST['titre']) : '';
    $departement = filter_var($_POST['departement'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
    if (!$id || $titre === '' || mb_strlen($titre, 'UTF-8') > 255 || !$departement) {
        $erreur = 'Vérifiez le nom de l’option et le département.';
    } else {
        $check = $bdd->prepare('SELECT 1 FROM departement WHERE id = ?'); $check->execute([$departement]);
        if (!$check->fetchColumn()) { $erreur = 'Le département choisi est introuvable.'; }
        else {
            $update = $bdd->prepare('UPDATE optioner SET titre = ?, departement = ? WHERE id = ?');
            $update->execute([$titre, (int) $departement, (int) $id]);
            admin_log_action($bdd, 'academic.update', 'optioner', (string) $id);
            $_SESSION['admin_action_notice'] = 'L’option a été mise à jour.';
            header('Location: ?pages=option'); exit;
        }
    }
}
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST' && isset($_POST['save'])) {
    $titre = is_string($_POST['titre'] ?? null) ? trim($_POST['titre']) : '';
    $departement = filter_var($_POST['departement'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
    if ($titre === '' || mb_strlen($titre, 'UTF-8') > 255 || !$departement) {
        $erreur = 'Renseignez le nom de l’option et choisissez un département.';
    } else {
        try {
            $check = $bdd->prepare('SELECT 1 FROM departement WHERE id = ?');
            $check->execute([$departement]);
            if (!$check->fetchColumn()) {
                $erreur = 'Le département sélectionné est introuvable.';
            } else {
                $insert = $bdd->prepare('INSERT INTO optioner (titre, departement) VALUES (?, ?)');
                $insert->execute([$titre, (int) $departement]);
                admin_log_action($bdd, 'academic.create', 'optioner', (string) $bdd->lastInsertId());
                $_SESSION['admin_action_notice'] = 'L’option a été enregistrée.';
                header('Location: ?pages=option');
                exit;
            }
        } catch (Throwable $e) {
            error_log('ISP-GOMBE option creation failed.');
            $erreur = 'L’option n’a pas pu être enregistrée.';
        }
    }
}
$reqMembres = $bdd->query('SELECT o.id AS id_opt, o.titre AS titre_opt, o.departement, d.titre AS titre_dep FROM optioner o INNER JOIN departement d ON o.departement = d.id ORDER BY d.titre, o.titre');
$optionDepartmentOptions = $bdd->query('SELECT id, titre FROM departement ORDER BY titre')->fetchAll();
?>











