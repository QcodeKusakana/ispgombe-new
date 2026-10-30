<?php
$departmentId = filter_var($_GET['dep'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
$sessionId = filter_var($_GET['ss'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
$academicYear = is_string($_GET['an'] ?? null) && preg_match('/^\d{4}(?:-\d{4})?$/', $_GET['an']) ? $_GET['an'] : null;
$selectedDepartment = null;
$selectedSession = null;
$niveau = [];
if ($departmentId) {
    $statement = $bdd->prepare('SELECT titre FROM departement WHERE id = ? LIMIT 1');
    $statement->execute([$departmentId]);
    $selectedDepartment = $statement->fetchColumn() ?: null;
}
if ($sessionId) {
    $statement = $bdd->prepare('SELECT nom_s FROM sessions WHERE id = ? LIMIT 1');
    $statement->execute([$sessionId]);
    $selectedSession = $statement->fetchColumn() ?: null;
}
if ($departmentId && $sessionId && $academicYear && $selectedDepartment && $selectedSession) {
    $statement = $bdd->prepare('SELECT n.id, n.titre FROM niveau n WHERE EXISTS (SELECT 1 FROM palmaresetudiant pe WHERE pe.niveau = n.id AND pe.departement = ? AND pe.session = ? AND pe.anne = ?) ORDER BY n.titre ASC');
    $statement->execute([(int) $departmentId, (int) $sessionId, $academicYear]);
    $niveau = $statement->fetchAll();
}
