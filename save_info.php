<?php

$subject_info = $tsi_info = $ep_info = $ak_info = $ed_info = $predecessors_info = $assignees_info = '';

foreach ($subject_max as $key => $value) {
    $subject_info .= $key . ' ' .$value . PHP_EOL;
}

foreach ($tsi_max as $key => $value) {
    $tsi_info .= $key . ' ' .$value . PHP_EOL;
}

foreach ($ep_max as $key => $value) {
    $ep_info .= $key . ' ' .$value . PHP_EOL;
}

foreach ($ak_max as $key => $value) {
    $ak_info .= $key . ' ' .$value . PHP_EOL;
}

foreach ($ed_max as $key => $value) {
    $ed_info .= $key . ' ' .$value . PHP_EOL;
}

foreach ($predecessors_max as $key => $value) {
    $predecessors_info .= $key . ' ' .$value . PHP_EOL;
}

foreach ($assignees_max as $key => $value) {
    $assignees_info .= $key . ' ' .$value . PHP_EOL;
}

@file_put_contents(INFO_PATH . 'subjects.txt', $subject_info);
@file_put_contents(INFO_PATH . 'founders.txt', 'FOUNDER ' . $founder_max);
@file_put_contents(INFO_PATH . 'signers.txt', 'SIGNER ' . $signer_max);
@file_put_contents(INFO_PATH . 'termination_started_info.txt', $tsi_info);
@file_put_contents(INFO_PATH . 'executive_power.txt', $ep_info);
@file_put_contents(INFO_PATH . 'activity_kinds.txt', $ak_info);
@file_put_contents(INFO_PATH . 'exchange_data.txt', $ed_info);
@file_put_contents(INFO_PATH . 'predecessors.txt', $predecessors_info);
@file_put_contents(INFO_PATH . 'assignees.txt', $assignees_info);
