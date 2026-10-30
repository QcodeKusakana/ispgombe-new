<?php
require_once __DIR__ . '/ajax_helper.php';
$id = ajax_positive_id('profID');
if ($id === null) { exit; }
$query = $bdd->prepare("SELECT DISTINCT prof.id, CONCAT_WS(' ', prof.prenom, prof.nom) AS nom_complet FROM affectcours INNER JOIN prof ON prof.id = affectcours.prof WHERE affectcours.cours = ? ORDER BY prof.nom, prof.prenom");
$query->execute([$id]);
ajax_render_options($query, '-- Sélectionner un enseignant --', 'id', 'nom_complet');
