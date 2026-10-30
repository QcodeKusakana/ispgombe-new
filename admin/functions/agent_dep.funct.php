<?php
if (!$bdd instanceof PDO) { http_response_code(503); exit('Base de données indisponible.'); }
$erreur = null; $erreurs = null;
admin_handle_record_action($bdd, 'agent_dep', 'agent_dep', 'id', ['activate' => ['valider', 1], 'deactivate' => ['valider', 0], 'delete' => null], ['departement' => ['!=', 0]]);
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST' && isset($_POST['save'])) {
    $name = is_string($_POST['noms'] ?? null) ? trim($_POST['noms']) : '';
    $phone = is_string($_POST['telephone'] ?? null) ? trim($_POST['telephone']) : '';
    $grade = is_string($_POST['grade'] ?? null) ? trim($_POST['grade']) : '';
    $email = is_string($_POST['mail'] ?? null) ? trim($_POST['mail']) : '';
    $domain = is_string($_POST['domaine'] ?? null) ? trim($_POST['domaine']) : '';
    $department = filter_var($_POST['departement'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
    if ($name === '' || $domain === '' || !$department || mb_strlen($name, 'UTF-8') > 150 || mb_strlen($domain, 'UTF-8') > 150 || mb_strlen($phone, 'UTF-8') > 150 || mb_strlen($grade, 'UTF-8') > 150 || mb_strlen($email, 'UTF-8') > 150 || ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL))) {
        $erreur = 'Vérifiez les champs et le département sélectionné.';
    } else {
        try {
            $check = $bdd->prepare('SELECT 1 FROM departement WHERE id = ?'); $check->execute([$department]);
            if (!$check->fetchColumn()) { throw new RuntimeException('Le département choisi est introuvable.'); }
            $photo = admin_store_image_upload($_FILES['photo'] ?? [], 'admin/media/membre');
            $insert = $bdd->prepare('INSERT INTO agent_dep (noms, telephone, mail, grade, domaine, photo, departement) VALUES (?, ?, ?, ?, ?, ?, ?)');
            $insert->execute([$name, $phone, $email, $grade, $domain, $photo, $department]);
            admin_log_action($bdd, 'staff.create', 'agent_dep', (string) $bdd->lastInsertId());
            $erreurs = 'Agent enregistré.';
        } catch (RuntimeException $e) { $erreur = $e->getMessage(); }
        catch (Throwable $e) { error_log('ISP-GOMBE department agent upload failed.'); $erreur = 'L’agent n’a pas pu être enregistré.'; }
    }
}
$reqMembres = $bdd->query('SELECT * FROM agent_dep WHERE departement != 0 ORDER BY id DESC');
?>
