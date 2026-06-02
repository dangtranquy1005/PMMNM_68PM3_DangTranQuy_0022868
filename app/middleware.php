<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/core/App.php';

class middleware {
    function checklogin() {
        $url = isset($_GET['url']) ? trim($_GET['url'], '/') : '';
        
        $publicRoutes = ['home/login', 'auth/login'];
        
        if (!isset($_SESSION['username'])) {
            if (!in_array($url, $publicRoutes)) {
                header('Location: ' . BASE_URL . '/home/login');
                exit();
            }
        }
    }
}
?>