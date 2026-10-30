<?php
if (isset($_POST['compte'])) {
    $pseudo = trim((string) ($_POST['pseudo'] ?? ''));
    $mail = trim((string) ($_POST['mail'] ?? ''));
    $password = (string) ($_POST['password'] ?? '');
    $password2 = (string) ($_POST['password2'] ?? '');
    if (!csrf_is_valid($_POST['csrf_token'] ?? null)) {
        $errprs = 'La session du formulaire a expiré. Rechargez la page puis réessayez.';
    } elseif ($pseudo === '' || !filter_var($mail, FILTER_VALIDATE_EMAIL) || $password === '' || $password !== $password2) {
        $errprs = 'Vérifiez le nom, l’adresse e-mail et la confirmation du mot de passe.';
    } elseif (strlen($password) < 12) {
        $errprs = 'Le mot de passe doit contenir au moins 12 caractères.';
    } elseif ($bdd instanceof PDO) {
        insert_register($pseudo, $mail, password_hash($password, PASSWORD_DEFAULT));
        $errpr = 'Demande de compte enregistrée. Un administrateur doit encore l’activer.';
    }
}
?>
<section class="container py-5">
    <div class="row justify-content-center"><div class="col-lg-6">
        <h1 class="h3 mb-4">Créer un compte administrateur</h1>
        <?php if (isset($errprs)): ?><div class="alert alert-danger" role="alert"><?= htmlspecialchars($errprs, ENT_QUOTES, 'UTF-8') ?></div><?php endif; ?>
        <?php if (isset($errpr)): ?><div class="alert alert-success" role="status"><?= htmlspecialchars($errpr, ENT_QUOTES, 'UTF-8') ?></div><?php endif; ?>
        <form method="post" autocomplete="off">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>">
            <div class="mb-3"><label class="form-label" for="pseudo">Nom d’utilisateur</label><input class="form-control" id="pseudo" name="pseudo" required maxlength="50"></div>
            <div class="mb-3"><label class="form-label" for="mail">Adresse e-mail</label><input class="form-control" type="email" id="mail" name="mail" required maxlength="50"></div>
            <div class="mb-3"><label class="form-label" for="password">Mot de passe (12 caractères minimum)</label><input class="form-control" type="password" id="password" name="password" required minlength="12" autocomplete="new-password"></div>
            <div class="mb-3"><label class="form-label" for="password2">Confirmer le mot de passe</label><input class="form-control" type="password" id="password2" name="password2" required minlength="12" autocomplete="new-password"></div>
            <button class="btn btn-primary" type="submit" name="compte">Envoyer la demande</button>
        </form>
    </div></div>
</section>
