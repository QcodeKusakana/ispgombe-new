<?php
require_once __DIR__ . '/ajax_helper.php';
$id = ajax_positive_id('provinceID');
if ($id === null) { exit; }
$query = $bdd->prepare('SELECT id_tr, nom_tr FROM territoires WHERE id_p = ? ORDER BY nom_tr');
$query->execute([$id]);
ajax_render_options($query, '-- Sélectionner un territoire --', 'id_tr', 'nom_tr');
