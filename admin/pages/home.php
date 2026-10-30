<main id="main" class="main admin-dashboard">
    <div class="pagetitle admin-page-heading">
        <div><p class="admin-eyebrow">ISP-GOMBE · Administration</p><h1>Bonjour, <?= htmlspecialchars((string) ($_SESSION['pseudo'] ?? 'Administrateur'), ENT_QUOTES, 'UTF-8') ?></h1><p class="text-muted">Suivez et gérez les informations publiées sur le site institutionnel.</p></div>
        <a class="btn btn-outline-primary" href="../index.php" target="_blank" rel="noopener">Voir le site public ↗</a>
    </div>
    <section class="section">
        <div class="row g-3">
            <?php foreach ($adminDashboardCards as $stat): ?>
                <div class="col-12 col-sm-6 col-xl">
                    <article class="card admin-stat-card"><div class="card-body"><span class="admin-stat-icon"><i class="bi <?= $stat['icon'] ?>" aria-hidden="true"></i></span><p><?= htmlspecialchars($stat['label'], ENT_QUOTES, 'UTF-8') ?></p><strong><?= $adminDashboardStats[$stat['table']] === null ? '—' : number_format($adminDashboardStats[$stat['table']], 0, ',', ' ') ?></strong></div></article>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="row g-3 mt-1">
            <div class="col-12 col-xl-7">
                <section class="card h-100"><div class="card-body">
                    <div class="admin-card-heading"><div><p class="admin-eyebrow">Publication</p><h2>Dernières actualités</h2></div><a href="?pages=activite">Gérer les actualités <span aria-hidden="true">→</span></a></div>
                    <?php if ($adminRecentActivities): ?>
                        <div class="table-responsive"><table class="table align-middle"><thead><tr><th>Titre</th><th>Date</th><th>État</th></tr></thead><tbody>
                            <?php foreach ($adminRecentActivities as $activity): ?><tr><td><?= htmlspecialchars((string) $activity['titre'], ENT_QUOTES, 'UTF-8') ?></td><td><?= htmlspecialchars((string) $activity['date_pub'], ENT_QUOTES, 'UTF-8') ?></td><td><?= (int) $activity['etat_modifier'] === 1 ? 'Publié' : 'En attente' ?></td></tr><?php endforeach; ?>
                        </tbody></table></div>
                    <?php else: ?><p class="admin-empty-state">Les actualités apparaîtront ici lorsque la base sera configurée.</p><?php endif; ?>
                </div></section>
            </div>
            <div class="col-12 col-xl-5">
                <section class="card h-100"><div class="card-body"><p class="admin-eyebrow">Accès rapide</p><h2 class="admin-section-title">Gérer le site</h2>
                    <div class="admin-quick-links">
                        <?php if (admin_role_can_access_page((int) $_SESSION['niveau'], 'site_content')): ?><a href="?pages=site_content"><i class="bi bi-window-stack" aria-hidden="true"></i><span>Accueil et coordonnées</span><b>→</b></a><?php endif; ?>
                        <?php if (admin_role_can_access_page((int) $_SESSION['niveau'], 'comite_gestion')): ?><a href="?pages=comite_gestion"><i class="bi bi-people-fill" aria-hidden="true"></i><span>Comité de gestion</span><b>→</b></a><?php endif; ?>
                        <?php if (admin_role_can_access_page((int) $_SESSION['niveau'], 'activite')): ?><a href="?pages=activite"><i class="bi bi-newspaper" aria-hidden="true"></i><span>Actualités</span><b>→</b></a><?php endif; ?>
                        <?php if (admin_role_can_access_page((int) $_SESSION['niveau'], 'section')): ?><a href="?pages=section"><i class="bi bi-mortarboard" aria-hidden="true"></i><span>Sections et formations</span><b>→</b></a><?php endif; ?>
                        <?php if (admin_role_can_access_page((int) $_SESSION['niveau'], 'campus')): ?><a href="?pages=campus"><i class="bi bi-building" aria-hidden="true"></i><span>Vie de campus</span><b>→</b></a><?php endif; ?>
                        <?php if (admin_role_can_access_page((int) $_SESSION['niveau'], 'a_membre')): ?><a href="?pages=a_membre"><i class="bi bi-person-badge" aria-hidden="true"></i><span>Personnel</span><b>→</b></a><?php endif; ?>
                        <?php if (admin_role_can_access_page((int) $_SESSION['niveau'], 'messagerie')): ?><a href="?pages=messagerie"><i class="bi bi-envelope" aria-hidden="true"></i><span>Messages reçus</span><b>→</b></a><?php endif; ?>
                        <?php if (admin_role_can_access_page((int) $_SESSION['niveau'], 'candidatures')): ?><a href="?pages=candidatures"><i class="bi bi-person-vcard" aria-hidden="true"></i><span>Dossiers étudiants</span><b>→</b></a><?php endif; ?>
                        <?php if (admin_role_can_access_page((int) $_SESSION['niveau'], 'communiques')): ?><a href="?pages=communiques"><i class="bi bi-chat-square-text" aria-hidden="true"></i><span>Communiqués étudiants</span><b>→</b></a><?php endif; ?>
                        <?php if (admin_role_can_access_page((int) $_SESSION['niveau'], 'palmares')): ?><a href="?pages=palmares"><i class="bi bi-journal-check" aria-hidden="true"></i><span>Palmarès</span><b>→</b></a><?php endif; ?>
                    </div>
                </div></section>
            </div>
        </div>
    </section>
</main>

