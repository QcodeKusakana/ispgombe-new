<?php
$departmentId = filter_var($_GET['dep'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
$academicYear = is_string($_GET['an'] ?? null) && preg_match('/^\d{4}(?:-\d{4})?$/', $_GET['an']) ? $_GET['an'] : null;
$selectedDepartment = null;
if ($departmentId) {
    $departmentQuery = $bdd->prepare('SELECT titre FROM departement WHERE id = ? LIMIT 1');
    $departmentQuery->execute([$departmentId]);
    $selectedDepartment = $departmentQuery->fetchColumn() ?: null;
}
if ($departmentId && $academicYear && $selectedDepartment) {
    $session = $bdd->prepare('SELECT s.id, s.nom_s FROM sessions s WHERE EXISTS (SELECT 1 FROM palmaresetudiant pe WHERE pe.session = s.id AND pe.departement = ? AND pe.anne = ?) ORDER BY s.nom_s DESC');
    $session->execute([(int) $departmentId, $academicYear]);
    $session = $session->fetchAll();
} else {
    $session = [];
}
