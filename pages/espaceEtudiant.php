<?php
if (empty($_SESSION['id'])) {
    header('Location:?pages=loginEtud');
    exit;
}
require_once __DIR__ . '/../php/main_function.php';
require_once __DIR__ . '/../php/espaceEtudiant.php';
?>
<section class="student-dashboard section-space">
    <div class="institution-container">
        <p class="eyebrow eyebrow-dark">Espace personnel</p>
        <div class="section-heading student-heading">
            <div><h1 class="page-title">Bonjour, <?= htmlspecialchars($et['prenom'], ENT_QUOTES, 'UTF-8') ?></h1><p class="page-lead">Vos informations académiques et les communications destinées à votre promotion.</p></div>
            <form method="post" action="?pages=deconnexion"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>"><button class="button button-outline button-outline-dark" type="submit">Se déconnecter</button></form>
        </div>
        <?php if (isset($erreurs)): ?><div class="alert alert-danger" role="alert"><?= htmlspecialchars($erreurs, ENT_QUOTES, 'UTF-8') ?></div><?php endif; ?>
        <div class="student-grid">
            <section class="student-panel" aria-labelledby="profile-title">
                <h2 id="profile-title">Mon profil</h2>
                <dl class="student-details">
                    <div><dt>Nom</dt><dd><?= htmlspecialchars($et['nom'] . ' ' . $et['postnom'], ENT_QUOTES, 'UTF-8') ?></dd></div>
                    <div><dt>Prénom</dt><dd><?= htmlspecialchars($et['prenom'], ENT_QUOTES, 'UTF-8') ?></dd></div>
                    <div><dt>Matricule</dt><dd><?= htmlspecialchars($et['matricule'], ENT_QUOTES, 'UTF-8') ?></dd></div>
                    <div><dt>Promotion</dt><dd><?= htmlspecialchars($prom['titre'], ENT_QUOTES, 'UTF-8') ?></dd></div>
                    <div><dt>Option</dt><dd><?= htmlspecialchars($opt['titre'], ENT_QUOTES, 'UTF-8') ?></dd></div>
                    <div><dt>Téléphone</dt><dd><?= htmlspecialchars($et['telephone'], ENT_QUOTES, 'UTF-8') ?></dd></div>
                </dl>
            </section>
            <section class="student-panel" aria-labelledby="password-title">
                <h2 id="password-title">Changer mon mot de passe</h2>
                <p>Choisissez un nouveau mot de passe d’au moins 12 caractères.</p>
                <form method="post" class="student-password-form">
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>">
                    <label for="telephone">Téléphone</label><input class="form-control" type="tel" id="telephone" name="telephone" value="<?= htmlspecialchars($et['telephone'], ENT_QUOTES, 'UTF-8') ?>" required>
                    <label for="old-password">Mot de passe actuel</label><input class="form-control" type="password" id="old-password" name="mdp" autocomplete="current-password" required>
                    <label for="new-password">Nouveau mot de passe</label><input class="form-control" type="password" id="new-password" name="mdp2" minlength="12" autocomplete="new-password" required>
                    <button class="button button-gold" type="submit" name="modifier">Mettre à jour</button>
                </form>
            </section>
        </div>
        <section class="student-panel student-announcements" aria-labelledby="announcements-title">
            <h2 id="announcements-title">Communications de ma promotion</h2>
            <?php if ($communiques): ?>
                <?php foreach ($communiques as $communique): ?>
                    <article class="student-announcement"><p class="news-date"><?= htmlspecialchars((string) $communique['datepub'], ENT_QUOTES, 'UTF-8') ?></p><h3><?= htmlspecialchars((string) $communique['titre'], ENT_QUOTES, 'UTF-8') ?></h3><div class="student-announcement-content"><?= admin_sanitize_rich_text((string) $communique['contenu']) ?></div></article>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucun communiqué n’est disponible pour votre promotion.</p>
            <?php endif; ?>
        </section>
        <section class="student-panel student-documents" aria-labelledby="documents-title">
            <h2 id="documents-title">Mes pièces d’inscription</h2>
            <p>Téléchargez uniquement les documents associés à votre propre dossier.</p>
            <ul class="student-document-list">
                <?php foreach ($studentDocuments as $document): ?>
                    <li><span><?= htmlspecialchars($document['label'], ENT_QUOTES, 'UTF-8') ?></span>
                        <?php if (!empty($et[$document['column']])): ?>
                            <a class="button button-outline button-outline-dark" href="student_download.php?document=<?= rawurlencode($document['key']) ?>">Télécharger</a>
                        <?php else: ?>
                            <span class="text-muted">Non fourni</span>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
            <p class="student-note">Les relevés de résultats et documents académiques officiels sont délivrés par les services compétents.</p>
        </section>
    </div>
</section>
