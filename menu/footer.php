<footer class="site-footer">
    <div class="institution-container footer-grid">
        <div>
            <a class="footer-brand" href="?pages=home"><img src="images/isp-gombe-logo.jpg" width="56" height="56" alt=""> <span>ISP-GOMBE</span></a>
            <p>Institut Supérieur Pédagogique de la Gombe<br>Kinshasa, République démocratique du Congo</p>
        </div>
        <div>
            <h2>Explorer</h2>
            <a href="?pages=isp">L’Institut</a>
            <a href="?pages=isp&amp;mission">Mission et création</a>
            <a href="?pages=isp&amp;direction">Autorités de l’Institut</a>
            <a href="?pages=isp&amp;recherche">Recherche et bibliothèque</a>
        </div>
        <div>
            <h2>Formations et vie</h2>
            <a href="?pages=faculte">Sections organisées</a>
            <a href="?pages=departement">Départements</a>
            <a href="?pages=campus">Vie de campus</a>
            <a href="?pages=actualite">Actualités</a>
            <a href="?pages=evenement">Événements</a>
            <a href="?pages=palmares">Palmarès</a>
        </div>
        <div>
            <h2>Services</h2>
            <a href="?pages=inscription">Préinscription</a>
            <a href="?pages=loginEtud">Espace étudiant</a>
            <a href="?pages=contact">Nous contacter</a>
            <a href="?pages=confidentialite">Confidentialité</a>
        </div>
        <div>
            <h2>Nous trouver</h2>
            <p><?= nl2br(htmlspecialchars($siteSettings['contact_address'] ?? "Avenue Père Boka, au croisement de l’avenue Kisangani — Commune de la Gombe, Kinshasa", ENT_QUOTES, "UTF-8")) ?></p>
            <a href="mailto:<?= rawurlencode($siteSettings['contact_email'] ?? "contact@ispgombe.ac.cd") ?>"><?= htmlspecialchars($siteSettings['contact_email'] ?? "contact@ispgombe.ac.cd", ENT_QUOTES, "UTF-8") ?></a>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="institution-container">© <?= date('Y') ?> ISP-GOMBE <span>·</span> Site institutionnel</div>
    </div>
</footer>

