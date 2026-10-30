<?php
require_once __DIR__ . '/../../php/main_function.php';

function ajax_positive_id(string $field): ?int
{
    if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
        http_response_code(405);
        header('Allow: POST');
        return null;
    }

    $id = filter_var($_POST[$field] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
    if ($id === false || $id === null) {
        http_response_code(400);
        return null;
    }

    return $id;
}

function ajax_render_options(PDOStatement $statement, string $placeholder, string $valueColumn, string $labelColumn): void
{
    header('Content-Type: text/html; charset=UTF-8');
    header('Cache-Control: no-store, max-age=0');
    echo '<option value="">' . htmlspecialchars($placeholder, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</option>';
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $value = htmlspecialchars((string) ($row[$valueColumn] ?? ''), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        $label = htmlspecialchars((string) ($row[$labelColumn] ?? ''), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        echo '<option value="' . $value . '">' . $label . '</option>';
    }
}
