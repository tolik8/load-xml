<?php

$start_time = microtime(true);

$path = 'u:/load-xml.loc/xml/';
//$filename = '17.1-EX_XML_EDR_UO_FULL_08.05.2020.xml';
//$filename = 'uo_full_mini_or.xml';
$filename = 'uo_full_mini.xml';

$xml = new XMLReader();
$doc = new DOMDocument;

if (!$xml->open($path . $filename)) {
    die('Failed to open ' . $path . $filename);
}

$subject_fields = require 'config/subject_fields.php';
$data = $max_size_subject_fields = [];
$title_record = 'ID' . chr(9) . implode(chr(9), $subject_fields) . PHP_EOL;
@file_put_contents('u:/load-xml.loc/csv/subjects.csv', $title_record);
var_dump($title_record);

foreach ($subject_fields as $field) {
    $max_size_subject_fields[$field] = 0;
}

// move to the first node
while ($xml->read() && $xml->name !== 'SUBJECT') {}

while ($xml->name === 'SUBJECT') {
    $record = [];
    $id = $xml->getAttribute('RECORD');
    $record['ID'] = $id;

    $node = simplexml_import_dom($doc->importNode($xml->expand(), true));

    foreach($subject_fields as $field) {
        $record[$field] = $node->xpath($field)[0]->__toString();
        if (strlen($record[$field]) > $max_size_subject_fields[$field]) {
            $max_size_subject_fields[$field] = strlen($record[$field]);
        }
    }

    //$data[] = $record;
    $record_string = implode(chr(9), $record) . PHP_EOL;
    @file_put_contents('u:/load-xml.loc/csv/subjects.csv', $record_string, FILE_APPEND);
    var_dump($record_string);
    $xml->next('SUBJECT');
}

$xml->close();

$work_time = round(microtime(true) - $start_time, 4);
echo 'Work time: ' . $work_time . '<br>';
var_dump($max_size_subject_fields);
//var_dump($data);
