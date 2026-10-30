<?php
if (empty($_SESSION['id'])) {
    header('Location:?pages=loginEtud');
    exit;
}

if (isset($_POST['modifier'])) {
    $telephone = trim((string) ($_POST['telephone'] ?? ''));
    $ancien = (string) ($_POST['mdp'] ?? '');
    $nouveau = (string) ($_POST['mdp2'] ?? '');
    if (!csrf_is_valid($_POST['csrf_token'] ?? null)) {
        $erreurs = 'La session du formulaire a expiré. Rechargez la page puis réessayez.';
    } elseif ($telephone === '' || $ancien === '' || strlen($nouveau) < 12) {
        $erreurs = 'Indiquez un téléphone, votre ancien mot de passe et un nouveau mot de passe (12 caractères minimum).';
    } else {
        $verif = $bdd->prepare('SELECT id, mdp FROM etudiant WHERE id = ?');
        $verif->execute([(int) $_SESSION['id']]);
        $student = $verif->fetch();
        if ($student && password_matches_and_migrate($ancien, (string) $student['mdp'], 'etudiant', 'mdp', (int) $student['id'], $bdd)) {
            $update = $bdd->prepare('UPDATE etudiant SET mdp = ?, telephone = ? WHERE id = ?');
            $update->execute([password_hash($nouveau, PASSWORD_DEFAULT), $telephone, (int) $_SESSION['id']]);
            session_regenerate_id(true);
            header('Location:?pages=espaceEtudiant');
            exit;
        }
        $erreurs = 'Le mot de passe actuel est incorrect.';
    }
}

if (!$bdd instanceof PDO) {
    http_response_code(503);
    exit('Service étudiant temporairement indisponible.');
}
$statement = $bdd->prepare('SELECT * FROM etudiant WHERE id = ? LIMIT 1');
$statement->execute([(int) $_SESSION['id']]);
$et = $statement->fetch();
if (!$et) {
    $_SESSION = [];
    session_destroy();
    header('Location:?pages=loginEtud');
    exit;
}
$statement = $bdd->prepare('SELECT * FROM promotion WHERE id = ? LIMIT 1');
$statement->execute([(int) $et['promotion']]);
$prom = $statement->fetch() ?: ['id' => $et['promotion'], 'titre' => ''];
$statement = $bdd->prepare('SELECT * FROM optioner WHERE id = ? LIMIT 1');
$statement->execute([(int) $et['optioner']]);
$opt = $statement->fetch() ?: ['titre' => ''];
$statement = $bdd->prepare('SELECT * FROM faculte WHERE id = ? LIMIT 1');
$statement->execute([(int) $et['faculte']]);
$fac = $statement->fetch() ?: ['titre' => ''];
$statement = $bdd->prepare('SELECT * FROM departement WHERE id = ? LIMIT 1');
$statement->execute([(int) $et['departement']]);
$dep = $statement->fetch() ?: ['titre' => ''];
$statement = $bdd->prepare('SELECT titre, contenu, datepub FROM communique WHERE promotion = ? ORDER BY datepub DESC');
$statement->execute([(int) $et['promotion']]);
$communiques = $statement->fetchAll();
$studentDocuments = [
    ['key' => 'diploma', 'column' => 'diplomeAttest', 'label' => 'Diplôme ou attestation'],
    ['key' => 'certificate', 'column' => 'certificat', 'label' => 'Certificat'],
    ['key' => 'transcript', 'column' => 'bulletin', 'label' => 'Bulletin scolaire'],
    ['key' => 'identity', 'column' => 'carteIdentite', 'label' => 'Pièce d’identité'],
    ['key' => 'birth', 'column' => 'attestNaissance', 'label' => 'Attestation de naissance'],
];
?>



