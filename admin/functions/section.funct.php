<?php
if (!$bdd instanceof PDO) { http_response_code(503); exit('Base de données indisponible.'); }
admin_handle_record_action($bdd, 'section', 'faculte', 'id', ['delete' => null]);
$erreur = null;
$erreurs = null;
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST' && isset($_POST['update_section'])) {
    $id = filter_var($_POST['section_id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
    $titre = is_string($_POST['titre'] ?? null) ? trim($_POST['titre']) : '';
    $resume = is_string($_POST['resume'] ?? null) ? trim($_POST['resume']) : '';
    if (!$id || $titre === '' || mb_strlen($titre, 'UTF-8') > 255 || admin_rich_text_text_length($resume) > 20000) {
        $erreur = 'Vérifiez le nom et le résumé de la section.';
    } else {
        $update = $bdd->prepare('UPDATE faculte SET titre = ?, resume = ? WHERE id = ?');
        $update->execute([$titre, $resume, (int) $id]);
        admin_log_action($bdd, 'academic.update', 'faculte', (string) $id);
        $_SESSION['admin_action_notice'] = 'La section a été mise à jour.';
        header('Location: ?pages=section'); exit;
    }
}
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST' && isset($_POST['save'])) {
    $titre = is_string($_POST['titre'] ?? null) ? trim($_POST['titre']) : '';
    $resume = is_string($_POST['resume'] ?? null) ? trim($_POST['resume']) : '';
    if ($titre === '' || mb_strlen($titre, 'UTF-8') > 255 || admin_rich_text_text_length($resume) > 20000) {
        $erreur = 'Le nom est obligatoire et le résumé ne peut pas dépasser 20 000 caractères.';
    } else {
        try {
            $insert = $bdd->prepare('INSERT INTO faculte (titre, resume) VALUES (?, ?)');
            $insert->execute([$titre, $resume]);
            admin_log_action($bdd, 'academic.create', 'faculte', (string) $bdd->lastInsertId());
            $_SESSION['admin_action_notice'] = 'La section a été enregistrée.';
            header('Location: ?pages=section');
            exit;
        } catch (Throwable $e) {
            error_log('ISP-GOMBE section creation failed.');
            $erreur = 'La section n’a pas pu être enregistrée.';
        }
    }
}
$reqMembres = $bdd->query('SELECT id, titre, resume FROM faculte ORDER BY id DESC');
?>


















