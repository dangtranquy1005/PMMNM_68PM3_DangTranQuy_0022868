<?php
    require_once '../app/core/App.php';
    $app = new App();
    echo "<pre>";
    print_r($app->UrlProcess());
    echo "</pre>";

?>