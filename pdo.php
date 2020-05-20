<?php

$config = require ROOT . '/config/db.php';

$dbDSN = 'mysql:host='.$config['host'].';dbname='.$config['database'].';charset='.$config['charset'];

$dbOptions = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dbDSN, $config['user'], $config['password'], $dbOptions);
} catch (PDOException $e) {
    exit ($e->getMessage());
}
