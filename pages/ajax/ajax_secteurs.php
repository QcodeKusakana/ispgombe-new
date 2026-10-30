<?php
require_once __DIR__ . '/ajax_helper.php';
$id = ajax_positive_id('territoireID');
if ($id === null) { exit; }
$query = $bdd->prepare('SELECT id_sec, nom_sec FROM secteurs WHERE id_tr = ? ORDER BY nom_sec');
$query->execute([$id]);
ajax_render_options($query, '-- Sélectionner un district --', 'id_sec', 'nom_sec');
