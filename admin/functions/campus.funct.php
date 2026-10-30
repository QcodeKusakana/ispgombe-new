<?php
if (!$bdd instanceof PDO) {
    http_response_code(503);
    exit('Base de données indisponible.');
}
$erreur = null;
$sms = null;
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST' && isset($_POST['update_campus'])) {
    $id = filter_var($_POST['campus_id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
    $title = is_string($_POST['titre'] ?? null) ? trim($_POST['titre']) : '';
    $description = is_string($_POST['description'] ?? null) ? trim($_POST['description']) : '';
    if (!$id || $title === '' || $description === '' || mb_strlen($title, 'UTF-8') > 255 || admin_rich_text_text_length($description) > 20000) {
        $erreur = 'Vérifiez le titre et la description avant d’enregistrer.';
    } else {
        try {
            $photo = null;
            $upload = $_FILES['photo'] ?? [];
            if (($upload['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_NO_FILE) {
                $photo = admin_store_image_upload($upload, 'admin/media/images_activ');
            }
            if ($photo === null) {
                $update = $bdd->prepare('UPDATE campus SET titre = ?, description = ? WHERE id_act = ? AND etat_depot = 0');
                $update->execute([$title, $description, (int) $id]);
            } else {
                $update = $bdd->prepare('UPDATE campus SET titre = ?, description = ?, photo = ? WHERE id_act = ? AND etat_depot = 0');
                $update->execute([$title, $description, $photo, (int) $id]);
            }
            if ($update->rowCount() === 0) {
                $check = $bdd->prepare('SELECT 1 FROM campus WHERE id_act = ? AND etat_depot = 0');
                $check->execute([(int) $id]);
                if (!$check->fetchColumn()) {
                    throw new RuntimeException('Cette information campus est introuvable.');
                }
            }
            admin_log_action($bdd, 'content.update', 'campus', (string) $id);
            $_SESSION['admin_action_notice'] = 'L’information campus a été mise à jour.';
            header('Location: ?pages=campus');
            exit;
        } catch (RuntimeException $e) {
            $erreur = $e->getMessage();
        } catch (Throwable $e) {
            error_log('ISP-GOMBE campus update failed.');
            $erreur = 'La mise à jour de l’information campus a échoué.';
        }
    }
}
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST' && isset($_POST['campus'])) {
    $title = is_string($_POST['titre'] ?? null) ? trim($_POST['titre']) : '';
    $description = is_string($_POST['description'] ?? null) ? trim($_POST['description']) : '';
    if ($title === '' || $description === '' || mb_strlen($title, 'UTF-8') > 255 || admin_rich_text_text_length($description) > 20000) {
        $erreur = 'Le titre et la description sont obligatoires et doivent respecter les limites indiquées.';
    } else {
        try {
            $filename = admin_store_image_upload($_FILES['photo'] ?? [], 'admin/media/images_activ');
            $insert = $bdd->prepare('INSERT INTO campus (titre, description, photo, id_adm, date_pub) VALUES (?, ?, ?, ?, NOW())');
            $insert->execute([$title, $description, $filename, (int) $_SESSION['id_adm']]);
            admin_log_action($bdd, 'content.create', 'campus', (string) $bdd->lastInsertId());
            $sms = 'Information campus enregistrée. Elle est en attente de publication.';
        } catch (RuntimeException $e) {
            $erreur = $e->getMessage();
        } catch (Throwable $e) {
            error_log('ISP-GOMBE campus upload failed.');
            $erreur = 'L’information campus n’a pas pu être enregistrée.';
        }
    }
}
admin_handle_record_action($bdd, 'campus', 'campus', 'id_act', ['publish' => ['etat_modifier', 1], 'unpublish' => ['etat_modifier', 0], 'delete' => null], ['etat_depot' => ['=', 0]]);
$perPage = 10;
$total = (int) $bdd->query('SELECT COUNT(*) FROM campus WHERE etat_depot = 0')->fetchColumn();
$nbPage = max(1, (int) ceil($total / $perPage));
$current = filter_var($_GET['pag'] ?? 1, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]) ?: 1;
$current = min($current, $nbPage);
$offset = ($current - 1) * $perPage;
$les_activite = $bdd->query("SELECT * FROM campus WHERE etat_depot = 0 ORDER BY date_pub DESC LIMIT {$offset}, {$perPage}");
?>
