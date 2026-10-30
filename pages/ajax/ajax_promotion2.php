<?php
require_once __DIR__ . '/ajax_helper.php';
$id = ajax_positive_id('option2ID');
if ($id === null) { exit; }
$query = $bdd->prepare("SELECT id, titre FROM promotion WHERE optioner = ? AND titre NOT IN ('G2','L2','G3') ORDER BY titre");
$query->execute([$id]);
ajax_render_options($query, '-- Sélectionner une promotion --', 'id', 'titre');
