<?php

define('ROOT', $_SERVER['DOCUMENT_ROOT']);

const FILENAME = '17.1-EX_XML_EDR_UO_FULL_15.05.2020.xml';
//const FILENAME = 'uo_full_mini.xml';

const XML_PATH = ROOT . '/xml/';
const TXT_PATH = ROOT . '/txt/';
const INFO_PATH = ROOT . '/info/';
const SAVE_EVERY = 2000;
const SAVE_TO_TXT = true;

$files = [
    'SUBJECTS',
    'FOUNDERS',
    'SIGNERS',
    'TERMINATION_STARTED_INFO',
    'BANKRUPTCY_READJUSTMENT_INFO',
    'EXECUTIVE_POWER',
    'ACTIVITY_KINDS',
    'EXCHANGE_DATA',
    'PREDECESSORS',
    'ASSIGNEES',
    'BRANCHES',
    'BRANCHES_ACTIVITY_KINDS',
    'BRANCHES_EXCHANGE_DATA',
];
