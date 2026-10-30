<?php
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $name = is_string($_POST['name'] ?? null) ? trim($_POST['name']) : '';
    $email = is_string($_POST['email'] ?? null) ? trim($_POST['email']) : '';
    $subject = is_string($_POST['subject'] ?? null) ? trim($_POST['subject']) : '';
    $message = is_string($_POST['message'] ?? null) ? trim($_POST['message']) : '';
    $postedStart = filter_var($_POST['form_started_at'] ?? null, FILTER_VALIDATE_INT) ?: 0;
    $sessionStart = (int) ($_SESSION['contact_form_started_at'] ?? 0);

    if (!empty($_POST['website'])) {
        $_SESSION['contact_form_message'] = ['type' => 'success', 'text' => 'Votre message a bien été reçu.'];
    } elseif (!csrf_is_valid($_POST['csrf_token'] ?? null) || $postedStart === 0 || $postedStart !== $sessionStart || time() - $sessionStart < 3 || time() - $sessionStart > 3600) {
        $_SESSION['contact_form_message'] = ['type' => 'danger', 'text' => 'Le formulaire a expiré. Rechargez la page puis réessayez.'];
    } elseif (!$bdd instanceof PDO) {
        $_SESSION['contact_form_message'] = ['type' => 'danger', 'text' => 'Le service de contact est temporairement indisponible.'];
    } elseif ($name === '' || mb_strlen($name, 'UTF-8') > 200 || !filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email, 'UTF-8') > 100 || $subject === '' || mb_strlen($subject, 'UTF-8') > 100 || $message === '' || mb_strlen($message, 'UTF-8') > 10000) {
        $_SESSION['contact_form_message'] = ['type' => 'danger', 'text' => 'Vérifiez les champs obligatoires et leurs longueurs.'];
    } else {
        try {
            $statement = $bdd->prepare('INSERT INTO contact (name, email, subject, message) VALUES (?, ?, ?, ?)');
            $statement->execute([$name, $email, $subject, $message]);
            $_SESSION['contact_form_message'] = ['type' => 'success', 'text' => 'Votre message a bien été reçu.'];
        } catch (PDOException $e) {
            error_log('ISP-GOMBE contact message could not be stored.');
            $_SESSION['contact_form_message'] = ['type' => 'danger', 'text' => 'Le service de contact est temporairement indisponible.'];
        }
    }
    unset($_SESSION['contact_form_started_at']);
    header('Location:?pages=contact', true, 303);
    exit;
}
?>
