<?php
require_once __DIR__ . '/ajax_helper.php';
$id = ajax_positive_id('departement2ID');
if ($id === null) { exit; }
$query = $bdd->prepare('SELECT id, titre FROM optioner WHERE departement = ? ORDER BY titre');
$query->execute([$id]);
ajax_render_options($query, '-- Sélectionner une option --', 'id', 'titre');
