<?php

$xml = new XMLReader();
$doc = new DOMDocument;
$count = 0;
$branch_id = 1;
$fields = $max = [];

$filename = $_GET['xml'];

if (!$xml->open(XML_PATH . $filename)) {
    die('Failed to open ' . XML_PATH . $filename);
}

foreach ($tables as $table) {
    /** @noinspection PhpIncludeInspection */
    $fields[$table] = require 'config/fields/' . $table . '.php';
    $title[$table] = 'ID' . chr(9) . implode(chr(9), $fields[$table]) . PHP_EOL;
    if (strpos($table, 'BRANCHES') === 0) {
        $title[$table] = 'BRANCH_ID' . chr(9) . $title[$table];
    }
    foreach ($fields[$table] as $field) {
        $max[$table][$field] = 0;
    }
    if (SAVE_TO_TXT) {
        @file_put_contents(TXT_PATH . strtolower($table) . '.txt', $title[$table]);
    }
}

$data = clearData($tables);

$db = new QueryBuilder($pdo);

// Move to the first node
/** @noinspection PhpStatementHasEmptyBodyInspection */
/** @noinspection LoopWhichDoesNotLoopInspection */
/** @noinspection MissingOrEmptyGroupStatementInspection */
while ($xml->read() && $xml->name !== 'SUBJECT') {}
