<?php
if (isset($_POST['login'])) {
    $erreur = 'Identifiants invalides.';
    if (csrf_is_valid($_POST['csrf_token'] ?? null) && $bdd instanceof PDO) {
        $utilisateur = trim((string) ($_POST['utilisateur'] ?? ''));
        $submitted = (string) ($_POST['mdp'] ?? '');
        if ($utilisateur !== '' && $submitted !== '' && auth_rate_limit('student', $utilisateur)) {
            $statement = $bdd->prepare('SELECT * FROM etudiant WHERE matricule = ? LIMIT 1');
            $statement->execute([$utilisateur]);
            $userinfo = $statement->fetch();
            if ($userinfo && password_matches_and_migrate($submitted, (string) $userinfo['mdp'], 'etudiant', 'mdp', (int) $userinfo['id'], $bdd)) {
                auth_rate_limit('student', $utilisateur, false, true);
                session_regenerate_id(true);
                $_SESSION['id'] = $userinfo['id'];
                $_SESSION['nom'] = $userinfo['nom'];
                $_SESSION['prenom'] = $userinfo['prenom'];
                $_SESSION['photo'] = $userinfo['photo'];
                $_SESSION['cp'] = $userinfo['cp'];
                $_SESSION['promotion'] = $userinfo['promotion'];
                header('Location:?pages=espaceEtudiant');
                exit;
            }
            auth_rate_limit('student', $utilisateur, true);
        }
    }
}
?>

