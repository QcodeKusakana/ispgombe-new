<?php
$perPage = 9;
$total = (int) $bdd->query('SELECT COUNT(*) FROM activite WHERE etat_modifier = 1')->fetchColumn();
$nbPage = max(1, (int) ceil($total / $perPage));
$requestedPage = filter_var($_GET['pag'] ?? 1, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
$current = min($requestedPage ?: 1, $nbPage);
$offset = ($current - 1) * $perPage;
$statement = $bdd->prepare('SELECT id_act, titre, description, photo, categorie, date_pub FROM activite WHERE etat_modifier = 1 ORDER BY date_pub DESC, id_act DESC LIMIT :offset, :page_size');
$statement->bindValue(':offset', $offset, PDO::PARAM_INT);
$statement->bindValue(':page_size', $perPage, PDO::PARAM_INT);
$statement->execute();
$actualiteItems = $statement->fetchAll();
?>
