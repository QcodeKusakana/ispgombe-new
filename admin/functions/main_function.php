<?php
require_once __DIR__ . '/../../php/main_function.php';

function admin_role_definitions(): array
{
    return [
        7 => ['name' => 'Super administrateur', 'description' => 'Accès complet, y compris aux comptes et aux journaux.'],
        5 => ['name' => 'Webmaster', 'description' => 'Gestion de l’ensemble du site public et de ses contenus.'],
        10 => ['name' => 'Éditeur de contenu', 'description' => 'Actualités, campus, galeries, annonces et communiqués.'],
        11 => ['name' => 'Gestionnaire académique', 'description' => 'Sections, départements, options, promotions et palmarès.'],
        12 => ['name' => 'Gestionnaire du personnel', 'description' => 'Personnel des sections et départements, agents et messagerie.'],
        13 => ['name' => 'Agent des admissions', 'description' => 'Consultation des dossiers de candidature et de leurs pièces.'],
    ];
}

function admin_role_allowed_pages(int $role): array
{
    return match ($role) {
        7 => ['*'],
        5 => ['home', 'site_content', 'home_slides', 'comite_gestion', 'activite', 'campus', 'communiques', 'a_la_une', 'a_la_uneDep', 'annonce_s', 'annonce_d', 'modif_article', 'deconnexion'],
        10 => ['home', 'activite', 'campus', 'communiques', 'a_la_une', 'a_la_uneDep', 'annonce_s', 'annonce_d', 'modif_article', 'deconnexion'],
        11 => ['home', 'section', 'fac', 'departement', 'dep', 'option', 'promotion', 'palmares', 'sess', 'niveau', 'deconnexion'],
        12 => ['home', 'comite_gestion', 'a_membre', 'a_membre_update', 'a_membre_dep', 'a_membre_dep_update', 'agent_dep', 'agent_dep_update', 'messagerie', 'deconnexion'],
        13 => ['home', 'candidatures', 'deconnexion'],
        default => [],
    };
}

function admin_role_can_access_page(int $role, string $page): bool
{
    $allowed = admin_role_allowed_pages($role);
    return in_array('*', $allowed, true) || in_array($page, $allowed, true);
}

function admin_role_name(int $role): string
{
    return admin_role_definitions()[$role]['name'] ?? 'Rôle non reconnu';
}

function admin_refresh_session_identity($database): bool
{
    if (empty($_SESSION['id_adm']) || !$database instanceof PDO) {
        return false;
    }
    try {
        $statement = $database->prepare('SELECT pseudo, mail, niveau, confirmer FROM admin WHERE id_adm = ? LIMIT 1');
        $statement->execute([(int) $_SESSION['id_adm']]);
        $account = $statement->fetch();
    } catch (Throwable $exception) {
        error_log('ISP-GOMBE administrator session refresh failed.');
        return false;
    }
    if (!$account || (int) $account['confirmer'] !== 1 || !array_key_exists((int) $account['niveau'], admin_role_definitions())) {
        unset($_SESSION['id_adm'], $_SESSION['pseudo'], $_SESSION['mail'], $_SESSION['niveau'], $_SESSION['confirmer']);
        return false;
    }
    $_SESSION['pseudo'] = $account['pseudo'];
    $_SESSION['mail'] = $account['mail'];
    $_SESSION['niveau'] = (int) $account['niveau'];
    $_SESSION['confirmer'] = (int) $account['confirmer'];
    return true;
}
