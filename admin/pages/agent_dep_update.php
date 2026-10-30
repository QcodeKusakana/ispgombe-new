<?php

$erreur = null;
$sms = null;
$editId = filter_var($_GET['edit'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
if (!$bdd instanceof PDO || !$editId) {
    http_response_code(404);
    exit('Agent introuvable.');
}
$loadAgent = $bdd->prepare('SELECT * FROM agent_dep WHERE id = ? AND departement != 0');
$loadAgent->execute([$editId]);
$edit_agent = $loadAgent->fetch(PDO::FETCH_ASSOC);
if (!$edit_agent) {
    http_response_code(404);
    exit('Agent introuvable.');
}

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST' && isset($_POST['modifier'])) {
    $noms = is_string($_POST['noms'] ?? null) ? trim($_POST['noms']) : '';
    $telephone = is_string($_POST['telephone'] ?? null) ? trim($_POST['telephone']) : '';
    $grade = is_string($_POST['grade'] ?? null) ? trim($_POST['grade']) : '';
    $domaine = is_string($_POST['domaine'] ?? null) ? trim($_POST['domaine']) : '';
    $mail = is_string($_POST['mail'] ?? null) ? trim($_POST['mail']) : '';
    $departement = filter_var($_POST['departement'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
    $valider = isset($_POST['valider']) ? 1 : 0;
    if ($noms === '' || mb_strlen($noms, 'UTF-8') > 150 || mb_strlen($telephone, 'UTF-8') > 150 || mb_strlen($grade, 'UTF-8') > 150 || $domaine === '' || mb_strlen($domaine, 'UTF-8') > 150 || mb_strlen($mail, 'UTF-8') > 150 || ($mail !== '' && !filter_var($mail, FILTER_VALIDATE_EMAIL)) || !$departement) {
        $erreur = 'Vérifiez les coordonnées, le domaine et le département.';
    } else {
        try {
            $checkDepartment = $bdd->prepare('SELECT 1 FROM departement WHERE id = ?');
            $checkDepartment->execute([$departement]);
            if (!$checkDepartment->fetchColumn()) {
                throw new RuntimeException('Le département sélectionné est introuvable.');
            }
            $photo = (string) ($edit_agent['photo'] ?? '');
            $upload = $_FILES['photo'] ?? [];
            if (($upload['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_NO_FILE) {
                $photo = admin_store_image_upload($upload, 'admin/media/membre');
            }
            $update = $bdd->prepare('UPDATE agent_dep SET noms = ?, telephone = ?, grade = ?, domaine = ?, mail = ?, photo = ?, departement = ?, valider = ? WHERE id = ? AND departement != 0');
            $update->execute([$noms, $telephone, $grade, $domaine, $mail, $photo, (int) $departement, $valider, (int) $editId]);
            admin_log_action($bdd, 'staff.update', 'agent_dep', (string) $editId);
            $sms = 'Les informations de l’agent ont été mises à jour.';
            $loadAgent->execute([$editId]);
            $edit_agent = $loadAgent->fetch(PDO::FETCH_ASSOC);
        } catch (RuntimeException $exception) {
            $erreur = $exception->getMessage();
        } catch (Throwable $exception) {
            error_log('ISP-GOMBE department agent update failed.');
            $erreur = 'La mise à jour de l’agent a échoué.';
        }
    }
}
?>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Modification de l'agent</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="?pages=home">Home</a></li>
                <li class="breadcrumb-item active">Modifier agent</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <form role="form" method="post" enctype="multipart/form-data"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>">
                    <div class="col-lg-8">
                        <legend>Modifier l’agent</legend>
                        <?php if ($sms): ?><div class="alert alert-success" role="status"><?= htmlspecialchars($sms, ENT_QUOTES, 'UTF-8') ?></div><?php endif; ?>
                        <?php if ($erreur): ?><div class="alert alert-danger" role="alert"><?= htmlspecialchars($erreur, ENT_QUOTES, 'UTF-8') ?></div><?php endif; ?>

                        <div class="form-group">
                            <label for="edit-agent-name">Nom complet <span class="text-danger">*</span></label>
                            <input type="text" id="edit-agent-name" name="noms" value="<?= htmlspecialchars((string) ($_POST['noms'] ?? $edit_agent['noms']), ENT_QUOTES, 'UTF-8') ?>" maxlength="150" class="form-control" required />
                        </div>

                        <div class="form-group">
                            <label for="edit-agent-phone">Téléphone</label>
                            <input type="tel" id="edit-agent-phone" name="telephone" value="<?= htmlspecialchars((string) ($_POST['telephone'] ?? $edit_agent['telephone']), ENT_QUOTES, 'UTF-8') ?>" maxlength="150" class="form-control" />
                        </div>

                        <div class="form-group">
                            <label for="edit-agent-grade">Grade académique</label>
                            <input type="text" id="edit-agent-grade" name="grade" value="<?= htmlspecialchars((string) ($_POST['grade'] ?? $edit_agent['grade']), ENT_QUOTES, 'UTF-8') ?>" maxlength="150" class="form-control" />
                        </div>

                        <div class="form-group">
                            <label for="edit-agent-domain">Domaine <span class="text-danger">*</span></label>
                            <input type="text" id="edit-agent-domain" name="domaine" value="<?= htmlspecialchars((string) ($_POST['domaine'] ?? $edit_agent['domaine']), ENT_QUOTES, 'UTF-8') ?>" maxlength="150" class="form-control" required />
                        </div>

                        <div class="form-group">
                            <label for="edit-agent-mail">E-mail</label>
                            <input type="email" id="edit-agent-mail" name="mail" value="<?= htmlspecialchars((string) ($_POST['mail'] ?? $edit_agent['mail']), ENT_QUOTES, 'UTF-8') ?>" maxlength="150" class="form-control" />
                        </div>

                        <div class="form-group">
                            <label>Photo actuelle</label><br/>
                            <?php if(!empty($edit_agent['photo'])): ?>
                                <img src="./media/membre/<?= rawurlencode((string) $edit_agent['photo']) ?>" width="100" alt="Photo actuelle de l’agent" class="img-fluid rounded">
                            <?php else: ?>
                                Pas de photo
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="edit-agent-photo">Changer la photo (facultatif)</label>
                            <input type="file" id="edit-agent-photo" name="photo" accept="image/jpeg,image/png,image/webp" class="form-control" />
                        </div>

                        <div class="form-group">
                            <label for="edit-agent-department">Département <span class="text-danger">*</span></label>
                            <select class="form-select" name="departement" id="edit-agent-department" required>
                                <?php $sections=$bdd->query("SELECT * FROM departement");
                                foreach($sections as $sec){
                                    ?>
                                    <option value="<?= (int) $sec['id'] ?>" <?= (int) ($_POST['departement'] ?? $edit_agent['departement']) === (int) $sec['id'] ? 'selected' : '' ?>><?= htmlspecialchars((string) $sec['titre'], ENT_QUOTES, 'UTF-8') ?></option>
                                <?php } ?>

                            </select>
                        </div>

                        <div class="form-check mt-3">
                            <input class="form-check-input" id="edit-agent-active" type="checkbox" name="valider" value="1" <?= (int) ($_POST['valider'] ?? $edit_agent['valider']) === 1 ? 'checked' : '' ?>>
                            <label class="form-check-label" for="edit-agent-active">
                                Valider cet agent
                            </label>
                        </div>
                    </div>
                    <br/>
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary" name="modifier">Enregistrer les modifications</button>
                        <a class="btn btn-dark" href='?pages=agent_dep'><i class="bi bi-arrow-left me-1" aria-hidden="true"></i> Retour</a>
                    </div>

                </form>

            </div>
        </div>
    </section>

</main><!-- End #main -->
