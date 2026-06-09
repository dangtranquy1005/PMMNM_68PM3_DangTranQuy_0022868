<?php
$basePath = dirname($_SERVER['SCRIPT_NAME']);
$basePath = str_replace('\\', '/', $basePath);
if ($basePath === '/') {
    $basePath = '';
}
define('BASE_URL', $basePath);

// Fallback: Parse query parameters from REQUEST_URI to populate $_GET (fixes htaccess rewrite losing parameters)
if (isset($_SERVER['REQUEST_URI'])) {
    $parts = parse_url($_SERVER['REQUEST_URI']);
    if (isset($parts['query'])) {
        parse_str($parts['query'], $queryData);
        foreach ($queryData as $key => $value) {
            if (!isset($_GET[$key])) {
                $_GET[$key] = $value;
            }
        }
    }
}

require_once '../app/middleware.php';
$middleware = new middleware();
$middleware->checklogin();

$app = new App();
?>