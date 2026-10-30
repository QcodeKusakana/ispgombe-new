<?php
if (!$bdd instanceof PDO) { http_response_code(503); exit('Base de données indisponible.'); }
$erreur = null; $erreurs = null;
admin_handle_record_action($bdd, 'annonce_d', 'annonce', 'id', ['delete' => null], ['departement' => ['!=', 0]]);
$nbrFichier = (int) $bdd->query('SELECT COUNT(*) FROM annonce WHERE departement != 0')->fetchColumn();
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST' && isset($_POST['update_announcement'])) {
    $id = filter_var($_POST['announcement_id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
    $summary = is_string($_POST['resumer'] ?? null) ? trim($_POST['resumer']) : '';
    if (!$id || $summary === '' || admin_rich_text_text_length($summary) > 5000) {
        $erreur = 'Renseignez le texte de l’annonce (5 000 caractères maximum).';
    } else {
        $update = $bdd->prepare('UPDATE annonce SET resumer = ? WHERE id = ? AND departement != 0');
        $update->execute([$summary, (int) $id]);
        admin_log_action($bdd, 'announcement.update', 'annonce', (string) $id);
        $_SESSION['admin_action_notice'] = 'L’annonce de département a été mise à jour.';
        header('Location: ?pages=annonce_d');
        exit;
    }
}
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST' && isset($_POST['save'])) {
    $summary = is_string($_POST['resumer'] ?? null) ? trim($_POST['resumer']) : '';
    $department = filter_var($_POST['departement'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
    if ($summary === '' || !$department || admin_rich_text_text_length($summary) > 5000) { $erreur = 'Renseignez l’annonce et un département valide.'; }
    else {
        $check = $bdd->prepare('SELECT 1 FROM departement WHERE id = ?'); $check->execute([$department]);
        if (!$check->fetchColumn()) { $erreur = 'Le département choisi est introuvable.'; }
        else { $insert = $bdd->prepare('INSERT INTO annonce (resumer, departement) VALUES (?, ?)'); $insert->execute([$summary, $department]); admin_log_action($bdd, 'announcement.create', 'annonce', (string) $bdd->lastInsertId()); $erreurs = 'Annonce enregistrée.'; }
    }
}
$reqCouv = $bdd->query('SELECT * FROM annonce WHERE departement != 0 ORDER BY id DESC');
?>
