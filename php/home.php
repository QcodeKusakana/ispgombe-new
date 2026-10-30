<?php
$facultesAccueil = [];
$actualitesAccueil = [];
$comiteGestionAccueil = [];
$imagesAccueil = [
    ['kicker' => 'Vie institutionnelle', 'title' => 'La communauté universitaire réunie', 'image_path' => 'admin/media/images_activ/avs_0_act.jpg', 'image_alt' => 'Cérémonie académique à l’ISP-GOMBE'],
    ['kicker' => 'Apprendre et pratiquer', 'title' => 'Des espaces dédiés à la formation', 'image_path' => 'admin/media/couverture/Qcode_12.jpeg', 'image_alt' => 'Étudiantes et étudiants dans une salle informatique de l’ISP-GOMBE'],
    ['kicker' => 'Vie académique', 'title' => 'Réflexion et partage au sein de l’institut', 'image_path' => 'admin/media/images_activ/avs_3_act.jpg', 'image_alt' => 'Enseignants et membres académiques réunis en séance de travail'],
];

if ($bdd instanceof PDO) {
    try {
        $facultesAccueil = $bdd->query('SELECT f.id, f.titre, (SELECT COUNT(*) FROM departement d WHERE d.faculte = f.id) AS department_count FROM faculte f ORDER BY f.id')->fetchAll();
        $actualitesAccueil = $bdd->query('SELECT id_act, titre, description, photo, date_pub FROM activite WHERE etat_modifier = 1 ORDER BY id_act DESC LIMIT 3')->fetchAll();
        $imagesActives = $bdd->query('SELECT kicker, title, image_path, image_alt FROM home_slide WHERE is_active = 1 ORDER BY sort_order ASC, id ASC')->fetchAll();
        $comiteGestionAccueil = $bdd->query('SELECT id, nom, fonction, photo FROM committee_member WHERE is_active = 1 ORDER BY sort_order ASC, id ASC')->fetchAll();
        if ($imagesActives) {
            $imagesAccueil = $imagesActives;
        }
    } catch (PDOException $exception) {
        error_log('ISP-GOMBE public home content could not be loaded.');
    }
}
?>
