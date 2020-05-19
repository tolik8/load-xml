<?php

const FILENAME = '17.1-EX_XML_EDR_UO_FULL_08.05.2020.xml';
//const FILENAME = 'uo_full_mini.xml';

const PATH = 'u:/load-xml.loc/';
const XML_PATH = PATH . 'xml/';
const TXT_PATH = PATH . 'txt/';
const INFO_PATH = PATH . 'info/';
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
