<?php

header('Content-type: text/html; charset=cp1251');
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
        $subject[$field] = cp1251(trim($node->xpath($field)[0]->__toString()));
        if (strlen($subject[$field]) > $subject_max[$field]) {
            $subject_max[$field] = strlen($subject[$field]);
        }
    }

    $data['SUBJECTS'] .= implode(chr(9), $subject) . PHP_EOL;
    $data['FOUNDERS'] .= getList($id, $node->xpath('FOUNDERS/FOUNDER'), $founder_max);
    $data['SIGNERS'] .= getList($id, $node->xpath('SIGNERS/SIGNER'), $signer_max);
    $data['TERMINATION_STARTED_INFO'] .= getTerminationStartedInfo($id, $node->xpath('TERMINATION_STARTED_INFO'), $tsi_max);
    $data['EXECUTIVE_POWER'] .= getExecutivePower($id, $node->xpath('EXECUTIVE_POWER'), $ep_max);
    $data['ACTIVITY_KINDS'] .= getActivityKind($id, $node->xpath('ACTIVITY_KINDS/ACTIVITY_KIND'), $ak_max);
    $data['EXCHANGE_DATA'] .= getExchangeAnswer($id, $node->xpath('EXCHANGE_DATA/EXCHANGE_ANSWER'), $ed_max);
    $data['PREDECESSORS'] .= getList2($id, $node->xpath('PREDECESSORS/PREDECESSOR'), $predecessors_max);
    $data['ASSIGNEES'] .= getList2($id, $node->xpath('ASSIGNEES/ASSIGNEE'), $assignees_max);

    $count++;

    // Save data to txt files
    if ($count % SAVE_EVERY === 0) {
        save_to_txt($data);
        $data = clearData();
    }

    $xml->next('SUBJECT');
    if ($count === 100000) {break;}
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
