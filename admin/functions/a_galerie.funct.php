<?php
$nbrdocument=$bdd->query('SELECT * FROM galerie');
$nbrFichier=$nbrdocument->rowCount();
if (isset($_POST['save'])) {
    $title = trim((string) ($_POST['titre_g'] ?? ''));
    $category = trim((string) ($_POST['categ'] ?? ''));
    try {
        if ($title === '' || $category === '') {
            throw new RuntimeException('Veuillez compléter les champs !');
        }
        $filename = admin_store_image_upload($_FILES['photo_g'] ?? [], 'admin/media/galerie');
        $insert = $bdd->prepare('INSERT INTO galerie(titre_g,photo_g,categ) VALUES(?,?,?)');
        $insert->execute([$title, $filename, $category]);
        $erreurs = 'Enregistrement terminé avec succès !';
    } catch (Throwable $exception) {
        $erreur = $exception instanceof RuntimeException ? $exception->getMessage() : 'Enregistrement impossible.';
        if (!$exception instanceof RuntimeException) { error_log('ISP-GOMBE gallery upload failed.'); }
    }
}
$reqGalerie=$bdd->query("SELECT * FROM galerie ORDER BY id_g DESC");
?>
