<?php
$committeeMembers = [];
if ($bdd instanceof PDO) {
    try {
        $committeeMembers = $bdd->query('SELECT id, nom, fonction, description, photo FROM committee_member WHERE is_active = 1 ORDER BY sort_order ASC, id ASC')->fetchAll();
    } catch (PDOException $exception) {
        error_log('ISP-GOMBE public committee page could not be loaded.');
    }
}
