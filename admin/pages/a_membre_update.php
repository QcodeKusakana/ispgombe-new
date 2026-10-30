<?php
$erreur = null;
$sms = null;
$editId = filter_var($_GET['edit'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
if (!$bdd instanceof PDO || !$editId) {
    http_response_code(404);
    exit('Personnel introuvable.');
}
$loadMember = $bdd->prepare('SELECT * FROM personnel WHERE id = ? AND faculte != 0');
$loadMember->execute([$editId]);
$edit_personnel = $loadMember->fetch(PDO::FETCH_ASSOC);
if (!$edit_personnel) {
    http_response_code(404);
    exit('Personnel introuvable.');
}

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST' && isset($_POST['modifier'])) {
    $noms = is_string($_POST['noms'] ?? null) ? trim($_POST['noms']) : '';
    $telephone = is_string($_POST['telephone'] ?? null) ? trim($_POST['telephone']) : '';
    $mail = is_string($_POST['mail'] ?? null) ? trim($_POST['mail']) : '';
    $fonction = is_string($_POST['fonction'] ?? null) ? trim($_POST['fonction']) : '';
    $faculte = filter_var($_POST['faculte'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
    $valider = filter_var($_POST['valider'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 0, 'max_range' => 1]]);
    if ($noms === '' || mb_strlen($noms, 'UTF-8') > 25 || $telephone === '' || mb_strlen($telephone, 'UTF-8') > 25 || !filter_var($mail, FILTER_VALIDATE_EMAIL) || mb_strlen($mail, 'UTF-8') > 255 || $fonction === '' || mb_strlen($fonction, 'UTF-8') > 100 || !$faculte || $valider === false) {
        $erreur = 'Vérifiez les coordonnées, la fonction, la section et le statut.';
    } else {
        try {
            $checkFaculty = $bdd->prepare('SELECT 1 FROM faculte WHERE id = ?');
            $checkFaculty->execute([$faculte]);
            if (!$checkFaculty->fetchColumn()) {
                throw new RuntimeException('La section sélectionnée est introuvable.');
            }
            $photoName = (string) ($edit_personnel['photo'] ?? '');
            $upload = $_FILES['photo'] ?? [];
            if (($upload['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_NO_FILE) {
                $photoName = admin_store_image_upload($upload, 'admin/media/membre');
            }
            $update = $bdd->prepare('UPDATE personnel SET noms = ?, telephone = ?, mail = ?, fonction = ?, photo = ?, faculte = ?, valider = ? WHERE id = ? AND faculte != 0');
            $update->execute([$noms, $telephone, $mail, $fonction, $photoName, (int) $faculte, (int) $valider, (int) $editId]);
            admin_log_action($bdd, 'staff.update', 'personnel', (string) $editId);
            $sms = 'Les informations du membre ont été mises à jour.';
            $loadMember->execute([$editId]);
            $edit_personnel = $loadMember->fetch(PDO::FETCH_ASSOC);
        } catch (RuntimeException $exception) {
            $erreur = $exception->getMessage();
        } catch (Throwable $exception) {
            error_log('ISP-GOMBE faculty staff update failed.');
            $erreur = 'La mise à jour du membre a échoué.';
        }
    }
}
?>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Modification du personnel</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="?pages=home">Home</a></li>
                <li class="breadcrumb-item active">Modifier personnel</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <form role="form" method="post" enctype="multipart/form-data"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>">
                    <div class="col-lg-8">
                        <legend>Modifier le membre</legend>
                        <?php if ($sms): ?><div class="alert alert-success" role="status"><?= htmlspecialchars($sms, ENT_QUOTES, 'UTF-8') ?></div><?php endif; ?>
                        <?php if ($erreur): ?><div class="alert alert-danger" role="alert"><?= htmlspecialchars($erreur, ENT_QUOTES, 'UTF-8') ?></div><?php endif; ?>

                        <div class="form-group">
                            <label for="edit-faculty-name">Nom complet <span class="text-danger">*</span></label>
                            <input type="text" id="edit-faculty-name" name="noms" value="<?= htmlspecialchars((string) ($_POST['noms'] ?? $edit_personnel['noms']), ENT_QUOTES, 'UTF-8') ?>" maxlength="25" class="form-control" required />
                        </div>

                        <div class="form-group">
                            <label for="edit-faculty-phone">Téléphone <span class="text-danger">*</span></label>
                            <input type="tel" id="edit-faculty-phone" name="telephone" value="<?= htmlspecialchars((string) ($_POST['telephone'] ?? $edit_personnel['telephone']), ENT_QUOTES, 'UTF-8') ?>" maxlength="25" class="form-control" required />
                        </div>

                        <div class="form-group">
                            <label for="edit-faculty-mail">E-mail <span class="text-danger">*</span></label>
                            <input type="email" id="edit-faculty-mail" name="mail" value="<?= htmlspecialchars((string) ($_POST['mail'] ?? $edit_personnel['mail']), ENT_QUOTES, 'UTF-8') ?>" maxlength="255" class="form-control" required />
                        </div>

                        <div class="form-group">
                            <label for="edit-faculty-role">Fonction <span class="text-danger">*</span></label>
                            <input type="text" id="edit-faculty-role" name="fonction" value="<?= htmlspecialchars((string) ($_POST['fonction'] ?? $edit_personnel['fonction']), ENT_QUOTES, 'UTF-8') ?>" maxlength="100" class="form-control" required />
                        </div>

                        <div class="form-group">
                            <label for="edit-faculty-section">Section <span class="text-danger">*</span></label>
                            <select class="form-select" name="faculte" id="edit-faculty-section" required>
                                <?php $sections=$bdd->query("SELECT * FROM faculte");
                                foreach($sections as $sec){
                                    ?>
                                    <option value="<?= (int) $sec['id'] ?>" <?= (int) ($_POST['faculte'] ?? $edit_personnel['faculte']) === (int) $sec['id'] ? 'selected' : '' ?>><?= htmlspecialchars((string) $sec['titre'], ENT_QUOTES, 'UTF-8') ?></option>
                                <?php } ?>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="edit-faculty-status">Statut <span class="text-danger">*</span></label>
                            <select name="valider" id="edit-faculty-status" class="form-select">
                                <option value="0" <?= (int) ($_POST['valider'] ?? $edit_personnel['valider']) === 0 ? 'selected' : '' ?>>Non validé</option>
                                <option value="1" <?= (int) ($_POST['valider'] ?? $edit_personnel['valider']) === 1 ? 'selected' : '' ?>>Validé</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="edit-faculty-photo">Changer la photo (facultatif)</label>
                            <input type="file" id="edit-faculty-photo" name="photo" accept="image/jpeg,image/png,image/webp" class="form-control" />
                            <?php if (!empty($edit_personnel['photo'])): ?>
                                <br/>
                                <img src="./media/membre/<?= rawurlencode((string) $edit_personnel['photo']) ?>" alt="Photo actuelle du membre" width="150" class="img-fluid rounded mt-2">
                            <?php endif; ?>
                        </div>
                    </div>
                    <br/>
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-danger" name="modifier">Modifier maintenant</button>
                        <a class="btn btn-dark" href='?pages=a_membre'><i class="bi bi-arrow-left me-1" aria-hidden="true"></i> Retour</a>
                    </div>

                </form>

            </div>
        </div>
    </section>

</main><!-- End #main -->
