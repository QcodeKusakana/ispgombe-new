<?php
if (!$bdd instanceof PDO) {
    http_response_code(503);
    exit('Base de données indisponible.');
}
$erreur = null;
$sms = null;
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST' && isset($_POST['activite'])) {
    $title = is_string($_POST['titre'] ?? null) ? trim($_POST['titre']) : '';
    $description = is_string($_POST['description'] ?? null) ? trim($_POST['description']) : '';
    if ($title === '' || $description === '' || mb_strlen($title, 'UTF-8') > 255 || admin_rich_text_text_length($description) > 20000) {
        $erreur = 'Le titre et la description sont obligatoires et doivent respecter les limites indiquées.';
    } else {
        try {
            $filename = admin_store_image_upload($_FILES['photo'] ?? [], 'admin/media/images_activ');
            $insert = $bdd->prepare('INSERT INTO activite (titre, description, photo, id_adm, date_pub) VALUES (?, ?, ?, ?, NOW())');
            $insert->execute([$title, $description, $filename, (int) $_SESSION['id_adm']]);
            admin_log_action($bdd, 'content.create', 'activite', (string) $bdd->lastInsertId());
            $sms = 'Article enregistré. Il est en attente de publication.';
        } catch (RuntimeException $e) {
            $erreur = $e->getMessage();
        } catch (Throwable $e) {
            error_log('ISP-GOMBE activity upload failed.');
            $erreur = 'L’article n’a pas pu être enregistré.';
        }
    }
}
admin_handle_record_action($bdd, 'activite', 'activite', 'id_act', ['publish' => ['etat_modifier', 1], 'unpublish' => ['etat_modifier', 0], 'delete' => null]);
$perPage = 10;
$total = (int) $bdd->query('SELECT COUNT(*) FROM activite WHERE etat_depot = 0')->fetchColumn();
$nbPage = max(1, (int) ceil($total / $perPage));
$current = filter_var($_GET['pag'] ?? 1, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]) ?: 1;
$current = min($current, $nbPage);
$offset = ($current - 1) * $perPage;
$les_activite = $bdd->query("SELECT * FROM activite WHERE etat_depot = 0 ORDER BY date_pub DESC LIMIT {$offset}, {$perPage}");
?>
