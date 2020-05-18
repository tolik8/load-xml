<?php

/** @noinspection DuplicatedCode */

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

function getList ($id, $items, &$max_size)
{
    $result = '';
    foreach ($items as $key => $value) {
        $item = cp1251(trim($items[$key]->__toString()));
        if (strlen($item) > $max_size) {
            $max_size = strlen($item);
        }
        $string = $id . chr(9) . $item . PHP_EOL;
        $result .= $string;
    }
    return $result;
}

/*function getData ($fields, &$max, $id, $node, $node_name)
{
    $string = '';
    $arr = [];

    foreach ($fields as $field) {
        $part = $node->xpath($node_name . '/' . $field);
        if (!empty($part)) {
            $record = trim($part[0]->__toString());
            $arr[$field] = $record;
            if (strlen($record) > $max[$field]) {
                $max[$field] = strlen($record);
            }
        }
    }

    if (count($arr) > 0) {
        $string = $id . chr(9) . implode(chr(9), $arr) . PHP_EOL;
    }

    return $string;
}*/

function getTerminationStartedInfo ($id, $tsi_node, &$tsi_max)
{
    $result = '';

    foreach ($tsi_node as $item) {
        $tsi = [];

        $tsi['OP_DATE'] = cp1251(trim($item->OP_DATE->__toString()));
        $tsi['REASON'] = cp1251(trim($item->REASON->__toString()));
        $tsi['SBJ_STATE'] = cp1251(trim($item->SBJ_STATE->__toString()));
        $tsi['SIGNER_NAME'] = cp1251(trim($item->SIGNER_NAME->__toString()));
        $tsi['CREDITOR_REQ_END_DATE'] = cp1251(trim($item->CREDITOR_REQ_END_DATE->__toString()));

        $string = $trim_string = implode(chr(9), $tsi);
        if (trim($trim_string) !== '') {
            foreach ($tsi as $key => $value) {
                if (strlen($value) > $tsi_max[$key]) {
                    $tsi_max[$key] = strlen($value);
                }
            }
            $result .= $id . chr(9) . $string . PHP_EOL;
        }
    }

    return $result;
}

function getExecutivePower ($id, $ep_node, &$ep_max)
{
    $result = '';

    foreach ($ep_node as $item) {
        $ep = [];

        $ep['NAME'] = cp1251(trim($item->NAME->__toString()));
        $ep['CODE'] = cp1251(trim($item->CODE->__toString()));

        $string = $trim_string = implode(chr(9), $ep);
        if (trim($trim_string) !== '') {
            foreach ($ep as $key => $value) {
                if (strlen($value) > $ep_max[$key]) {
                    $ep_max[$key] = strlen($value);
                }
            }
            $result .= $id . chr(9) . $string . PHP_EOL;
        }
    }

    return $result;
}

function save_to_txt ($data)
{
    if (SAVE_TO_TXT) {
        foreach ($data as $key => $item) {
            //@file_put_contents(TXT_PATH . $key . '.txt', cp1251($item), FILE_APPEND);
            @file_put_contents(TXT_PATH . $key . '.txt', $item, FILE_APPEND);
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
        'ACTIVITY_KINDS' => '',
        'EXCHANGE_DATA' => '',
        'PREDECESSORS' => '',
        'ASSIGNEES' => '',
    ];
}

function getActivityKind ($id, $ak_node, &$ak_max)
{
    $result = '';

    foreach ($ak_node as $item) {
        $ak = [];
        $ak['CODE'] = cp1251(trim($item->CODE->__toString()));
        $ak['NAME'] = cp1251(trim($item->NAME->__toString()));
        $ak['PRIMARY'] = cp1251(trim($item->PRIMARY->__toString()));
        foreach ($ak as $key => $value) {
            if (strlen($value) > $ak_max[$key]) {
                $ak_max[$key] = strlen($value);
            }
        }
        $result .= $id . chr(9) . implode(chr(9), $ak) . PHP_EOL;
    }

    return $result;
}

function getExchangeAnswer ($id, $ed_node, &$ed_max)
{
    $result = '';

    foreach ($ed_node as $item) {
        $ed = [];
        $ed['AUTHORITY_NAME'] = cp1251(trim($item->AUTHORITY_NAME->__toString()));
        $ed['AUTHORITY_CODE'] = cp1251(trim($item->AUTHORITY_CODE->__toString()));
        $ed['TAX_PAYER_TYPE'] = cp1251(trim($item->TAX_PAYER_TYPE->__toString()));
        $ed['START_DATE'] = cp1251(trim($item->START_DATE->__toString()));
        $ed['START_NUM'] = cp1251(trim($item->START_NUM->__toString()));
        $ed['END_DATE'] = cp1251(trim($item->END_DATE->__toString()));
        $ed['END_NUM'] = cp1251(trim($item->END_NUM->__toString()));
        foreach ($ed as $key => $value) {
            if (strlen($value) > $ed_max[$key]) {
                $ed_max[$key] = strlen($value);
            }
        }
        $result .= $id . chr(9) . implode(chr(9), $ed) . PHP_EOL;
    }

    return $result;
}

function getList2 ($id, $node, &$max)
{
    $result = '';

    foreach ($node as $item) {
        $arr = [];
        $arr['NAME'] = cp1251(trim($item->NAME->__toString()));
        $arr['CODE'] = cp1251(trim($item->CODE->__toString()));
        foreach ($arr as $key => $value) {
            if (strlen($value) > $max[$key]) {
                $max[$key] = strlen($value);
            }
        }
        $result .= $id . chr(9) . implode(chr(9), $arr) . PHP_EOL;
    }

    return $result;
}
