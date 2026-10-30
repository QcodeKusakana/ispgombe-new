<?php
require_once __DIR__ . '/ajax_helper.php';
$id = ajax_positive_id('faculteID');
if ($id === null) { exit; }
$query = $bdd->prepare('SELECT id, titre FROM departement WHERE faculte = ? ORDER BY titre');
$query->execute([$id]);
ajax_render_options($query, '-- Sélectionner un département --', 'id', 'titre');
