<?php
$administrateur = [];
$adminManagementMessage = null;
$adminRoleOptions = admin_role_definitions();
if ((int) ($_SESSION['niveau'] ?? 0) !== 7) {
    http_response_code(403);
    $adminManagementMessage = 'Cette gestion est réservée aux administrateurs de niveau supérieur.';
} elseif ($bdd instanceof PDO) {
    if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST' && isset($_POST['create_admin'])) {
        $pseudo = is_string($_POST['new_pseudo'] ?? null) ? trim($_POST['new_pseudo']) : '';
        $mail = is_string($_POST['new_mail'] ?? null) ? trim($_POST['new_mail']) : '';
        $password = is_string($_POST['new_password'] ?? null) ? $_POST['new_password'] : '';
        $role = filter_var($_POST['new_role'] ?? null, FILTER_VALIDATE_INT);
        if (!csrf_is_valid($_POST['csrf_token'] ?? null)) {
            $adminManagementMessage = 'Le formulaire a expiré. Rechargez la page.';
        } elseif ($pseudo === '' || mb_strlen($pseudo, 'UTF-8') > 50 || !filter_var($mail, FILTER_VALIDATE_EMAIL) || mb_strlen($mail, 'UTF-8') > 50 || strlen($password) < 12 || $role === false || !array_key_exists($role, $adminRoleOptions)) {
            $adminManagementMessage = 'Vérifiez le nom, l’adresse e-mail, le rôle et le mot de passe de 12 caractères minimum.';
        } else {
            try {
                $duplicate = $bdd->prepare('SELECT 1 FROM admin WHERE pseudo = ? OR mail = ? LIMIT 1');
                $duplicate->execute([$pseudo, $mail]);
                if ($duplicate->fetchColumn()) {
                    $adminManagementMessage = 'Ce nom ou cette adresse e-mail est déjà utilisé.';
                } else {
                    $insert = $bdd->prepare('INSERT INTO admin (pseudo, mail, password, niveau, confirmer) VALUES (?, ?, ?, ?, 1)');
                    $insert->execute([$pseudo, $mail, password_hash($password, PASSWORD_DEFAULT), $role]);
                    admin_log_action($bdd, 'admin.create', 'admin', (string) $bdd->lastInsertId(), ['role' => (int) $role, 'result' => 'success']);
                    $adminManagementMessage = 'Compte créé et activé avec le rôle « ' . $adminRoleOptions[$role]['name'] . ' ».';
                }
            } catch (Throwable $e) {
                error_log('ISP-GOMBE administrator account creation failed.');
                $adminManagementMessage = 'Le compte n’a pas pu être créé.';
            }
        }
    } elseif (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST' && isset($_POST['admin_action'])) {
        $targetId = filter_var($_POST['target_id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
        $action = is_string($_POST['admin_action'] ?? null) ? $_POST['admin_action'] : '';
        if (!csrf_is_valid($_POST['csrf_token'] ?? null) || !$targetId || $targetId === (int) $_SESSION['id_adm']) {
            $adminManagementMessage = 'Action refusée. Actualisez la page puis réessayez sur un autre compte.';
        } else {
            $target = $bdd->prepare('SELECT id_adm, niveau, confirmer FROM admin WHERE id_adm = ?');
            $target->execute([(int) $targetId]);
            $targetAccount = $target->fetch();
            if (!$targetAccount) {
                $adminManagementMessage = 'Ce compte n’existe plus.';
            } else {
                $isActiveSuperAdmin = (int) $targetAccount['niveau'] === 7 && (int) $targetAccount['confirmer'] === 1;
                $activeSuperAdmins = $isActiveSuperAdmin ? (int) $bdd->query('SELECT COUNT(*) FROM admin WHERE niveau = 7 AND confirmer = 1')->fetchColumn() : 0;
                if ($action === 'delete') {
                    if ($isActiveSuperAdmin && $activeSuperAdmins <= 1) {
                        $adminManagementMessage = 'Impossible de supprimer le dernier super administrateur actif.';
                    } else {
                        $delete = $bdd->prepare('DELETE FROM admin WHERE id_adm = ?');
                        $delete->execute([(int) $targetId]);
                        admin_log_action($bdd, 'admin.delete', 'admin', (string) $targetId, ['result' => 'success']);
                        $adminManagementMessage = 'Le compte administrateur a été supprimé.';
                    }
                } elseif (in_array($action, ['approve', 'suspend'], true)) {
                    if ($action === 'suspend' && $isActiveSuperAdmin && $activeSuperAdmins <= 1) {
                        $adminManagementMessage = 'Impossible de suspendre le dernier super administrateur actif.';
                    } else {
                        $status = $action === 'approve' ? 1 : 0;
                        $statement = $bdd->prepare('UPDATE admin SET confirmer = ? WHERE id_adm = ?');
                        $statement->execute([$status, (int) $targetId]);
                        admin_log_action($bdd, 'admin.' . $action, 'admin', (string) $targetId, ['status' => $status]);
                        $adminManagementMessage = $status ? 'Le compte a été activé.' : 'Le compte a été suspendu.';
                    }
                } elseif ($action === 'set_role') {
                    $newRole = filter_var($_POST['target_role'] ?? null, FILTER_VALIDATE_INT);
                    if ($newRole === false || !array_key_exists($newRole, $adminRoleOptions)) {
                        $adminManagementMessage = 'Sélectionnez un rôle valide.';
                    } elseif ($isActiveSuperAdmin && $activeSuperAdmins <= 1 && $newRole !== 7) {
                        $adminManagementMessage = 'Impossible de retirer le rôle au dernier super administrateur actif.';
                    } else {
                        $statement = $bdd->prepare('UPDATE admin SET niveau = ? WHERE id_adm = ?');
                        $statement->execute([(int) $newRole, (int) $targetId]);
                        admin_log_action($bdd, 'admin.role.update', 'admin', (string) $targetId, ['role' => (int) $newRole]);
                        $adminManagementMessage = 'Le rôle a été défini sur « ' . $adminRoleOptions[$newRole]['name'] . ' ».';
                    }
                }
            }
        }
    }
    $administrateur = $bdd->query('SELECT id_adm, pseudo, mail, niveau, confirmer FROM admin ORDER BY pseudo ASC')->fetchAll();
}
?>
