<?php
if (!$bdd instanceof PDO) { http_response_code(503); exit('Base de données indisponible.'); }
admin_handle_record_action($bdd, 'promotion', 'promotion', 'id', ['delete' => null]);
$erreur = null;
$erreurs = null;
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST' && isset($_POST['update_promotion'])) {
    $id = filter_var($_POST['promotion_id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
    $titre = is_string($_POST['titre'] ?? null) ? trim($_POST['titre']) : '';
    $optioner = filter_var($_POST['optioner'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
    if (!$id || $titre === '' || mb_strlen($titre, 'UTF-8') > 255 || !$optioner) {
        $erreur = 'Vérifiez le nom de la promotion et l’option.';
    } else {
        $check = $bdd->prepare('SELECT 1 FROM optioner WHERE id = ?'); $check->execute([$optioner]);
        if (!$check->fetchColumn()) { $erreur = 'L’option choisie est introuvable.'; }
        else {
            $update = $bdd->prepare('UPDATE promotion SET titre = ?, optioner = ? WHERE id = ?');
            $update->execute([$titre, (int) $optioner, (int) $id]);
            admin_log_action($bdd, 'academic.update', 'promotion', (string) $id);
            $_SESSION['admin_action_notice'] = 'La promotion a été mise à jour.';
            header('Location: ?pages=promotion'); exit;
        }
    }
}
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST' && isset($_POST['save'])) {
    $titre = is_string($_POST['titre'] ?? null) ? trim($_POST['titre']) : '';
    $optioner = filter_var($_POST['optioner'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
    if ($titre === '' || mb_strlen($titre, 'UTF-8') > 255 || !$optioner) {
        $erreur = 'Renseignez le nom de la promotion et choisissez une option.';
    } else {
        try {
            $check = $bdd->prepare('SELECT 1 FROM optioner WHERE id = ?');
            $check->execute([$optioner]);
            if (!$check->fetchColumn()) {
                $erreur = 'L’option sélectionnée est introuvable.';
            } else {
                $insert = $bdd->prepare('INSERT INTO promotion (titre, optioner) VALUES (?, ?)');
                $insert->execute([$titre, (int) $optioner]);
                admin_log_action($bdd, 'academic.create', 'promotion', (string) $bdd->lastInsertId());
                $_SESSION['admin_action_notice'] = 'La promotion a été enregistrée.';
                header('Location: ?pages=promotion');
                exit;
            }
        } catch (Throwable $e) {
            error_log('ISP-GOMBE promotion creation failed.');
            $erreur = 'La promotion n’a pas pu être enregistrée.';
        }
    }
}
$reqMembres = $bdd->query('SELECT p.id AS id_prom, p.titre AS titre_prom, p.optioner, o.titre AS titre_opt FROM optioner o INNER JOIN promotion p ON p.optioner = o.id ORDER BY o.titre, p.titre');
$promotionOptionOptions = $bdd->query('SELECT id, titre FROM optioner ORDER BY titre')->fetchAll();
?>













