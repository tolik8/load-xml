<?php

foreach ($tables as $table) {
    $info[$table] = '';
    foreach ($max[$table] as $key => $value) {
        $info[$table] .= $key . ' ' .$value . PHP_EOL;
    }
    @file_put_contents(INFO_PATH . strtolower($table) . '.txt', $info[$table]);
}
