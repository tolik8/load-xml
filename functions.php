<?php

/** @noinspection PhpUnused */
function d()
{
    foreach (func_get_args() as $arg) {
        echo '<pre>';
        /** @noinspection ForgottenDebugOutputInspection */
        var_dump($arg);
        echo '</pre><hr>' . PHP_EOL;
    }
}

/** @noinspection PhpUnused */
function dd()
{
    foreach (func_get_args() as $arg) {d($arg);} die;
}

function ifd($variable, $value, $input)
{
    /** @noinspection TypeUnsafeComparisonInspection */
    if ($variable == $value) {
        d($input);
    }
}

function cp1251($input)
{
    //return mb_convert_encoding($input, 'windows-1251', 'utf-8');
    return iconv('utf-8', 'windows-1251', $input);
}

function getList ($id, &$max_size, $items)
{
    $result = '';
    foreach ($items as $key => $value) {
        //$item = trim($items[$key]->__toString());
        $item = $items[$key]->__toString();
        /*if (strlen($item) > $max_size) {
            $max_size = strlen($item);
        }*/
        $string = $id . chr(9) . $item . PHP_EOL;
        $result .= $string;
    }
    return $result;
}

function getData ($fields, &$max, $id, $node, $node_name)
{
    $string = '';
    $arr = [];

    foreach ($fields as $field) {
        $part = $node->xpath($node_name . '/' . $field);
        if (!empty($part)) {
            //$record = trim($part[0]->__toString());
            $record = $part[0]->__toString();
            $arr[$field] = $record;
            /*if (strlen($record) > $max[$field]) {
                $max[$field] = strlen($record);
            }*/
        }
    }

    if (count($arr) > 0) {
        $string = $id . chr(9) . implode(chr(9), $arr) . PHP_EOL;
    }

    return $string;
}

function save_to_txt ($data)
{
    if (SAVE_TO_TXT) {
        foreach ($data as $key => $item) {
            @file_put_contents(TXT_PATH . $key . '.txt', cp1251($item), FILE_APPEND);
        }
    }
}

function clearData ()
{
    return [
        'SUBJECTS' => '',
        'FOUNDERS' => '',
        'SIGNERS' => '',
        'TERMINATION_STARTED_INFO' => '',
        'EXECUTIVE_POWER' => '',
        'ACTIVITY_KINDS' => ''
    ];
}

function getTerminationStartedInfo ($id, $tsi_node)
{
    $result = '';

    foreach ($tsi_node as $item) {
        $tsi = [];

        $tsi['OP_DATE'] = $item->OP_DATE->__toString();
        $tsi['REASON'] = $item->REASON->__toString();
        $tsi['SBJ_STATE'] = $item->SBJ_STATE->__toString();
        $tsi['SIGNER_NAME'] = $item->SIGNER_NAME->__toString();
        $tsi['CREDITOR_REQ_END_DATE'] = $item->CREDITOR_REQ_END_DATE->__toString();

        $string = $string2 = implode(chr(9), $tsi);
        if (trim($string2) !== '') {
            $result .= $id . chr(9) . $string . PHP_EOL;
        }
    }

    return $result;
}

function getActivityKind ($id, $ak_node)
{
    $result = '';

    foreach ($ak_node as $item) {
        $ak = [];
        $ak['CODE'] = $item->CODE->__toString();
        $ak['NAME'] = $item->NAME->__toString();
        $ak['PRIMARY'] = $item->PRIMARY->__toString();
        $result .= $id . chr(9) . implode(chr(9), $ak) . PHP_EOL;
    }

    return $result;
}
