<?php
/**
 * Require all files in sandbox directory
 * avoid to require each files
 */

$repRessources = scandir('./sandbox', 1);
foreach ($repRessources as $file) {
    // skip db file and others non required
    $skipFiles = ['db.php' , '.', '..'];

    if (in_array($file, $skipFiles)) continue;

    try {
        if (file_exists('sandbox/' . $file)) {
            require_once('sandbox/' . $file);
        }

    }
    catch (Exception $e) {
        echo '[REQUIRED FILES ERROR]' . $e->getMessage() . "\n";
    }
}