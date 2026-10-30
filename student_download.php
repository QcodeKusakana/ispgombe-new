<?php
require_once __DIR__ . '/php/main_function.php';
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'GET' || empty($_SESSION['id']) || !($bdd instanceof PDO)) {
    http_response_code(empty($_SESSION['id']) ? 403 : 503);
    exit('Accès refusé.');
}
$documents = [
    'diploma' => ['column' => 'diplomeAttest', 'directory' => 'diplome'],
    'certificate' => ['column' => 'certificat', 'directory' => 'certificat'],
    'transcript' => ['column' => 'bulletin', 'directory' => 'bulletin'],
    'identity' => ['column' => 'carteIdentite', 'directory' => 'carte'],
    'birth' => ['column' => 'attestNaissance', 'directory' => 'attestation'],
];
$key = is_string($_GET['document'] ?? null) ? $_GET['document'] : '';
if (!isset($documents[$key])) { http_response_code(404); exit('Document introuvable.'); }
$document = $documents[$key];
$statement = $bdd->prepare('SELECT `' . $document['column'] . '` FROM etudiant WHERE id = ? LIMIT 1');
$statement->execute([(int) $_SESSION['id']]);
$storedName = $statement->fetchColumn();
if (!is_string($storedName) || $storedName === '' || basename($storedName) !== $storedName || strlen($storedName) > 255 || preg_match('/[\\x00-\\x1F\\x7F\\/\\\\\\\\]/', $storedName)) {
    http_response_code(404); exit('Document introuvable.');
}
$directory = realpath(__DIR__ . DIRECTORY_SEPARATOR . 'media' . DIRECTORY_SEPARATOR . $document['directory']);
$file = $directory === false ? false : realpath($directory . DIRECTORY_SEPARATOR . $storedName);
if ($directory === false || $file === false || !is_file($file) || !str_starts_with($file, $directory . DIRECTORY_SEPARATOR)) {
    http_response_code(404); exit('Document introuvable.');
}
$finfo = new finfo(FILEINFO_MIME_TYPE);
$mime = $finfo->file($file);
$allowedMime = ['application/pdf', 'image/jpeg', 'image/png'];
if (!in_array($mime, $allowedMime, true)) { http_response_code(404); exit('Document introuvable.'); }
header('Content-Type: ' . $mime);
header('Content-Disposition: attachment; filename="document-etudiant.' . ($mime === 'application/pdf' ? 'pdf' : ($mime === 'image/png' ? 'png' : 'jpg')) . '"');
header('Content-Length: ' . (string) filesize($file));
header('X-Content-Type-Options: nosniff');
header('Cache-Control: private, no-store, max-age=0');
readfile($file);
