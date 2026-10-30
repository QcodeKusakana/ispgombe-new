<?php
if (!$bdd instanceof PDO) { http_response_code(503); exit('Base de données indisponible.'); }
$erreur = null; $erreurs = null;
admin_handle_record_action($bdd, 'a_la_une', 'couverture', 'id_cv', ['delete' => null], ['faculte' => ['!=', 0]]);
$nbrFichier = (int) $bdd->query('SELECT COUNT(*) FROM couverture WHERE faculte != 0')->fetchColumn();
$sectionsForEdit = $bdd->query('SELECT id, titre FROM faculte ORDER BY titre')->fetchAll();
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST' && isset($_POST['update_cover'])) {
    $id = filter_var($_POST['cover_id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
    $faculty = filter_var($_POST['faculte'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
    if (!$id || !$faculty) { $erreur = 'Choisissez une section valide.'; }
    else {
        $check = $bdd->prepare('SELECT 1 FROM faculte WHERE id = ?'); $check->execute([$faculty]);
        if (!$check->fetchColumn()) { $erreur = 'La section choisie est introuvable.'; }
        else {
            try {
                $upload = $_FILES['photo_cv'] ?? [];
                if (($upload['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
                    $update = $bdd->prepare('UPDATE couverture SET faculte = ? WHERE id_cv = ? AND faculte != 0');
                    $update->execute([(int) $faculty, (int) $id]);
                } else {
                    $photo = admin_store_image_upload($upload, 'admin/media/couverture');
                    $update = $bdd->prepare('UPDATE couverture SET photo_cv = ?, faculte = ? WHERE id_cv = ? AND faculte != 0');
                    $update->execute([$photo, (int) $faculty, (int) $id]);
                }
                admin_log_action($bdd, 'gallery.update', 'couverture', (string) $id);
                $_SESSION['admin_action_notice'] = 'L’image de couverture a été mise à jour.';
                header('Location: ?pages=a_la_une'); exit;
            } catch (Throwable $e) { error_log('ISP-GOMBE faculty cover update failed.'); $erreur = 'La mise à jour de l’image a échoué.'; }
        }
    }
}
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST' && isset($_POST['save'])) {
    $faculty = filter_var($_POST['faculte'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
    if (!$faculty) { $erreur = 'Choisissez une section valide.'; }
    else {
        try {
            $check = $bdd->prepare('SELECT 1 FROM faculte WHERE id = ?'); $check->execute([$faculty]);
            if (!$check->fetchColumn()) { throw new RuntimeException('La section choisie est introuvable.'); }
            $photo = admin_store_image_upload($_FILES['photo_cv'] ?? [], 'admin/media/couverture');
            $insert = $bdd->prepare('INSERT INTO couverture (photo_cv, faculte) VALUES (?, ?)'); $insert->execute([$photo, $faculty]); admin_log_action($bdd, 'gallery.create', 'couverture', (string) $bdd->lastInsertId());
            $erreurs = 'Image enregistrée.';
        } catch (RuntimeException $e) { $erreur = $e->getMessage(); }
        catch (Throwable $e) { error_log('ISP-GOMBE faculty cover upload failed.'); $erreur = 'L’image n’a pas pu être enregistrée.'; }
    }
}
$reqCouv = $bdd->query('SELECT * FROM couverture WHERE faculte != 0 ORDER BY id_cv DESC');
?>
