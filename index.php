<?php

$start_time = microtime(true);

require 'config/main.php';
require 'functions.php';
require 'init.php';

$data = clearData();

while ($xml->name === 'SUBJECT') {
    $subject = [];
    $id = $xml->getAttribute('RECORD');
    $subject['ID'] = $id;

    $node = simplexml_import_dom($doc->importNode($xml->expand(), true));

    foreach ($subject_fields as $field) {
        $subject[$field] = $node->xpath($field)[0]->__toString();
        if (strlen($subject[$field]) > $subject_max[$field]) {
            $subject_max[$field] = strlen($subject[$field]);
        }
    }

    $data['SUBJECTS'] .= implode(chr(9), $subject) . PHP_EOL;

    $data['FOUNDERS'] .= getList($id, $founder_max, $node->xpath('FOUNDERS/FOUNDER'));

    $data['SIGNERS'] .= getList($id, $signer_max, $node->xpath('SIGNERS/SIGNER'));

    $data['TERMINATION_STARTED_INFO'] .= getData($tsi_fields, $tsi_max, $id, $node, 'TERMINATION_STARTED_INFO');

    $data['EXECUTIVE_POWER'] .= getData($ep_fields, $ep_max, $id, $node, 'EXECUTIVE_POWER');

    $count++;

    // Save data to txt files
    if ($count % SAVE_EVERY === 0) {
        save_to_txt($data);
        $data = clearData();
    }

    $xml->next('SUBJECT');
    if ($count === 10000) {break;}
}

// Save last part
save_to_txt($data);

$xml->close();

require 'save_info.php';

$time = round(microtime(true) - $start_time, 4);

// Save to log
$log_record = date('Y-m-d') . ' ' . date('H:i:s') . '; ' . $count . ' records; ' . $time . ' sec' . PHP_EOL;
@file_put_contents(PATH . 'load.log', $log_record, FILE_APPEND);

echo '<h3>Loading is complete!</h3>';

echo '<p>Records: ' . number_format($count, 0, '.', ' ') . '</p>';
echo '<p>Work time: ' . $time . ' sec</p>';
