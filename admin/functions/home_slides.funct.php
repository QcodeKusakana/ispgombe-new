<?php
$homeSlideMessage = null;
$homeSlides = [];

if (!$bdd instanceof PDO) {
    $homeSlideMessage = ['type' => 'danger', 'text' => 'Base de données indisponible.'];
} else {
    try {
        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST' && isset($_POST['add_home_slide'])) {
            if (!csrf_is_valid($_POST['csrf_token'] ?? null)) {
                throw new RuntimeException('Le formulaire a expiré. Rechargez la page puis réessayez.');
            }
            $kicker = is_string($_POST['kicker'] ?? null) ? trim($_POST['kicker']) : '';
            $title = is_string($_POST['title'] ?? null) ? trim($_POST['title']) : '';
            $alt = is_string($_POST['image_alt'] ?? null) ? trim($_POST['image_alt']) : '';
            if ($kicker === '' || $title === '' || $alt === '' || mb_strlen($kicker, 'UTF-8') > 100 || mb_strlen($title, 'UTF-8') > 200 || mb_strlen($alt, 'UTF-8') > 255) {
                throw new RuntimeException('Renseignez la catégorie, la légende et la description de l’image dans les limites indiquées.');
            }
            $filename = admin_store_image_upload($_FILES['slide_image'] ?? [], 'admin/media/couverture');
            $path = 'admin/media/couverture/' . $filename;
            $position = (int) $bdd->query('SELECT COALESCE(MAX(sort_order), 0) + 1 FROM home_slide')->fetchColumn();
            $insert = $bdd->prepare('INSERT INTO home_slide (kicker, title, image_path, image_alt, sort_order, is_active) VALUES (?, ?, ?, ?, ?, 1)');
            $insert->execute([$kicker, $title, $path, $alt, $position]);
            admin_log_action($bdd, 'home_slide.create', 'home_slide', (string) $bdd->lastInsertId());
            $_SESSION['admin_action_notice'] = 'L’image a été ajoutée au bandeau d’accueil.';
            header('Location: ?pages=home_slides');
            exit;
        }

        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST' && isset($_POST['update_home_slide'])) {
            if (!csrf_is_valid($_POST['csrf_token'] ?? null)) {
                throw new RuntimeException('Le formulaire a expiré. Rechargez la page puis réessayez.');
            }
            $id = filter_var($_POST['slide_id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
            $position = filter_var($_POST['sort_order'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 999]]);
            $kicker = is_string($_POST['kicker'] ?? null) ? trim($_POST['kicker']) : '';
            $title = is_string($_POST['title'] ?? null) ? trim($_POST['title']) : '';
            $alt = is_string($_POST['image_alt'] ?? null) ? trim($_POST['image_alt']) : '';
            if (!$id || !$position || $kicker === '' || $title === '' || $alt === '' || mb_strlen($kicker, 'UTF-8') > 100 || mb_strlen($title, 'UTF-8') > 200 || mb_strlen($alt, 'UTF-8') > 255) {
                throw new RuntimeException('Vérifiez les champs du visuel : ils sont obligatoires et la position doit être comprise entre 1 et 999.');
            }
            $replacement = $_FILES['slide_image'] ?? [];
            if (($replacement['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
                $update = $bdd->prepare('UPDATE home_slide SET kicker = ?, title = ?, image_alt = ?, sort_order = ? WHERE id = ?');
                $update->execute([$kicker, $title, $alt, $position, (int) $id]);
            } else {
                $filename = admin_store_image_upload($replacement, 'admin/media/couverture');
                $path = 'admin/media/couverture/' . $filename;
                $update = $bdd->prepare('UPDATE home_slide SET kicker = ?, title = ?, image_path = ?, image_alt = ?, sort_order = ? WHERE id = ?');
                $update->execute([$kicker, $title, $path, $alt, $position, (int) $id]);
            }
            admin_log_action($bdd, 'home_slide.update', 'home_slide', (string) $id);
            $_SESSION['admin_action_notice'] = 'Le visuel a été mis à jour.';
            header('Location: ?pages=home_slides');
            exit;
        }

        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST' && ($_POST['admin_action'] ?? '') === 'delete') {
            $targetId = filter_var($_POST['record_id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
            if (!$targetId || !csrf_is_valid($_POST['csrf_token'] ?? null)) {
                http_response_code(400);
                exit('Action invalide.');
            }
            $target = $bdd->prepare('SELECT image_path, is_active FROM home_slide WHERE id = ?');
            $target->execute([$targetId]);
            $slideToDelete = $target->fetch();
            $activeCount = (int) $bdd->query('SELECT COUNT(*) FROM home_slide WHERE is_active = 1')->fetchColumn();
            if (!$slideToDelete) {
                $homeSlideMessage = ['type' => 'warning', 'text' => 'Ce visuel est introuvable.'];
            } elseif ((int) $slideToDelete['is_active'] === 1 && $activeCount <= 1) {
                $homeSlideMessage = ['type' => 'warning', 'text' => 'Gardez au moins une image visible. Masquez une autre image avant de supprimer la dernière.'];
            } else {
                $remove = $bdd->prepare('DELETE FROM home_slide WHERE id = ?');
                $remove->execute([(int) $targetId]);
                admin_log_action($bdd, 'home_slide.delete', 'home_slide', (string) $targetId);
                $_SESSION['admin_action_notice'] = 'Le visuel a été supprimé.';
                header('Location: ?pages=home_slides');
                exit;
            }
        } elseif (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST' && ($_POST['admin_action'] ?? '') === 'deactivate') {
            $activeCount = (int) $bdd->query('SELECT COUNT(*) FROM home_slide WHERE is_active = 1')->fetchColumn();
            if ($activeCount <= 1) {
                if (!csrf_is_valid($_POST['csrf_token'] ?? null)) {
                    http_response_code(400);
                    exit('Jeton de sécurité invalide. Rechargez la page.');
                }
                $homeSlideMessage = ['type' => 'warning', 'text' => 'Gardez au moins une image visible dans le bandeau.'];
            } else {
                admin_handle_record_action($bdd, 'home_slides', 'home_slide', 'id', ['deactivate' => ['is_active', 0]]);
            }
        } elseif (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST' && ($_POST['admin_action'] ?? '') === 'activate') {
            admin_handle_record_action($bdd, 'home_slides', 'home_slide', 'id', ['activate' => ['is_active', 1]]);
        }
        $homeSlides = $bdd->query('SELECT id, kicker, title, image_path, image_alt, sort_order, is_active FROM home_slide ORDER BY sort_order ASC, id ASC')->fetchAll();
    } catch (RuntimeException $e) {
        if ($e instanceof PDOException) {
            error_log('ISP-GOMBE home slide database operation failed.');
            $homeSlideMessage = ['type' => 'danger', 'text' => 'Les images ne sont pas disponibles. Vérifiez la migration de la base de données.'];
        } else {
            $homeSlideMessage = ['type' => 'warning', 'text' => $e->getMessage()];
        }
    } catch (Throwable $e) {
        error_log('ISP-GOMBE home slide management failed.');
        $homeSlideMessage = ['type' => 'danger', 'text' => 'Les images ne sont pas disponibles. Appliquez la migration versionnée et vérifiez le dossier de stockage.'];
    }
}
