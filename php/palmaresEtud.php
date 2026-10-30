<?php
$departmentId = filter_var($_GET['dep'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
$sessionId = filter_var($_GET['ss'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
$levelId = filter_var($_GET['niv'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
$academicYear = is_string($_GET['an'] ?? null) && preg_match('/^\d{4}(?:-\d{4})?$/', $_GET['an']) ? $_GET['an'] : null;
$palmaresEtud = [];
$infoDep = null;
$infoNiv = null;
if ($departmentId && $sessionId && $levelId && $academicYear) {
    $department = $bdd->prepare('SELECT titre FROM departement WHERE id = ? LIMIT 1');
    $department->execute([$departmentId]);
    $infoDep = $department->fetchColumn() ?: null;
    $level = $bdd->prepare('SELECT titre FROM niveau WHERE id = ? LIMIT 1');
    $level->execute([$levelId]);
    $infoNiv = $level->fetchColumn() ?: null;
    if ($infoDep && $infoNiv) {
        $statement = $bdd->prepare('SELECT noms FROM palmaresetudiant WHERE departement = ? AND anne = ? AND session = ? AND niveau = ? ORDER BY noms ASC');
        $statement->execute([$departmentId, $academicYear, $sessionId, $levelId]);
        $palmaresEtud = $statement->fetchAll(PDO::FETCH_COLUMN);
    }
}
