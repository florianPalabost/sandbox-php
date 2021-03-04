<?php
$user = getenv('POSTGRES_USER') || 'user';
$password = getenv('POSTGRES_PASSWORD') || '';
$db = getenv('POSTGRES_DB') || '';

try {
    return new PDO($user, $password, [$db]);
}
catch (PDOException $e) {
    echo '[PDO EXCEPTION]' . $e->getMessage() . "\n";
    die();
}
