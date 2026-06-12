<?php
$basePath = dirname($_SERVER['SCRIPT_NAME']);
$basePath = str_replace('\\', '/', $basePath);
if ($basePath === '/') {
    $basePath = '';
}
define('BASE_URL', $basePath);

require_once '../app/middleware.php';
$middleware = new middleware();
$middleware->checklogin();

$app = new App();
?>