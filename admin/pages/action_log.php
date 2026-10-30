<?php
if ((int) ($_SESSION['niveau'] ?? 0) !== 7) {
    http_response_code(403);
    exit('Accès réservé au super-administrateur.');
}
$entries = [];
$logUnavailable = false;
if ($bdd instanceof PDO) {
    try {
        $entries = $bdd->query('SELECT id, actor_name, action_name, target_type, target_id, details_json, created_at FROM admin_action_log ORDER BY id DESC LIMIT 200')->fetchAll();
    } catch (Throwable $exception) {
        $logUnavailable = true;
    }
}
?>
<main id="main" class="main">
    <div class="pagetitle"><h1>Journal des actions sensibles</h1><p>Les 200 dernières opérations administratives consignées. Les mots de passe, documents et contenus de formulaires ne sont jamais enregistrés ici.</p></div>
    <?php if ($logUnavailable): ?><div class="alert alert-warning">Appliquez la migration <code>20261028_02_create_admin_action_log.sql</code> pour activer le journal.</div><?php endif; ?>
    <section class="section"><div class="card"><div class="card-body table-responsive">
        <table class="table table-striped"><thead><tr><th>Date</th><th>Administrateur</th><th>Action</th><th>Cible</th><th>Détails limités</th></tr></thead><tbody>
        <?php foreach ($entries as $entry): ?>
            <tr>
                <td><?= htmlspecialchars((string) $entry['created_at'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars((string) $entry['actor_name'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars((string) $entry['action_name'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars((string) $entry['target_type'] . ' #' . ($entry['target_id'] ?? '—'), ENT_QUOTES, 'UTF-8') ?></td>
                <td><code><?= htmlspecialchars((string) $entry['details_json'], ENT_QUOTES, 'UTF-8') ?></code></td>
            </tr>
        <?php endforeach; ?>
        <?php if (!$entries && !$logUnavailable): ?><tr><td colspan="5">Aucune action enregistrée.</td></tr><?php endif; ?>
        </tbody></table>
    </div></div></section>
</main>
