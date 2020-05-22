<?php

header('Content-type: text/html; charset=cp1251');
$start_time = microtime(true);

require 'config/main.php';
require 'functions.php';
require 'get_data.php';
require 'pdo.php';
require 'app/QueryBuilder.php';
require 'init.php';

if (SAVE_TO_DB) {
    foreach ($tables as $table) {
        $db->statement('truncate table ' . $table);
    }
    $db->beginTransaction();
}

while ($xml->name === 'SUBJECT') {
    $subject = [];
    $id = $xml->getAttribute('RECORD');
    $subject['ID'] = $id;

    $node = simplexml_import_dom($doc->importNode($xml->expand(), true));

    foreach ($fields['SUBJECTS'] as $field) {
        $subject[$field] = cp1251(trim($node->xpath($field)[0]->__toString()));
        if (strlen($subject[$field]) > $max['SUBJECTS'][$field]) {
            $max['SUBJECTS'][$field] = strlen($subject[$field]);
        }
    }

    $data['SUBJECTS'] .= implode(chr(9), $subject) . PHP_EOL;
    if (SAVE_TO_DB) {
        $db->table('SUBJECTS')->insert($subject);
    }

    $data_array['FOUNDERS'] = getList($id,  $node->xpath('FOUNDERS/FOUNDER'), 'FOUNDER', $max['FOUNDERS']['FOUNDER']);
    $data_array['SIGNERS'] = getList($id, $node->xpath('SIGNERS/SIGNER'), 'SIGNER', $max['SIGNERS']['SIGNER']);

    $data_array['PREDECESSORS'] = getList2($id, $node->xpath('PREDECESSORS/PREDECESSOR'), $max['PREDECESSORS']);
    $data_array['ASSIGNEES'] = getList2($id, $node->xpath('ASSIGNEES/ASSIGNEE'), $max['ASSIGNEES']);

    $data_array['TERMINATION_STARTED_INFO'] = getTerminationStartedInfo($id, $node->xpath('TERMINATION_STARTED_INFO'), $max['TERMINATION_STARTED_INFO']);
    $data_array['BANKRUPTCY_READJUSTMENT_INFO'] = getBankruptcyReadjustmentInfo($id, $node->xpath('BANKRUPTCY_READJUSTMENT_INFO'), $max['BANKRUPTCY_READJUSTMENT_INFO']);
    $data_array['EXECUTIVE_POWER'] = getExecutivePower($id, $node->xpath('EXECUTIVE_POWER'), $max['EXECUTIVE_POWER']);

    $data_array['ACTIVITY_KINDS'] = getActivityKinds($id, $node->xpath('ACTIVITY_KINDS/ACTIVITY_KIND'), $max['ACTIVITY_KINDS']);
    $data_array['EXCHANGE_DATA'] = getExchangeData($id, $node->xpath('EXCHANGE_DATA/EXCHANGE_ANSWER'), $max['EXCHANGE_DATA']);

    $data_array['BRANCHES'] = getBranches($id, $branch_id, $node->xpath('BRANCHES/BRANCH'), $max['BRANCHES']);
    $data_array['BRANCHES_ACTIVITY_KINDS'] = getBranchesActivityKinds($id, $branch_id, $node->xpath('BRANCHES/BRANCH/ACTIVITY_KINDS/ACTIVITY_KIND'), $max['BRANCHES_ACTIVITY_KINDS']);
    $data_array['BRANCHES_EXCHANGE_DATA'] = getBranchesExchangeData($id, $branch_id, $node->xpath('BRANCHES/BRANCH/EXCHANGE_DATA/EXCHANGE_ANSWER'), $max['BRANCHES_EXCHANGE_DATA']);

    foreach ($tables as $table) {
        if (SAVE_TO_DB && $table !== 'SUBJECTS') {
            $db->table($table)->insertArray($data_array[$table]);
        }
        if (SAVE_TO_TXT && $table !== 'SUBJECTS') {
            $data[$table] .= arrayToText($data_array[$table]);
        }
    }

    $xml->next('SUBJECT');
    $count++;

    // Save data to txt files
    if ($count % SAVE_EVERY === 0) {
        save_to_txt($data);
        $data = clearData($tables);
    }

    if (STOP > 0 && $count === STOP) {
        break;
    }
}

if (SAVE_TO_DB) {
    $db->endTransaction();
}

// Save last part
save_to_txt($data);

$xml->close();

require 'save_info.php';

$time = round(microtime(true) - $start_time, 0);

// Save to log
$log_record = date('Y-m-d') . ' ' . date('H:i:s') . '; ' . $count . ' records; ' . $time . ' sec' . PHP_EOL;
@file_put_contents(ROOT . '/load.log', $log_record, FILE_APPEND);

echo '<a href="/">Home</a>';
echo '<h3>Loading is complete!</h3>';
echo '<p>Records: ' . number_format($count, 0, '.', ' ') . '</p>';
echo '<p>Work time: ' . $time . ' sec</p>';
