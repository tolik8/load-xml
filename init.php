<?php

$xml = new XMLReader();
$doc = new DOMDocument;
$count = $branch_id = 0;
$fields = $max = [];

$filename = $_GET['xml'];

if (!$xml->open(XML_PATH . $filename)) {
    die('Failed to open ' . XML_PATH . $filename);
}

foreach ($files as $file) {
    /** @noinspection PhpIncludeInspection */
    $fields[$file] = require 'config/fields/' . $file . '.php';
    $title[$file] = 'ID' . chr(9) . implode(chr(9), $fields[$file]) . PHP_EOL;
    if (strpos($file, 'BRANCHES') === 0) {
        $title[$file] = 'BRANCH_ID' . chr(9) . $title[$file];
    }
    foreach ($fields[$file] as $field) {
        $max[$file][$field] = 0;
    }
    if (SAVE_TO_TXT) {
        @file_put_contents(TXT_PATH . strtolower($file) . '.txt', $title[$file]);
    }
}

$data = clearData($files);

$db = new QueryBuilder($pdo);

// Move to the first node
/** @noinspection PhpStatementHasEmptyBodyInspection */
/** @noinspection LoopWhichDoesNotLoopInspection */
/** @noinspection MissingOrEmptyGroupStatementInspection */
while ($xml->read() && $xml->name !== 'SUBJECT') {}
