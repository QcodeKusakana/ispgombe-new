<?php
$communiqueMessage = null;
$communiqueEdit = null;
$communiqueRows = [];
$promotionRows = [];
if ($bdd instanceof PDO) {
    admin_handle_record_action($bdd, 'communiques', 'communique', 'id', ['delete' => null]);
    try {
        $promotionRows = $bdd->query('SELECT id, titre FROM promotion ORDER BY titre')->fetchAll();
        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST' && isset($_POST['save_communique'])) {
            if (!csrf_is_valid($_POST['csrf_token'] ?? null)) {
                throw new RuntimeException('Le formulaire a expiré. Rechargez la page puis réessayez.');
            }
            $id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]) ?: 0;
            $title = is_string($_POST['titre'] ?? null) ? trim($_POST['titre']) : '';
            $content = is_string($_POST['contenu'] ?? null) ? trim($_POST['contenu']) : '';
            $promotion = filter_var($_POST['promotion'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
            if ($title === '' || mb_strlen($title, 'UTF-8') > 255 || $content === '' || admin_rich_text_text_length($content) > 10000) {
                throw new RuntimeException('Le titre et le texte du communiqué sont obligatoires et doivent respecter les limites indiquées.');
            }
            if (!$promotion || !in_array((int) $promotion, array_map(static fn($row) => (int) $row['id'], $promotionRows), true)) {
                throw new RuntimeException('La promotion choisie est introuvable.');
            }
            if ($id > 0) {
                $statement = $bdd->prepare('UPDATE communique SET titre = ?, contenu = ?, promotion = ?, datepub = NOW() WHERE id = ?');
                $statement->execute([$title, $content, $promotion ?: null, $id]);
                admin_log_action($bdd, 'notice.update', 'communique', (string) $id);
                $communiqueMessage = 'Le communiqué a été mis à jour.';
            } else {
                $statement = $bdd->prepare('INSERT INTO communique (titre, contenu, promotion, datepub) VALUES (?, ?, ?, NOW())');
                $statement->execute([$title, $content, $promotion ?: null]);
                admin_log_action($bdd, 'notice.create', 'communique', (string) $bdd->lastInsertId());
                $communiqueMessage = 'Le communiqué a été publié.';
            }
        }
        $editId = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
        if ($editId) {
            $statement = $bdd->prepare('SELECT id, titre, contenu, promotion FROM communique WHERE id = ?');
            $statement->execute([$editId]);
            $communiqueEdit = $statement->fetch() ?: null;
        }
        $communiqueRows = $bdd->query('SELECT c.id, c.titre, c.datepub, c.promotion, p.titre AS promotion_titre FROM communique c LEFT JOIN promotion p ON p.id = c.promotion ORDER BY c.datepub DESC LIMIT 100')->fetchAll();
    } catch (Throwable $e) {
        error_log('ISP-GOMBE communique management failed.');
        $communiqueMessage = ['type' => 'danger', 'text' => $e instanceof RuntimeException ? $e->getMessage() : 'Les communiqués ne sont pas disponibles.'];
    }
}
?>



