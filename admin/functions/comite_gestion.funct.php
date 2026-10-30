<?php
$committeeMembers = [];
$committeeMessage = null;

if (!$bdd instanceof PDO) {
    $committeeMessage = ['type' => 'danger', 'text' => 'La base de données est indisponible.'];
} else {
    try {
        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST' && isset($_POST['save_committee_member'])) {
            if (!csrf_is_valid($_POST['csrf_token'] ?? null)) {
                throw new RuntimeException('Le formulaire a expiré. Rechargez la page puis réessayez.');
            }
            $id = null;
            if (isset($_POST['member_id'])) {
                $id = filter_var($_POST['member_id'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
                if ($id === false) {
                    throw new RuntimeException('Identifiant de membre invalide.');
                }
            }
            $name = is_string($_POST['nom'] ?? null) ? trim($_POST['nom']) : '';
            $role = is_string($_POST['fonction'] ?? null) ? trim($_POST['fonction']) : '';
            $descriptionInput = is_string($_POST['description'] ?? null) ? $_POST['description'] : '';
            if (admin_rich_text_text_length($descriptionInput) > 30000) {
                throw new RuntimeException('La description ne peut pas dépasser 30 000 caractères.');
            }
            $description = admin_sanitize_rich_text($descriptionInput);
            $order = filter_var($_POST['sort_order'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 999]]);
            if ($name === '' || mb_strlen($name, 'UTF-8') > 160 || $role === '' || mb_strlen($role, 'UTF-8') > 160 || !$order) {
                throw new RuntimeException('Vérifiez le nom, la fonction et l’ordre d’affichage (1 à 999).');
            }

            $upload = $_FILES['photo'] ?? [];
            if ($id === null) {
                $filename = admin_store_image_upload($upload, 'admin/media/membre');
                $insert = $bdd->prepare('INSERT INTO committee_member (nom, fonction, description, photo, sort_order, is_active) VALUES (?, ?, ?, ?, ?, 1)');
                $insert->execute([$name, $role, $description, $filename, $order]);
                admin_log_action($bdd, 'committee_member.create', 'committee_member', (string) $bdd->lastInsertId());
                $_SESSION['admin_action_notice'] = 'Le membre a été ajouté au Comité de gestion.';
            } else {
                $current = $bdd->prepare('SELECT photo FROM committee_member WHERE id = ?');
                $current->execute([(int) $id]);
                $currentPhoto = $current->fetchColumn();
                if (!is_string($currentPhoto)) {
                    throw new RuntimeException('Ce membre est introuvable.');
                }
                if (($upload['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
                    $update = $bdd->prepare('UPDATE committee_member SET nom = ?, fonction = ?, description = ?, sort_order = ? WHERE id = ?');
                    $update->execute([$name, $role, $description, $order, (int) $id]);
                } else {
                    $filename = admin_store_image_upload($upload, 'admin/media/membre');
                    $update = $bdd->prepare('UPDATE committee_member SET nom = ?, fonction = ?, description = ?, photo = ?, sort_order = ? WHERE id = ?');
                    $update->execute([$name, $role, $description, $filename, $order, (int) $id]);
                    $oldImage = realpath(__DIR__ . '/../media/membre/' . basename($currentPhoto));
                    $imageDirectory = realpath(__DIR__ . '/../media/membre');
                    if ($oldImage && $imageDirectory && dirname($oldImage) === $imageDirectory && preg_match('/^[a-f0-9]{32}\.jpe?g$|^[a-f0-9]{32}\.png$/i', basename($oldImage))) {
                        @unlink($oldImage);
                    }
                }
                admin_log_action($bdd, 'committee_member.update', 'committee_member', (string) $id);
                $_SESSION['admin_action_notice'] = 'Les informations du membre ont été mises à jour.';
            }
            header('Location: ?pages=comite_gestion');
            exit;
        }

        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST' && ($_POST['admin_action'] ?? '') === 'delete') {
            if (!csrf_is_valid($_POST['csrf_token'] ?? null)) {
                http_response_code(400);
                exit('Jeton de sécurité invalide.');
            }
            $id = filter_var($_POST['record_id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
            if (!$id) {
                throw new RuntimeException('Membre sélectionné invalide.');
            }
            $current = $bdd->prepare('SELECT photo FROM committee_member WHERE id = ?');
            $current->execute([(int) $id]);
            $photo = $current->fetchColumn();
            if (!is_string($photo)) {
                throw new RuntimeException('Ce membre est introuvable.');
            }
            $delete = $bdd->prepare('DELETE FROM committee_member WHERE id = ?');
            $delete->execute([(int) $id]);
            admin_log_action($bdd, 'committee_member.delete', 'committee_member', (string) $id);
            $imageDirectory = realpath(__DIR__ . '/../media/membre');
            $imagePath = realpath(__DIR__ . '/../media/membre/' . basename($photo));
            if ($imagePath && $imageDirectory && dirname($imagePath) === $imageDirectory && preg_match('/^[a-f0-9]{32}\.jpe?g$|^[a-f0-9]{32}\.png$/i', basename($imagePath))) {
                @unlink($imagePath);
            }
            $_SESSION['admin_action_notice'] = 'Le membre a été retiré du Comité de gestion.';
            header('Location: ?pages=comite_gestion');
            exit;
        }

        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST' && in_array($_POST['admin_action'] ?? '', ['activate', 'deactivate'], true)) {
            admin_handle_record_action($bdd, 'comite_gestion', 'committee_member', 'id', [
                'activate' => ['is_active', 1],
                'deactivate' => ['is_active', 0],
            ]);
        }

        $committeeMembers = $bdd->query('SELECT id, nom, fonction, description, photo, sort_order, is_active FROM committee_member ORDER BY sort_order ASC, id ASC')->fetchAll();
    } catch (PDOException $exception) {
        error_log('ISP-GOMBE committee management database operation failed.');
        $committeeMessage = ['type' => 'danger', 'text' => 'La structure du Comité de gestion est indisponible. Appliquez les migrations du Comité indiquées dans les instructions.'];
    } catch (Throwable $exception) {
        $committeeMessage = ['type' => 'warning', 'text' => $exception->getMessage()];
    }
}
