<?php
require_once __DIR__ . '/php/main_function.php';

header('Content-Type: application/xml; charset=UTF-8');
header('Cache-Control: public, max-age=3600');

$baseUrl = 'https://ispgombe.ac.cd/';
$urls = [];
$addUrl = static function (string $path, ?string $lastModified = null) use (&$urls, $baseUrl): void {
    $urls[] = ['loc' => $baseUrl . ltrim($path, '/'), 'lastmod' => $lastModified];
};
$queryUrl = static fn(array $parameters): string => '?' . http_build_query($parameters, '', '&', PHP_QUERY_RFC3986);

$addUrl('');
foreach ([
    ['pages' => 'isp', 'history' => ''],
    ['pages' => 'isp', 'mission' => ''],
    ['pages' => 'isp', 'vision' => ''],
    ['pages' => 'isp', 'values' => ''],
    ['pages' => 'isp', 'direction' => ''],
    ['pages' => 'isp', 'academique' => ''],
    ['pages' => 'isp', 'recherche' => ''],
    ['pages' => 'isp', 'administratif' => ''],
    ['pages' => 'isp', 'budget' => ''],
    ['pages' => 'isp', 'campus' => ''],
    ['pages' => 'faculte'],
    ['pages' => 'departement'],
    ['pages' => 'campus'],
    ['pages' => 'actualite'],
    ['pages' => 'evenement'],
    ['pages' => 'palmares'],
    ['pages' => 'inscription'],
    ['pages' => 'contact'],
    ['pages' => 'confidentialite'],
] as $parameters) {
    $addUrl($queryUrl($parameters));
}

if ($bdd instanceof PDO) {
    try {
        foreach ($bdd->query('SELECT id_act, date_pub FROM activite WHERE etat_modifier = 1 ORDER BY id_act DESC')->fetchAll() as $row) {
            $timestamp = strtotime((string) ($row['date_pub'] ?? ''));
            $addUrl($queryUrl(['pages' => 'detail', 'id' => (int) $row['id_act']]), $timestamp ? date('Y-m-d', $timestamp) : null);
        }
        foreach ($bdd->query('SELECT id FROM faculte ORDER BY id')->fetchAll(PDO::FETCH_COLUMN) as $id) {
            $addUrl($queryUrl(['pages' => 'detail_section', 'info' => (int) $id]));
        }
        foreach ($bdd->query('SELECT id FROM departement ORDER BY id')->fetchAll(PDO::FETCH_COLUMN) as $id) {
            $addUrl($queryUrl(['pages' => 'detail_departement', 'dep' => (int) $id]));
        }
    } catch (Throwable $exception) {
        error_log('ISP-GOMBE sitemap database records could not be loaded.');
    }
}

echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
echo "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";
foreach ($urls as $url) {
    echo "  <url><loc>" . htmlspecialchars($url['loc'], ENT_XML1 | ENT_QUOTES, 'UTF-8') . '</loc>';
    if ($url['lastmod']) {
        echo '<lastmod>' . htmlspecialchars($url['lastmod'], ENT_XML1 | ENT_QUOTES, 'UTF-8') . '</lastmod>';
    }
    echo "</url>\n";
}
echo "</urlset>\n";
