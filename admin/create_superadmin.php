<?php
if (PHP_SAPI !== 'cli') {
    http_response_code(404);
    exit;
}

ini_set('session.save_path', sys_get_temp_dir());
$_SERVER['SERVER_NAME'] = 'localhost';
require_once __DIR__ . '/../php/main_function.php';

if (!$bdd instanceof PDO) {
    fwrite(STDERR, "Connexion MySQL impossible. Démarrez d’abord MySQL avec start-mysql.cmd.\n");
    exit(1);
}

$pseudo = $argv[1] ?? 'superadmin';
$mail = $argv[2] ?? 'superadmin@localhost.test';
if (!is_string($pseudo) || preg_match('/^[\pL\pN._-]{3,50}$/u', $pseudo) !== 1 || !is_string($mail) || mb_strlen($mail, 'UTF-8') > 50 || filter_var($mail, FILTER_VALIDATE_EMAIL) === false) {
    fwrite(STDERR, "Usage : creer-superadmin.cmd [nom_utilisateur] [email]\nNom : 3 à 50 caractères (lettres, chiffres, point, tiret ou souligné).\n");
    exit(2);
}

$duplicate = $bdd->prepare('SELECT 1 FROM admin WHERE pseudo = ? OR mail = ? LIMIT 1');
$duplicate->execute([$pseudo, $mail]);
if ($duplicate->fetchColumn()) {
    fwrite(STDERR, "Ce nom d’utilisateur ou cette adresse e-mail existe déjà. Choisissez-en un autre.\n");
    exit(3);
}

$temporaryPassword = bin2hex(random_bytes(16));
try {
    $insert = $bdd->prepare('INSERT INTO admin (pseudo, mail, password, niveau, confirmer) VALUES (?, ?, ?, 7, 1)');
    $insert->execute([$pseudo, $mail, password_hash($temporaryPassword, PASSWORD_DEFAULT)]);
} catch (Throwable $exception) {
    fwrite(STDERR, "Échec de la création du compte dans la table admin.\n");
    exit(4);
}

echo "Compte super administrateur créé et activé.\n";
echo "Nom d’utilisateur : {$pseudo}\n";
echo "E-mail : {$mail}\n";
echo "Mot de passe temporaire : {$temporaryPassword}\n";
echo "Conservez ces identifiants en lieu sûr.\n";
