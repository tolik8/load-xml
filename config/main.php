<?php

define('ROOT', $_SERVER['DOCUMENT_ROOT']);
ini_set('max_execution_time', 7200);

const XML_PATH = ROOT . '/xml/';
const TXT_PATH = ROOT . '/txt/';
const INFO_PATH = ROOT . '/info/';
const SAVE_EVERY = 1000;
const SAVE_TO_TXT = true;
const SAVE_TO_DB = true;
// Stop after X records
const STOP = 100;

$tables = require ROOT . '/config/tables.php';
