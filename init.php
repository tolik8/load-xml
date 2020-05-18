<?php

/** @noinspection DuplicatedCode */

$xml = new XMLReader();
$doc = new DOMDocument;

if (!$xml->open(XML_PATH . FILENAME)) {
    die('Failed to open ' . XML_PATH . FILENAME);
}

$subject_fields = require 'config/subject.php';
$tsi_fields = require 'config/termination_started_info.php';
$ep_fields = require 'config/executive_power.php';
$ak_fields = require 'config/activity_kinds.php';
$ed_fields = require 'config/exchange_data.php';
$predecessors_fields = require 'config/predecessors.php';
$assignees_fields = require 'config/assignees.php';

$count = 0;
$founder_max = $signer_max = 0;
$subject_max = $tsi_max = $ep_max = $ak_max = $ed_max = $predecessors_max = $assignees_max = [];

$subject_title = 'ID' . chr(9) . implode(chr(9), $subject_fields) . PHP_EOL;
$founder_title = 'ID' . chr(9) . 'FOUNDER' . PHP_EOL;
$signer_title = 'ID' . chr(9) . 'SIGNER' . PHP_EOL;
$tsi_title = 'ID' . chr(9) . implode(chr(9), $tsi_fields) . PHP_EOL;
$ep_title = 'ID' . chr(9) . implode(chr(9), $ep_fields) . PHP_EOL;
$ak_title = 'ID' . chr(9) . implode(chr(9), $ak_fields) . PHP_EOL;
$ed_title = 'ID' . chr(9) . implode(chr(9), $ed_fields) . PHP_EOL;
$predecessors_title = 'ID' . chr(9) . implode(chr(9), $predecessors_fields) . PHP_EOL;
$assignees_title = 'ID' . chr(9) . implode(chr(9), $assignees_fields) . PHP_EOL;

if (SAVE_TO_TXT) {
    @file_put_contents(TXT_PATH . 'subjects.txt', $subject_title);
    @file_put_contents(TXT_PATH . 'founders.txt', $founder_title);
    @file_put_contents(TXT_PATH . 'signers.txt', $signer_title);
    @file_put_contents(TXT_PATH . 'termination_started_info.txt', $tsi_title);
    @file_put_contents(TXT_PATH . 'executive_power.txt', $ep_title);
    @file_put_contents(TXT_PATH . 'activity_kinds.txt', $ak_title);
    @file_put_contents(TXT_PATH . 'exchange_data.txt', $ed_title);
    @file_put_contents(TXT_PATH . 'predecessors.txt', $predecessors_title);
    @file_put_contents(TXT_PATH . 'assignees.txt', $assignees_title);
}

foreach ($subject_fields as $field) {
    $subject_max[$field] = 0;
}

foreach ($tsi_fields as $field) {
    $tsi_max[$field] = 0;
}

foreach ($ep_fields as $field) {
    $ep_max[$field] = 0;
}

foreach ($ak_fields as $field) {
    $ak_max[$field] = 0;
}

foreach ($ed_fields as $field) {
    $ed_max[$field] = 0;
}

foreach ($predecessors_fields as $field) {
    $predecessors_max[$field] = 0;
}

foreach ($assignees_fields as $field) {
    $assignees_max[$field] = 0;
}

// move to the first node
/** @noinspection PhpStatementHasEmptyBodyInspection */
/** @noinspection LoopWhichDoesNotLoopInspection */
/** @noinspection MissingOrEmptyGroupStatementInspection */
while ($xml->read() && $xml->name !== 'SUBJECT') {}
