<?php
$facultyId = filter_var($_GET['fac'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
$academicYear = is_string($_GET['an'] ?? null) && preg_match('/^\d{4}(?:-\d{4})?$/', $_GET['an']) ? $_GET['an'] : null;
$activeFaculty = null;
if ($facultyId) {
    $facultyName = $bdd->prepare('SELECT titre FROM faculte WHERE id = ? LIMIT 1');
    $facultyName->execute([(int) $facultyId]);
    $activeFaculty = $facultyName->fetchColumn() ?: null;
}
if ($academicYear !== null && $facultyId) {
    $departement = $bdd->prepare('SELECT d.id, d.titre, f.titre AS section_titre FROM departement d INNER JOIN faculte f ON f.id = d.faculte WHERE d.faculte = ? AND EXISTS (SELECT 1 FROM palmaresetudiant pe WHERE pe.departement = d.id AND pe.anne = ?) ORDER BY d.titre ASC');
    $departement->execute([(int) $facultyId, $academicYear]);
} elseif ($academicYear !== null) {
    $departement = $bdd->prepare('SELECT d.id, d.titre, f.titre AS section_titre FROM departement d LEFT JOIN faculte f ON f.id = d.faculte WHERE EXISTS (SELECT 1 FROM palmaresetudiant pe WHERE pe.departement = d.id AND pe.anne = ?) ORDER BY f.titre, d.titre');
    $departement->execute([$academicYear]);
} elseif ($facultyId) {
    $departement = $bdd->prepare('SELECT d.id, d.titre, f.titre AS section_titre FROM departement d LEFT JOIN faculte f ON f.id = d.faculte WHERE d.faculte = ? ORDER BY d.titre ASC');
    $departement->execute([(int) $facultyId]);
} else {
    $departement = $bdd->query('SELECT d.id, d.titre, f.titre AS section_titre FROM departement d LEFT JOIN faculte f ON f.id = d.faculte ORDER BY f.titre, d.titre');
}
$departements = $departement->fetchAll();
