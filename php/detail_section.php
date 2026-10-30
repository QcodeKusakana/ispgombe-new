<?php
$sectionId = filter_var($_GET['info'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
$section = null;
$sectionStaff = [];
$sectionCovers = [];
$sectionDepartments = [];
$sectionAnnouncements = [];

if ($sectionId) {
    try {
        $query = $bdd->prepare('SELECT id, titre, resume FROM faculte WHERE id = ? LIMIT 1');
        $query->execute([$sectionId]);
        $section = $query->fetch() ?: null;
        if ($section) {
            $query = $bdd->prepare('SELECT noms, fonction, photo FROM personnel WHERE faculte = ? AND valider = 1 ORDER BY id DESC');
            $query->execute([$sectionId]);
            $sectionStaff = $query->fetchAll();
            $query = $bdd->prepare('SELECT photo_cv FROM couverture WHERE faculte = ? ORDER BY id_cv DESC');
            $query->execute([$sectionId]);
            $sectionCovers = $query->fetchAll();
            $query = $bdd->prepare('SELECT id, titre, resume FROM departement WHERE faculte = ? ORDER BY titre ASC');
            $query->execute([$sectionId]);
            $sectionDepartments = $query->fetchAll();
            $query = $bdd->prepare('SELECT resumer FROM annonce WHERE faculte = ? ORDER BY id DESC');
            $query->execute([$sectionId]);
            $sectionAnnouncements = $query->fetchAll();
        }
    } catch (PDOException $exception) {
        error_log('ISP-GOMBE section detail could not be loaded.');
    }
}
