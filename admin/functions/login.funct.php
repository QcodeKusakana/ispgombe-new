<?php
if (isset($_POST['login'])) {
    $erreur = 'Identifiants invalides ou compte non activé.';
    if (csrf_is_valid($_POST['csrf_token'] ?? null) && $bdd instanceof PDO) {
        $pseudo = trim((string) ($_POST['pseudo'] ?? ''));
        $submitted = (string) ($_POST['password'] ?? '');
        if ($pseudo !== '' && $submitted !== '' && auth_rate_limit('admin', $pseudo)) {
            $statement = $bdd->prepare('SELECT * FROM admin WHERE pseudo = ? AND confirmer = 1 LIMIT 1');
            $statement->execute([$pseudo]);
            $userinfo = $statement->fetch();
            if ($userinfo && password_matches_and_migrate($submitted, (string) $userinfo['password'], 'admin', 'password', (int) $userinfo['id_adm'], $bdd)) {
                auth_rate_limit('admin', $pseudo, false, true);
                session_regenerate_id(true);
                $_SESSION['id_adm'] = $userinfo['id_adm'];
                $_SESSION['pseudo'] = $userinfo['pseudo'];
                $_SESSION['mail'] = $userinfo['mail'];
                $_SESSION['niveau'] = $userinfo['niveau'];
                $_SESSION['confirmer'] = $userinfo['confirmer'];
                setcookie('password', '', time() - 3600, '/', '', $secureCookie, true);
                setcookie('pseudo', '', time() - 3600, '/', '', $secureCookie, true);
                header('Location:?pages=home');
                exit;
            }
            auth_rate_limit('admin', $pseudo, true);
        }
    }
}
?>

