<section class="page-intro section-space">
    <div class="institution-container">
        <p class="eyebrow eyebrow-dark">Données personnelles</p>
        <h1 class="page-title">Confidentialité</h1>
        <p class="page-lead">Les données utilisées par les formulaires et les espaces du site, et la façon dont elles sont protégées.</p>
    </div>
</section>
<section class="policy-content section-space"><div class="institution-container">
    <div class="policy-notice"><span class="policy-notice-mark" aria-hidden="true">i</span><p><strong>Politique à valider par l’établissement.</strong> Le responsable officiel du traitement, les durées de conservation et les procédures de demande doivent être confirmés par l’ISP-GOMBE.</p></div>
    <div class="policy-layout">
        <div class="policy-main">
            <article class="policy-card"><p class="eyebrow eyebrow-dark">01 · Collecte</p><h2>Données traitées</h2><p>Le formulaire de contact recueille le nom, l’adresse e-mail, l’objet et le message afin que l’administration puisse traiter la demande. Les messages sont enregistrés dans la boîte de réception de l’administration. Les notifications e-mail ne sont pas activées dans cette installation.</p><p>L’espace étudiant utilise une session authentifiée pour afficher le profil, les communications de promotion et les pièces d’inscription associées au compte connecté. Les pièces ne sont transmises qu’après vérification de cette session.</p></article>
            <article class="policy-card"><p class="eyebrow eyebrow-dark">02 · Protection</p><h2>Sécurité et conservation</h2><p>Les formulaires utilisent une protection CSRF et les accès privés sont vérifiés côté serveur. Le site utilise un cookie de session nécessaire à la connexion.</p><p>Une durée officielle de conservation des messages et documents doit encore être définie par l’établissement.</p></article>
        </div>
        <aside class="policy-contact"><p class="eyebrow">Besoin d’aide ?</p><h2>Contacter l’administration</h2><p>Pour une demande relative aux données personnelles, écrivez à l’adresse de contact de l’ISP-GOMBE.</p><a href="mailto:<?= rawurlencode($siteSettings['contact_email'] ?? 'contact@ispgombe.ac.cd') ?>"><?= htmlspecialchars($siteSettings['contact_email'] ?? 'contact@ispgombe.ac.cd', ENT_QUOTES, 'UTF-8') ?></a><a class="policy-contact-link" href="?pages=contact">Ouvrir la page de contact <span aria-hidden="true">↗</span></a></aside>
    </div>
</div></section>
