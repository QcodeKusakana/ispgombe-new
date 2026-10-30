<?php
$siteContentFields = [
    'hero_title' => ['label' => 'Titre principal de l’accueil', 'max' => 180],
    'hero_highlight' => ['label' => 'Mise en évidence du titre', 'max' => 180],
    'hero_description' => ['label' => 'Texte d’introduction', 'max' => 600],
    'about_title' => ['label' => 'Titre de la présentation', 'max' => 180],
    'about_highlight' => ['label' => 'Mise en évidence de la présentation', 'max' => 180],
    'about_intro' => ['label' => 'Présentation de l’institut', 'max' => 1600],
    'admissions_notice' => ['label' => 'Information sur les admissions', 'max' => 800],
    'contact_email' => ['label' => 'Adresse e-mail publique', 'max' => 160],
    'contact_phone' => ['label' => 'Téléphone public (laisser vide si non validé)', 'max' => 50],
    'contact_address' => ['label' => 'Adresse de l’établissement', 'max' => 500],
    'institution_history' => ['label' => 'Historique de l’institut', 'max' => 5000],
    'institution_mission' => ['label' => 'Mission', 'max' => 2500],
    'institution_vision' => ['label' => 'Vision', 'max' => 2000],
    'institution_values' => ['label' => 'Valeurs', 'max' => 2500],
    'institution_organization' => ['label' => 'Organisation académique', 'max' => 3000],
    'institution_authorities' => ['label' => 'Autorités et organes de gestion', 'max' => 3000],
    'institution_administration' => ['label' => 'Services administratifs', 'max' => 2500],
    'institution_budget' => ['label' => 'Administration du budget', 'max' => 2500],
    'campus_description' => ['label' => 'Campus et infrastructures', 'max' => 3000],
    'research_description' => ['label' => 'Bibliothèque et recherche', 'max' => 3000],
];
$siteContentValues = [];
$siteContentMessage = null;

if (!$bdd instanceof PDO) {
    $siteContentMessage = ['type' => 'danger', 'text' => 'Base de données indisponible.'];
} else {
    try {
        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST' && isset($_POST['save_site_content'])) {
            if (!csrf_is_valid($_POST['csrf_token'] ?? null)) {
                throw new RuntimeException('Le formulaire a expiré. Rechargez la page puis réessayez.');
            }
            $submittedValues = [];
            foreach ($siteContentFields as $key => $field) {
                $rawValue = $_POST[$key] ?? '';
                if (!is_string($rawValue)) {
                    throw new RuntimeException('Un champ du formulaire est invalide.');
                }
                $value = trim($rawValue);
                $fieldLength = admin_rich_text_text_length($value);
                if (mb_strlen($value, 'UTF-8') > $field['max'] && $fieldLength > $field['max']) {
                    throw new RuntimeException('Un champ dépasse la longueur autorisée.');
                }
                $submittedValues[$key] = $value;
            }
            if ($submittedValues['contact_email'] !== '' && !filter_var($submittedValues['contact_email'], FILTER_VALIDATE_EMAIL)) {
                throw new RuntimeException('L’adresse e-mail publique n’est pas valide.');
            }
            $bdd->beginTransaction();
            $saveSetting = $bdd->prepare(
                'INSERT INTO site_setting (setting_key, setting_value, updated_by) VALUES (?, ?, ?) '
                . 'ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value), updated_by = VALUES(updated_by), updated_at = CURRENT_TIMESTAMP'
            );
            foreach ($submittedValues as $key => $value) {
                $saveSetting->execute([$key, $value, (int) $_SESSION['id_adm']]);
            }
            $bdd->commit();
            admin_log_action($bdd, 'site_content.update', 'site_setting', null, ['changed_rows' => count($submittedValues)]);
            $siteContentMessage = ['type' => 'success', 'text' => 'Le contenu du site a été enregistré.'];
        }
        $settingRows = $bdd->query('SELECT setting_key, setting_value FROM site_setting')->fetchAll();
        foreach ($settingRows as $row) {
            if (isset($siteContentFields[$row['setting_key']])) {
                $siteContentValues[$row['setting_key']] = (string) $row['setting_value'];
            }
        }
    } catch (Throwable $e) {
        if ($bdd->inTransaction()) {
            $bdd->rollBack();
        }
        error_log('ISP-GOMBE site content management failed.');
        $siteContentMessage = ['type' => 'danger', 'text' => $e instanceof RuntimeException ? $e->getMessage() : 'La table de contenu n’est pas encore installée. Appliquez la migration versionnée.'];
    }
}





