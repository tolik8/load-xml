<?php

foreach ($files as $file) {
    $info[$file] = '';
    foreach ($max[$file] as $key => $value) {
        $info[$file] .= $key . ' ' .$value . PHP_EOL;
    }
    @file_put_contents(INFO_PATH . strtolower($file) . '.txt', $info[$file]);
}
