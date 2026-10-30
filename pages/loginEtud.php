<section class="page-intro section-space student-login-intro">
    <div class="institution-container">
        <p class="eyebrow eyebrow-dark">Services aux étudiants</p>
        <h1 class="page-title">Espace <em>étudiant</em></h1>
        <p class="page-lead">Connectez-vous avec votre matricule pour accéder à vos informations académiques et aux documents disponibles.</p>
    </div>
</section>
<section class="student-login-section section-space" aria-labelledby="student-login-title">
    <div class="institution-container student-login-layout">
        <div class="student-login-aside">
            <span class="login-monogram" aria-hidden="true">ISP</span>
            <p class="eyebrow">Portail étudiant</p>
            <h2 id="student-login-title">Votre parcours<br><em>académique.</em></h2>
            <p>Un espace sécurisé pour consulter les communications et les informations liées à votre dossier.</p>
        </div>
        <div class="student-login-card">
            <p class="eyebrow eyebrow-dark">Connexion sécurisée</p>
            <h2>Accéder à mon espace</h2>
            <?php if (isset($erreur)): ?><p class="form-feedback form-feedback-error" role="alert"><?= htmlspecialchars($erreur, ENT_QUOTES, 'UTF-8') ?></p><?php endif; ?>
            <form method="post" class="institution-form student-login-form">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>">
                <div class="form-field">
                    <label for="student-matricule">Numéro matricule</label>
                    <input id="student-matricule" name="utilisateur" type="text" autocomplete="username" required>
                </div>
                <div class="form-field">
                    <label for="student-password">Mot de passe</label>
                    <input id="student-password" name="mdp" type="password" autocomplete="current-password" required>
                </div>
                <button class="button button-gold" type="submit" name="login">Se connecter <span aria-hidden="true">→</span></button>
            </form>
            <p class="login-help">Un problème de connexion ? <a href="?pages=contact">Contacter l’administration</a>.</p>
        </div>
    </div>
</section>

