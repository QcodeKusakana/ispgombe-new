<main id="main" class="main">
    <div class="pagetitle">
        <h1>Images du bandeau d’accueil</h1>
        <p>Gérez les photographies et leurs légendes. Le texte principal du bandeau reste indépendant du carrousel.</p>
    </div>
    <section class="section">
        <?php if ($homeSlideMessage): ?><div class="alert alert-<?= htmlspecialchars($homeSlideMessage['type'], ENT_QUOTES, 'UTF-8') ?>" role="status"><?= htmlspecialchars($homeSlideMessage['text'], ENT_QUOTES, 'UTF-8') ?></div><?php endif; ?>
        <div class="card"><div class="card-body">
            <h2 class="card-title">Ajouter une image</h2>
            <p class="text-muted">Choisissez une photo nette de l’établissement au format JPG, PNG ou WebP (15 Mo maximum). La première position s’affiche en premier.</p>
            <form method="post" enctype="multipart/form-data" class="row g-3">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>">
                <div class="col-md-6"><label class="form-label" for="new-kicker">Catégorie</label><input class="form-control" id="new-kicker" name="kicker" maxlength="100" required placeholder="Vie institutionnelle"></div>
                <div class="col-md-6"><label class="form-label" for="new-title">Légende</label><input class="form-control" id="new-title" name="title" maxlength="200" required placeholder="La communauté universitaire réunie"></div>
                <div class="col-md-6"><label class="form-label" for="new-alt">Description de l’image</label><input class="form-control" id="new-alt" name="image_alt" maxlength="255" required placeholder="Décrivez brièvement la photo"></div>
                <div class="col-md-6"><label class="form-label" for="new-image">Photo JPG, PNG ou WebP</label><input class="form-control" id="new-image" name="slide_image" type="file" accept="image/jpeg,image/png,image/webp" required></div>
                <div class="col-12"><button class="btn btn-primary" type="submit" name="add_home_slide" value="1">Ajouter au bandeau</button></div>
            </form>
        </div></div>

        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-4 mb-3"><div><h2 class="h4 mb-1">Visuels enregistrés</h2><p class="text-muted mb-0">Modifiez la légende, remplacez la photo, changez l’ordre ou masquez temporairement une image.</p></div><span class="badge bg-secondary"><?= count($homeSlides) ?> visuel<?= count($homeSlides) > 1 ? 's' : '' ?></span></div>
        <?php if (!$homeSlides): ?><div class="alert alert-info">Aucune image n’est enregistrée. Appliquez la migration puis ajoutez les photos du bandeau.</div><?php endif; ?>
        <?php foreach ($homeSlides as $slide): ?>
            <div class="card"><div class="card-body"><div class="row g-4 align-items-start">
                <div class="col-md-4 col-lg-3"><button class="home-slide-preview-trigger" type="button" data-bs-toggle="modal" data-bs-target="#home-slide-preview-<?= (int) $slide['id'] ?>" aria-label="Agrandir l’aperçu : <?= htmlspecialchars((string) $slide['image_alt'], ENT_QUOTES, 'UTF-8') ?>"><img src="<?= htmlspecialchars((string) $slide['image_path'], ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars((string) $slide['image_alt'], ENT_QUOTES, 'UTF-8') ?>" class="img-fluid rounded"><span class="home-slide-preview-hint"><i class="bi bi-zoom-in" aria-hidden="true"></i> Aperçu agrandi</span></button><div class="mt-2"><span class="badge <?= (int) $slide['is_active'] === 1 ? 'bg-success' : 'bg-secondary' ?>"><?= (int) $slide['is_active'] === 1 ? 'Visible sur le site' : 'Masqué' ?></span></div></div>
                <div class="col-md-8 col-lg-9"><form method="post" enctype="multipart/form-data" class="row g-3">
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>"><input type="hidden" name="slide_id" value="<?= (int) $slide['id'] ?>">
                    <div class="col-sm-4"><label class="form-label" for="kicker-<?= (int) $slide['id'] ?>">Catégorie</label><input class="form-control" id="kicker-<?= (int) $slide['id'] ?>" name="kicker" maxlength="100" required value="<?= htmlspecialchars((string) $slide['kicker'], ENT_QUOTES, 'UTF-8') ?>"></div>
                    <div class="col-sm-6"><label class="form-label" for="title-<?= (int) $slide['id'] ?>">Légende</label><input class="form-control" id="title-<?= (int) $slide['id'] ?>" name="title" maxlength="200" required value="<?= htmlspecialchars((string) $slide['title'], ENT_QUOTES, 'UTF-8') ?>"></div>
                    <div class="col-sm-2"><label class="form-label" for="order-<?= (int) $slide['id'] ?>">Position</label><input class="form-control" id="order-<?= (int) $slide['id'] ?>" name="sort_order" type="number" min="1" max="999" required value="<?= (int) $slide['sort_order'] ?>"></div>
                    <div class="col-md-7"><label class="form-label" for="alt-<?= (int) $slide['id'] ?>">Description de l’image</label><input class="form-control" id="alt-<?= (int) $slide['id'] ?>" name="image_alt" maxlength="255" required value="<?= htmlspecialchars((string) $slide['image_alt'], ENT_QUOTES, 'UTF-8') ?>"></div>
                    <div class="col-md-5"><label class="form-label" for="photo-<?= (int) $slide['id'] ?>">Remplacer la photo (facultatif)</label><input class="form-control" id="photo-<?= (int) $slide['id'] ?>" name="slide_image" type="file" accept="image/jpeg,image/png,image/webp"></div>
                    <div class="col-12"><button class="btn btn-primary" type="submit" name="update_home_slide" value="1">Enregistrer ce visuel</button></div>
                </form>
                <div class="d-flex flex-wrap gap-2 mt-2"><form method="post"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>"><input type="hidden" name="record_id" value="<?= (int) $slide['id'] ?>"><button class="btn btn-outline-<?= (int) $slide['is_active'] === 1 ? 'secondary' : 'success' ?>" type="submit" name="admin_action" value="<?= (int) $slide['is_active'] === 1 ? 'deactivate' : 'activate' ?>"><i class="bi bi-<?= (int) $slide['is_active'] === 1 ? 'eye-slash' : 'eye' ?> me-1" aria-hidden="true"></i><?= (int) $slide['is_active'] === 1 ? 'Retirer du site' : 'Afficher sur le site' ?></button></form><form method="post"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>"><input type="hidden" name="record_id" value="<?= (int) $slide['id'] ?>"><button class="btn btn-outline-danger" type="submit" name="admin_action" value="delete"><i class="bi bi-trash me-1" aria-hidden="true"></i> Supprimer</button></form></div>
                </div></div>
            </div></div>
            <div class="modal fade home-slide-preview-modal" id="home-slide-preview-<?= (int) $slide['id'] ?>" tabindex="-1" aria-labelledby="home-slide-preview-title-<?= (int) $slide['id'] ?>" aria-hidden="true"><div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable"><div class="modal-content"><div class="modal-header"><div><p class="text-muted small mb-1"><?= htmlspecialchars((string) $slide['kicker'], ENT_QUOTES, 'UTF-8') ?></p><h2 class="modal-title fs-5" id="home-slide-preview-title-<?= (int) $slide['id'] ?>"><?= htmlspecialchars((string) $slide['title'], ENT_QUOTES, 'UTF-8') ?></h2></div><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer l’aperçu"></button></div><div class="modal-body"><img src="<?= htmlspecialchars((string) $slide['image_path'], ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars((string) $slide['image_alt'], ENT_QUOTES, 'UTF-8') ?>" class="home-slide-preview-full"><p class="text-muted text-center small mt-3 mb-0"><?= htmlspecialchars((string) $slide['image_alt'], ENT_QUOTES, 'UTF-8') ?></p></div></div></div></div>
        <?php endforeach; ?>
    </section>
</main>
