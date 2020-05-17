<?php

$xml = new XMLReader();
$doc = new DOMDocument;

if (!$xml->open(XML_PATH . FILENAME)) {
    die('Failed to open ' . XML_PATH . FILENAME);
}

$subject_fields = require 'config/subject.php';
$tsi_fields = require 'config/termination_started_info.php';
$ep_fields = require 'config/executive_power.php';
$subject_data = $founder_data = $signer_data = $tsi_data = $ep_data = '';
$count = $founder_max = $signer_max = 0;
$subject_max = $tsi_max = $ep_max = [];

$subject_title = 'ID' . chr(9) . implode(chr(9), $subject_fields) . PHP_EOL;
@file_put_contents(TXT_PATH . 'subjects.txt', $subject_title);

@file_put_contents(TXT_PATH . 'founders.txt', 'ID' . chr(9) . 'FOUNDER' . PHP_EOL);
@file_put_contents(TXT_PATH . 'signers.txt', 'ID' . chr(9) . 'SIGNER' . PHP_EOL);

$tsi_title = 'ID' . chr(9) . implode(chr(9), $tsi_fields) . PHP_EOL;
@file_put_contents(TXT_PATH . 'termination_started_info.txt', $tsi_title);

$ep_title = 'ID' . chr(9) . implode(chr(9), $ep_fields) . PHP_EOL;
@file_put_contents(TXT_PATH . 'executive_power.txt', $ep_title);

foreach ($subject_fields as $field) {
    $subject_max[$field] = 0;
}

foreach ($tsi_fields as $field) {
    $tsi_max[$field] = 0;
}

foreach ($ep_fields as $field) {
    $ep_max[$field] = 0;
}

// move to the first node
/** @noinspection PhpStatementHasEmptyBodyInspection */
/** @noinspection LoopWhichDoesNotLoopInspection */
/** @noinspection MissingOrEmptyGroupStatementInspection */
while ($xml->read() && $xml->name !== 'SUBJECT') {}
