<?php
$_SESSION['contact_form_started_at'] = time();
$contactFormTimestamp = $_SESSION['contact_form_started_at'];
$contactFormMessage = $_SESSION['contact_form_message'] ?? null;
unset($_SESSION['contact_form_message']);
?>
<section class="page-intro section-space contact-intro">
    <div class="institution-container">
        <p class="eyebrow eyebrow-dark">Administration de l’établissement</p>
        <h1 class="page-title">Nous <em>contacter</em></h1>
        <p class="page-lead">Pour une demande d’information, une question sur les formations ou une démarche administrative, écrivez à l’ISP-GOMBE.</p>
    </div>
</section>
<section id="contact" class="contact-section section-space" aria-labelledby="contact-form-title">
    <div class="institution-container contact-layout">
        <div class="contact-form-card">
            <p class="eyebrow eyebrow-dark">En ligne</p>
            <h2 id="contact-form-title">Envoyer un message</h2>
            <?php if ($contactFormMessage): ?><div class="form-feedback form-feedback-<?= htmlspecialchars($contactFormMessage['type'], ENT_QUOTES, 'UTF-8') ?>" role="<?= $contactFormMessage['type'] === 'danger' ? 'alert' : 'status' ?>"><?= htmlspecialchars($contactFormMessage['text'], ENT_QUOTES, 'UTF-8') ?></div><?php endif; ?>
            <form method="post" class="institution-form">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>">
                <input type="hidden" name="form_started_at" value="<?= (int) $contactFormTimestamp ?>">
                <div class="contact-honeypot" aria-hidden="true"><label for="website">Laisser ce champ vide</label><input type="text" name="website" id="website" tabindex="-1" autocomplete="off"></div>
                <div class="form-field"><label for="name">Nom complet</label><input class="form-control" name="name" id="name" type="text" autocomplete="name" maxlength="200" required></div>
                <div class="form-field"><label for="email">Adresse e-mail</label><input class="form-control" name="email" id="email" type="email" autocomplete="email" maxlength="100" required></div>
                <div class="form-field"><label for="subject">Objet de votre demande</label><input class="form-control" name="subject" id="subject" type="text" maxlength="100" required></div>
                <div class="form-field"><label for="message">Votre message</label><textarea class="form-control" name="message" id="message" rows="5" maxlength="10000" required></textarea></div>
                <button class="button button-gold" type="submit">Envoyer le message <span aria-hidden="true">→</span></button>
            </form>
        </div>
        <aside class="contact-information" aria-label="Coordonnées de l’ISP-GOMBE">
            <p class="eyebrow">Coordonnées</p>
            <h2>Retrouver<br>l’ISP-GOMBE.</h2>
            <div class="contact-detail"><span>ADRESSE</span><p><?= nl2br(htmlspecialchars($siteSettings['contact_address'] ?? "Avenue Père Boka, au croisement de l’avenue Kisangani — Commune de la Gombe, Kinshasa", ENT_QUOTES, 'UTF-8')) ?></p></div>
            <div class="contact-detail"><span>E-MAIL</span><p><a href="mailto:<?= rawurlencode($siteSettings['contact_email'] ?? 'contact@ispgombe.ac.cd') ?>"><?= htmlspecialchars($siteSettings['contact_email'] ?? 'contact@ispgombe.ac.cd', ENT_QUOTES, 'UTF-8') ?></a></p></div>
            <?php if (!empty($siteSettings['contact_phone'])): ?><div class="contact-detail"><span>TÉLÉPHONE</span><p><a href="tel:<?= htmlspecialchars(preg_replace('/[^+0-9]/', '', $siteSettings['contact_phone']), ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($siteSettings['contact_phone'], ENT_QUOTES, 'UTF-8') ?></a></p></div><?php endif; ?>
            <a class="contact-back-link" href="?pages=home">Retour à l’accueil <span aria-hidden="true">↗</span></a>
        </aside>
    </div>
</section>






