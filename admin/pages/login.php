<main id="main" class="admin-login-main">
    <div class="admin-login-shell">
        <section class="admin-login-identity" aria-label="Institut Supérieur Pédagogique de la Gombe">
            <a href="../?pages=home" class="admin-login-brand" aria-label="Retour au site de l’ISP-GOMBE">
                <img class="admin-brand-logo" src="../images/isp-gombe-logo.jpg" alt="">
                <span>ISP-GOMBE <small>Institut Supérieur Pédagogique de la Gombe</small></span>
            </a>
            <div class="admin-login-message">
                <span class="admin-login-kicker"><i class="bi bi-mortarboard-fill" aria-hidden="true"></i> Portail institutionnel</span>
                <h1>Un espace dédié à la gestion de l’Institut.</h1>
                <p>Administrez les contenus, les formations et les informations officielles de l’ISP-GOMBE depuis un espace unique.</p>
            </div>
            <div class="admin-login-security"><span class="admin-login-security-icon"><i class="bi bi-shield-lock" aria-hidden="true"></i></span><span><strong>Accès sécurisé</strong><small>Réservé aux comptes autorisés</small></span></div>
            <p class="admin-login-location"><i class="bi bi-geo-alt" aria-hidden="true"></i> Kinshasa · République démocratique du Congo</p>
        </section>

        <section class="admin-login-form-panel" aria-labelledby="admin-login-title">
            <div class="admin-login-form-wrap">
                <p class="admin-login-eyebrow">Administration</p>
                <h2 id="admin-login-title">Bienvenue</h2>
                <p class="admin-login-intro">Connectez-vous avec vos identifiants administrateur.</p>
                <?php if (isset($erreur)): ?><div class="alert alert-danger admin-login-error" role="alert"><i class="bi bi-exclamation-circle-fill" aria-hidden="true"></i><span><?= htmlspecialchars((string) $erreur, ENT_QUOTES, 'UTF-8') ?></span></div><?php endif; ?>

                <form class="admin-login-form" method="post">
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>">
                    <div class="admin-login-field">
                        <label for="yourUsername">Nom d’utilisateur</label>
                        <div class="admin-login-input-wrap"><i class="bi bi-person" aria-hidden="true"></i><input type="text" name="pseudo" id="yourUsername" autocomplete="username" autocapitalize="none" spellcheck="false" required autofocus></div>
                    </div>
                    <div class="admin-login-field">
                        <label for="yourPassword">Mot de passe</label>
                        <div class="admin-login-input-wrap"><i class="bi bi-lock" aria-hidden="true"></i><input type="password" name="password" id="yourPassword" autocomplete="current-password" required></div>
                    </div>
                    <button class="admin-login-submit" name="login" type="submit"><span>Se connecter</span><i class="bi bi-arrow-right" aria-hidden="true"></i></button>
                </form>

                <p class="admin-login-help"><i class="bi bi-info-circle" aria-hidden="true"></i><span>Pour créer un compte ou réinitialiser vos accès, contactez le service de gestion des comptes.</span></p>
                <a class="admin-login-back" href="../?pages=home"><i class="bi bi-arrow-left" aria-hidden="true"></i> Retour au site public</a>
            </div>
            <footer class="admin-login-form-footer">© <?= date('Y') ?> ISP-GOMBE <span>·</span> Espace d’administration</footer>
        </section>
    </div>
</main>


