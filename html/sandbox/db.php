<?php
$url = 'mysql:dbname=classicmodels;host=db-sandbox;port=3306';
//$user = getenv('MYSQL_USER') || 'user';
//$password = getenv('MYSQL_PASSWORD') || '';
//$db = getenv('MYSQL_DATABASE') || '';

try {
    return new PDO($url, 'root', 'secret');
}
catch (PDOException $e) {
    echo '[PDO EXCEPTION]' . $e->getMessage() . "\n";
    die();
}
