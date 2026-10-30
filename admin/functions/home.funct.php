<?php
$role = (int) ($_SESSION['niveau'] ?? 0);
$adminDashboardCards = match ($role) {
    7 => [['label' => 'Sections', 'table' => 'faculte', 'icon' => 'bi-mortarboard'], ['label' => 'Départements', 'table' => 'departement', 'icon' => 'bi-diagram-3'], ['label' => 'Actualités', 'table' => 'activite', 'icon' => 'bi-newspaper'], ['label' => 'Dossiers', 'table' => 'etudiant', 'icon' => 'bi-people'], ['label' => 'Messages', 'table' => 'contact', 'icon' => 'bi-envelope']],
    11 => [['label' => 'Sections', 'table' => 'faculte', 'icon' => 'bi-mortarboard'], ['label' => 'Départements', 'table' => 'departement', 'icon' => 'bi-diagram-3'], ['label' => 'Résultats', 'table' => 'palmaresetudiant', 'icon' => 'bi-journal-check']],
    12 => [['label' => 'Personnel', 'table' => 'personnel', 'icon' => 'bi-person-badge'], ['label' => 'Agents', 'table' => 'agent_dep', 'icon' => 'bi-person-workspace'], ['label' => 'Messages', 'table' => 'contact', 'icon' => 'bi-envelope']],
    13 => [['label' => 'Dossiers étudiants', 'table' => 'etudiant', 'icon' => 'bi-person-vcard']],
    default => [['label' => 'Actualités', 'table' => 'activite', 'icon' => 'bi-newspaper']],
};
$adminDashboardStats = array_fill_keys(array_column($adminDashboardCards, 'table'), null);
$adminRecentActivities = [];
if ($bdd instanceof PDO) {
    foreach (array_keys($adminDashboardStats) as $table) {
        try {
            $adminDashboardStats[$table] = (int) $bdd->query('SELECT COUNT(*) FROM `' . $table . '`')->fetchColumn();
        } catch (PDOException $e) {
            error_log('ISP-GOMBE dashboard count failed for ' . $table . '.');
        }
    }
    try {
        $adminRecentActivities = $bdd->query('SELECT id_act, titre, date_pub, etat_modifier FROM activite ORDER BY id_act DESC LIMIT 5')->fetchAll();
    } catch (PDOException $e) {
        error_log('ISP-GOMBE recent activity list failed.');
    }
}
?>
