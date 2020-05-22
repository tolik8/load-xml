<?php

require 'config/main.php';
require 'functions.php';

$files = scandir(XML_PATH);
$xml_files = [];

echo '<h3>LOAD UO FULL XML</h3>';

$max_execution_time =ini_get('max_execution_time');
echo '<p>Parameter max_execution_time = ' . $max_execution_time . ' (seconds)</p>';

if ($max_execution_time < 7200) {
    echo '<p>Set parameter max_execution_time=7200 in php.ini</p>';
}

$pattern = '#^.*(-ex_xml_edr_uo_full_)\d{2}\.\d{2}\.\d{4}\.xml$#i';

foreach ($files as $file) {
    if (preg_match($pattern, $file)) {
        $xml_files[] = $file;
        echo '<p><a href="load_uo_full.php?xml=' . $file . '">' . $file . '</a></p>';
    }
}

if (count($xml_files) === 0) {
    echo 'Not found *-ex_xml_edr_uo_full_dd.mm.yyyy.xml<br>';
    echo 'in folder ' . XML_PATH;
}
