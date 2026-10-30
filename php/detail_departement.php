<?php
$departmentId = filter_var($_GET['dep'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
$department = null;
$departmentStaff = [];
$departmentCovers = [];
$departmentPrograms = [];
$departmentAnnouncements = [];
$departmentMembers = [];

if ($departmentId) {
    try {
        $query = $bdd->prepare('SELECT d.id, d.titre, d.resume, d.faculte, f.titre AS section_title FROM departement d LEFT JOIN faculte f ON f.id = d.faculte WHERE d.id = ? LIMIT 1');
        $query->execute([$departmentId]);
        $department = $query->fetch() ?: null;
        if ($department) {
            $query = $bdd->prepare('SELECT noms, fonction, photo FROM personnel WHERE departement = ? AND valider = 1 ORDER BY id DESC');
            $query->execute([$departmentId]);
            $departmentStaff = $query->fetchAll();
            $query = $bdd->prepare('SELECT photo_cv FROM couverture WHERE departement = ? ORDER BY id_cv DESC');
            $query->execute([$departmentId]);
            $departmentCovers = $query->fetchAll();
            $query = $bdd->prepare('SELECT titre FROM optioner WHERE departement = ? ORDER BY id DESC');
            $query->execute([$departmentId]);
            $departmentPrograms = $query->fetchAll();
            $query = $bdd->prepare('SELECT resumer FROM annonce WHERE departement = ? ORDER BY id DESC');
            $query->execute([$departmentId]);
            $departmentAnnouncements = $query->fetchAll();
            $query = $bdd->prepare('SELECT noms, grade, domaine, mail, photo FROM agent_dep WHERE departement = ? AND valider = 1 ORDER BY id DESC');
            $query->execute([$departmentId]);
            $departmentMembers = $query->fetchAll();
        }
    } catch (PDOException $exception) {
        error_log('ISP-GOMBE department detail could not be loaded.');
    }
}
