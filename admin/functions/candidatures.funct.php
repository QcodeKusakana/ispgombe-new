<?php
$candidates = [];
$candidateCount = 0;
$candidateSearch = isset($_GET['q']) && is_string($_GET['q']) ? trim($_GET['q']) : '';
if (mb_strlen($candidateSearch, 'UTF-8') > 100) {
    $candidateSearch = mb_substr($candidateSearch, 0, 100, 'UTF-8');
}
$candidatePage = min(100000, filter_var($_GET['pag'] ?? 1, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]) ?: 1);
$candidatePerPage = 20;
$candidateOffset = 0;
$candidatePages = 1;
if ($bdd instanceof PDO) {
    try {
        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST' && ($_POST['admin_action'] ?? '') === 'delete') {
            if (!csrf_is_valid($_POST['csrf_token'] ?? null)) {
                http_response_code(400);
                exit('Jeton de sécurité invalide. Rechargez la page.');
            }
            $deleteId = filter_var($_POST['record_id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
            if (!$deleteId) {
                http_response_code(400);
                exit('Dossier étudiant invalide.');
            }
            $fileMap = [
                'diplomeAttest' => 'diplome',
                'certificat' => 'certificat',
                'bulletin' => 'bulletin',
                'carteIdentite' => 'carte',
                'attestNaissance' => 'attestation',
            ];
            $fileQuery = $bdd->prepare('SELECT diplomeAttest, certificat, bulletin, carteIdentite, attestNaissance FROM etudiant WHERE id = ?');
            $fileQuery->execute([(int) $deleteId]);
            $studentFiles = $fileQuery->fetch();
            if (!$studentFiles) {
                $_SESSION['admin_action_notice'] = 'Ce dossier étudiant est introuvable.';
                header('Location: ?pages=candidatures'); exit;
            }
            $removeStudent = $bdd->prepare('DELETE FROM etudiant WHERE id = ?');
            $removeStudent->execute([(int) $deleteId]);
            foreach ($fileMap as $column => $directory) {
                $storedName = $studentFiles[$column] ?? '';
                if (!is_string($storedName) || $storedName === '' || basename($storedName) !== $storedName) { continue; }
                $shared = $bdd->prepare('SELECT COUNT(*) FROM etudiant WHERE ' . $column . ' = ?');
                $shared->execute([$storedName]);
                if ((int) $shared->fetchColumn() > 0) { continue; }
                $baseDirectory = realpath(dirname(__DIR__, 2) . '/media/' . $directory);
                $filePath = $baseDirectory === false ? false : realpath($baseDirectory . DIRECTORY_SEPARATOR . $storedName);
                if ($baseDirectory !== false && $filePath !== false && is_file($filePath) && strpos($filePath, $baseDirectory . DIRECTORY_SEPARATOR) === 0) {
                    @unlink($filePath);
                }
            }
            admin_log_action($bdd, 'candidate.delete', 'etudiant', (string) $deleteId);
            $_SESSION['admin_action_notice'] = 'Le dossier étudiant et ses pièces non partagées ont été supprimés.';
            header('Location: ?pages=candidatures'); exit;
        }
        $where = '';
        $parameters = [];
        if ($candidateSearch !== '') {
            $where = ' WHERE e.nom LIKE ? OR e.postnom LIKE ? OR e.prenom LIKE ? OR e.matricule LIKE ? OR e.telephone LIKE ? OR e.email LIKE ?';
            $match = '%' . $candidateSearch . '%';
            $parameters = array_fill(0, 6, $match);
        }
        $count = $bdd->prepare('SELECT COUNT(*) FROM etudiant e' . $where);
        $count->execute($parameters);
        $candidateCount = (int) $count->fetchColumn();
        $candidatePages = max(1, (int) ceil($candidateCount / $candidatePerPage));
        $candidatePage = min($candidatePage, $candidatePages);
        $candidateOffset = ($candidatePage - 1) * $candidatePerPage;
        $statement = $bdd->prepare(
            'SELECT e.id, e.matricule, e.nom, e.postnom, e.prenom, e.telephone, e.email, e.date_inscrit, '
            . 'e.facChoix1, e.depChoix1, e.facChoix2, e.depChoix2, e.etat, e.confirmer, '
            . 'f1.titre AS fac1_titre, d1.titre AS dep1_titre, f2.titre AS fac2_titre, d2.titre AS dep2_titre '
            . 'FROM etudiant e LEFT JOIN faculte f1 ON f1.id = e.facChoix1 LEFT JOIN departement d1 ON d1.id = e.depChoix1 '
            . 'LEFT JOIN faculte f2 ON f2.id = e.facChoix2 LEFT JOIN departement d2 ON d2.id = e.depChoix2'
            . $where . ' ORDER BY e.id DESC LIMIT ? OFFSET ?'
        );
        foreach ($parameters as $index => $parameter) {
            $statement->bindValue($index + 1, $parameter, PDO::PARAM_STR);
        }
        $statement->bindValue(count($parameters) + 1, $candidatePerPage, PDO::PARAM_INT);
        $statement->bindValue(count($parameters) + 2, $candidateOffset, PDO::PARAM_INT);
        $statement->execute();
        $candidates = $statement->fetchAll();
    } catch (PDOException $e) {
        error_log('ISP-GOMBE candidate administration could not be loaded.');
    }
}
$candidatePages = max(1, (int) ceil($candidateCount / $candidatePerPage));
$candidateWindowStart = max(1, $candidatePage - 2);
$candidateWindowEnd = min($candidatePages, $candidatePage + 2);
?>

