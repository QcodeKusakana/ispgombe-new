<?php
$article = null;
$recentArticles = [];
$articleId = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);

if ($articleId) {
    $statement = $bdd->prepare('SELECT id_act, titre, description, photo, date_pub FROM activite WHERE id_act = ? AND etat_modifier = 1 LIMIT 1');
    $statement->execute([$articleId]);
    $article = $statement->fetch() ?: null;
}

if ($article) {
    $statement = $bdd->query('SELECT id_act, titre, photo, date_pub FROM activite WHERE etat_modifier = 1 ORDER BY date_pub DESC, id_act DESC LIMIT 6');
    $recentArticles = $statement->fetchAll();
} else {
    http_response_code(404);
}
?>
