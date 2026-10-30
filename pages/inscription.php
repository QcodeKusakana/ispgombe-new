<?php
?>
<section class="page-intro section-space admissions-intro">
    <div class="institution-container">
        <p class="eyebrow eyebrow-dark">Admissions</p>
        <h1 class="page-title">Préparer votre <em>parcours</em></h1>
        <div class="page-lead"><?= admin_sanitize_rich_text($siteSettings['admissions_notice'] ?? "Pour connaître les conditions d’admission et les pièces à fournir, contactez l’administration de l’ISP-GOMBE. Les modalités peuvent varier selon la formation et l’année académique.") ?></div>
        <a class="button button-gold" href="?pages=contact">Demander des renseignements <span aria-hidden="true">→</span></a>
    </div>
</section>
<section class="admissions-section section-space" aria-labelledby="admissions-steps-title">
    <div class="institution-container">
        <div class="section-heading"><div><p class="eyebrow eyebrow-dark">Votre démarche</p><h2 id="admissions-steps-title">Avancer étape <em>par étape</em></h2></div></div>
        <div class="admissions-grid">
            <article class="admissions-card"><span>01</span><h3>Découvrir les formations</h3><p>Parcourez les sections organisées et les départements de l’Institut pour préciser votre choix.</p><a href="?pages=faculte">Voir les sections <span aria-hidden="true">↗</span></a></article>
            <article class="admissions-card"><span>02</span><h3>Vérifier les modalités</h3><p>Les conditions, les pièces à fournir et les dates peuvent varier selon la formation et l’année académique.</p><a href="?pages=contact">Écrire à l’administration <span aria-hidden="true">↗</span></a></article>
            <article class="admissions-card"><span>03</span><h3>Préparer votre demande</h3><p>Demandez à l’établissement les consignes officielles avant de transmettre votre dossier.</p><a href="?pages=contact">Demander conseil <span aria-hidden="true">↗</span></a></article>
        </div>
        <p class="content-note admissions-note"><strong>À confirmer auprès de l’établissement.</strong> Cette page ne soumet pas de demande d’admission en ligne et ne remplace pas les consignes officielles de l’ISP-GOMBE.</p>
    </div>
</section>

