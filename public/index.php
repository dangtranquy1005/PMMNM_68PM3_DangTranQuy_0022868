<?php
require_once __DIR__ . '/../app/controllers/auth.php';
$login = new auth();
$login->login();
?>