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

function clearData ($files)
{
    $data = [];
    foreach ($files as $file) {
        $data[$file] = '';
    }
    return $data;
}

function save_to_txt ($data)
{
    if (SAVE_TO_TXT) {
        foreach ($data as $key => $item) {
            @file_put_contents(TXT_PATH . strtolower($key) . '.txt', $item, FILE_APPEND);
        }
    }
}
