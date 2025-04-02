<?php

$helperFiles = glob(__DIR__.'/*.php');

foreach ($helperFiles as $filePath) {
    if (basename($filePath) === 'helpers.php') {
        continue;
    }

    require_once $filePath;
}
