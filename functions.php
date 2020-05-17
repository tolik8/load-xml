<?php

/** @noinspection PhpUnused */
function d()
{
    foreach (func_get_args() as $arg) {
        echo '<pre>';
        /** @noinspection ForgottenDebugOutputInspection */
        var_dump($arg);
        echo '</pre>' . chr(13).chr(10);
    }
}

/** @noinspection PhpUnused */
function dd()
{
    foreach (func_get_args() as $arg) {d($arg);} die;
}

function cp1251($input)
{
    return mb_convert_encoding($input, 'windows-1251', 'utf-8');
}

function getList ($id, &$max_size, $items)
{
    $result = '';
    foreach ($items as $key => $value) {
        $item = $items[$key]->__toString();
        if (strlen($item) > $max_size) {
            $max_size = strlen($item);
        }
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
            $record = $part[0]->__toString();
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
}

function save_to_txt ($data)
{
    foreach ($data as $key => $item) {
        @file_put_contents(TXT_PATH . $key . '.txt', cp1251($item), FILE_APPEND);
    }
}

function clearData ()
{
    return [
        'SUBJECTS' => '',
        'FOUNDERS' => '',
        'SIGNERS' => '',
        'TERMINATION_STARTED_INFO' => '',
        'EXECUTIVE_POWER' => ''
    ];
}
