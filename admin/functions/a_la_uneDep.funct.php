<?php
if (!$bdd instanceof PDO) { http_response_code(503); exit('Base de données indisponible.'); }
$erreur = null; $erreurs = null;
admin_handle_record_action($bdd, 'a_la_uneDep', 'couverture', 'id_cv', ['delete' => null], ['departement' => ['!=', 0]]);
$nbrFichier = (int) $bdd->query('SELECT COUNT(*) FROM couverture WHERE departement != 0')->fetchColumn();
$departmentsForEdit = $bdd->query('SELECT id, titre FROM departement ORDER BY titre')->fetchAll();
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST' && isset($_POST['update_cover'])) {
    $id = filter_var($_POST['cover_id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
    $department = filter_var($_POST['departement'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
    if (!$id || !$department) { $erreur = 'Choisissez un département valide.'; }
    else {
        $check = $bdd->prepare('SELECT 1 FROM departement WHERE id = ?'); $check->execute([$department]);
        if (!$check->fetchColumn()) { $erreur = 'Le département choisi est introuvable.'; }
        else {
            try {
                $upload = $_FILES['photo_cv'] ?? [];
                if (($upload['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
                    $update = $bdd->prepare('UPDATE couverture SET departement = ? WHERE id_cv = ? AND departement != 0');
                    $update->execute([(int) $department, (int) $id]);
                } else {
                    $photo = admin_store_image_upload($upload, 'admin/media/couverture');
                    $update = $bdd->prepare('UPDATE couverture SET photo_cv = ?, departement = ? WHERE id_cv = ? AND departement != 0');
                    $update->execute([$photo, (int) $department, (int) $id]);
                }
                admin_log_action($bdd, 'gallery.update', 'couverture', (string) $id);
                $_SESSION['admin_action_notice'] = 'L’image de couverture a été mise à jour.';
                header('Location: ?pages=a_la_uneDep'); exit;
            } catch (Throwable $e) { error_log('ISP-GOMBE department cover update failed.'); $erreur = 'La mise à jour de l’image a échoué.'; }
        }
    }
}
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST' && isset($_POST['save'])) {
    $department = filter_var($_POST['departement'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
    if (!$department) { $erreur = 'Choisissez un département valide.'; }
    else {
        try {
            $check = $bdd->prepare('SELECT 1 FROM departement WHERE id = ?'); $check->execute([$department]);
            if (!$check->fetchColumn()) { throw new RuntimeException('Le département choisi est introuvable.'); }
            $photo = admin_store_image_upload($_FILES['photo_cv'] ?? [], 'admin/media/couverture');
            $insert = $bdd->prepare('INSERT INTO couverture (photo_cv, departement) VALUES (?, ?)'); $insert->execute([$photo, $department]); admin_log_action($bdd, 'gallery.create', 'couverture', (string) $bdd->lastInsertId());
            $erreurs = 'Image enregistrée.';
        } catch (RuntimeException $e) { $erreur = $e->getMessage(); }
        catch (Throwable $e) { error_log('ISP-GOMBE department cover upload failed.'); $erreur = 'L’image n’a pas pu être enregistrée.'; }
    }
}
$reqCouv = $bdd->query('SELECT * FROM couverture WHERE departement != 0 ORDER BY id_cv DESC');
?>
