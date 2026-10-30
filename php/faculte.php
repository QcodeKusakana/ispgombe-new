<?php
$academicYear = is_string($_GET['an'] ?? null) && preg_match('/^\d{4}(?:-\d{4})?$/', $_GET['an']) ? $_GET['an'] : null;
if ($academicYear !== null) {
    $faculte = $bdd->prepare('SELECT f.id, f.titre, (SELECT COUNT(*) FROM departement d WHERE d.faculte = f.id AND EXISTS (SELECT 1 FROM palmaresetudiant pe WHERE pe.departement = d.id AND pe.anne = ?)) AS department_count FROM faculte f WHERE EXISTS (SELECT 1 FROM departement d INNER JOIN palmaresetudiant pe ON pe.departement = d.id WHERE d.faculte = f.id AND pe.anne = ?) ORDER BY f.titre ASC');
    $faculte->execute([$academicYear, $academicYear]);
} else {
    $faculte = $bdd->query('SELECT f.id, f.titre, (SELECT COUNT(*) FROM departement d WHERE d.faculte = f.id) AS department_count FROM faculte f ORDER BY f.titre ASC');
}
