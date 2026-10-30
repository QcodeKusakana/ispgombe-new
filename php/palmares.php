<?php
$annee = $bdd->query("SELECT DISTINCT anne AS intitule FROM palmaresetudiant WHERE anne IS NOT NULL AND TRIM(anne) <> '' ORDER BY anne DESC")->fetchAll();
