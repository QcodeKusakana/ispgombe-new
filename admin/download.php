<?php
require_once __DIR__ . '/functions/main_function.php';
opaque_url_ids_canonicalize_request(['id', 'ID']);
opaque_url_ids_normalize_query(['id', 'ID']);
if (!admin_refresh_session_identity($bdd ?? null) || !in_array((int) $_SESSION['niveau'], [13, 7], true) || !$bdd instanceof PDO) {
    http_response_code(403);
    exit('Accès refusé.');
}
$id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
$document = (string) ($_GET['document'] ?? '');
$documents = [
    'diplomeAttest' => ['column' => 'diplomeAttest', 'directory' => 'diplome'],
    'certificat' => ['column' => 'certificat', 'directory' => 'certificat'],
    'bulletin' => ['column' => 'bulletin', 'directory' => 'bulletin'],
    'carteIdentite' => ['column' => 'carteIdentite', 'directory' => 'carte'],
    'attestNaissance' => ['column' => 'attestNaissance', 'directory' => 'attestation'],
];
if (!$id || !isset($documents[$document])) {
    http_response_code(404);
    exit('Document introuvable.');
}
$column = $documents[$document]['column'];
$statement = $bdd->prepare('SELECT `' . $column . '` FROM etudiant WHERE id = ?');
$statement->execute([$id]);
$storedName = $statement->fetchColumn();
if (!is_string($storedName) || $storedName === '' || basename($storedName) !== $storedName) {
    http_response_code(404);
    exit('Document introuvable.');
}
$baseDirectory = realpath(__DIR__ . '/../media/' . $documents[$document]['directory']);
$filePath = $baseDirectory === false ? false : realpath($baseDirectory . DIRECTORY_SEPARATOR . $storedName);
if ($baseDirectory === false || $filePath === false || !is_file($filePath) || strpos($filePath, $baseDirectory . DIRECTORY_SEPARATOR) !== 0) {
    http_response_code(404);
    exit('Document introuvable.');
}
$finfo = new finfo(FILEINFO_MIME_TYPE);
$mime = $finfo->file($filePath);
if (!in_array($mime, ['application/pdf', 'image/jpeg', 'image/png'], true)) {
    http_response_code(415);
    exit('Format de document non pris en charge.');
}
$extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
if (!in_array($extension, ['pdf', 'jpg', 'jpeg', 'png'], true)) {
    http_response_code(415);
    exit('Format de document non pris en charge.');
}
header('Content-Type: ' . $mime);
header('Content-Length: ' . filesize($filePath));
header('Content-Disposition: attachment; filename="dossier-' . (int) $id . '-' . $document . '.' . $extension . '"');
header('Cache-Control: private, no-store, max-age=0');
readfile($filePath);
exit;
?>
