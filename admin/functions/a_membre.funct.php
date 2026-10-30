<?php
if (!$bdd instanceof PDO) { http_response_code(503); exit('Base de données indisponible.'); }
$erreur = null; $erreurs = null;
admin_handle_record_action($bdd, 'a_membre', 'personnel', 'id', ['activate' => ['valider', 1], 'deactivate' => ['valider', 0], 'delete' => null], ['faculte' => ['!=', 0]]);
$nbrFichier = (int) $bdd->query('SELECT COUNT(*) FROM personnel')->fetchColumn();
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST' && isset($_POST['save'])) {
    $name = is_string($_POST['noms'] ?? null) ? trim($_POST['noms']) : '';
    $phone = is_string($_POST['telephone'] ?? null) ? trim($_POST['telephone']) : '';
    $email = is_string($_POST['mail'] ?? null) ? trim($_POST['mail']) : '';
    $role = is_string($_POST['fonction'] ?? null) ? trim($_POST['fonction']) : '';
    $faculty = filter_var($_POST['faculte'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
    if ($name === '' || $role === '' || !$faculty || mb_strlen($name, 'UTF-8') > 25 || mb_strlen($phone, 'UTF-8') > 25 || mb_strlen($role, 'UTF-8') > 100 || mb_strlen($email, 'UTF-8') > 255 || ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL))) {
        $erreur = 'Vérifiez les noms, fonction, coordonnées et section sélectionnée.';
    } else {
        try {
            $check = $bdd->prepare('SELECT 1 FROM faculte WHERE id = ?'); $check->execute([$faculty]);
            if (!$check->fetchColumn()) { throw new RuntimeException('La section choisie est introuvable.'); }
            $photo = admin_store_image_upload($_FILES['photo'] ?? [], 'admin/media/membre');
            $insert = $bdd->prepare('INSERT INTO personnel (noms, telephone, mail, fonction, photo, faculte) VALUES (?, ?, ?, ?, ?, ?)');
            $insert->execute([$name, $phone, $email, $role, $photo, $faculty]);
            admin_log_action($bdd, 'staff.create', 'personnel', (string) $bdd->lastInsertId());
            $erreurs = 'Membre enregistré.';
        } catch (RuntimeException $e) { $erreur = $e->getMessage(); }
        catch (Throwable $e) { error_log('ISP-GOMBE personnel upload failed.'); $erreur = 'Le membre n’a pas pu être enregistré.'; }
    }
}
$reqMembres = $bdd->query('SELECT * FROM personnel WHERE faculte != 0 ORDER BY id DESC');
?>
