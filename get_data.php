<?php

/** @noinspection DuplicatedCode */

/*function getList ($id, $node, &$max)
{
    $result = '';
    foreach ($node as $key => $value) {
        $item = cp1251(trim($node[$key]->__toString()));
        if (strlen($item) > $max) {
            $max = strlen($item);
        }
        $record = $id . chr(9) . $item . PHP_EOL;
        $result .= $record;
    }
    return $result;
}*/

function getList ($id, $node, $key_name, &$max)
{
    $result = [];
    foreach ($node as $key => $value) {
        $item = cp1251(trim($node[$key]->__toString()));
        if (strlen($item) > $max) {
            $max = strlen($item);
        }
        $record = ['ID' => $id, $key_name => $item];
        $result[] = $record;
    }
    return $result;
}

/*function getList2 ($id, $node, &$max)
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
}*/

function getList2 ($id, $node, &$max)
{
    $result = [];

    foreach ($node as $item) {
        $arr = [];
        $arr['ID'] = $id;
        $arr['NAME'] = cp1251(trim($item->NAME->__toString()));
        $arr['CODE'] = cp1251(trim($item->CODE->__toString()));

        foreach ($arr as $key => $value) {
            if ($key !== 'ID' && strlen($value) > $max[$key]) {
                $max[$key] = strlen($value);
            }
        }

        $result[] = $arr;
    }

    return $result;
}

/*function getTerminationStartedInfo ($id, $node, &$max)
{
    $result = '';

    foreach ($node as $item) {
        $arr = [];

        $arr['OP_DATE'] = cp1251(trim($item->OP_DATE->__toString()));
        $arr['REASON'] = cp1251(trim($item->REASON->__toString()));
        $arr['SBJ_STATE'] = cp1251(trim($item->SBJ_STATE->__toString()));
        $arr['SIGNER_NAME'] = cp1251(trim($item->SIGNER_NAME->__toString()));
        $arr['CREDITOR_REQ_END_DATE'] = cp1251(trim($item->CREDITOR_REQ_END_DATE->__toString()));

        $string = $trim_string = implode(chr(9), $arr);
        if (trim($trim_string) !== '') {
            foreach ($arr as $key => $value) {
                if (strlen($value) > $max[$key]) {
                    $max[$key] = strlen($value);
                }
            }
            $result .= $id . chr(9) . $string . PHP_EOL;
        }
    }

    return $result;
}*/

function getTerminationStartedInfo ($id, $node, &$max)
{
    $result = [];

    foreach ($node as $item) {
        $arr = [];
        $arr['ID'] = $id;
        $arr['OP_DATE'] = cp1251(trim($item->OP_DATE->__toString()));
        $arr['REASON'] = cp1251(trim($item->REASON->__toString()));
        $arr['SBJ_STATE'] = cp1251(trim($item->SBJ_STATE->__toString()));
        $arr['SIGNER_NAME'] = cp1251(trim($item->SIGNER_NAME->__toString()));
        $arr['CREDITOR_REQ_END_DATE'] = cp1251(trim($item->CREDITOR_REQ_END_DATE->__toString()));

        $trim_record = trim(implode(chr(9), $arr));

        if ($trim_record !== $id) {
            foreach ($arr as $key => $value) {
                if ($key !== 'ID' && strlen($value) > $max[$key]) {
                    $max[$key] = strlen($value);
                }
            }
            $result[] = $arr;
        }
    }

    return $result;
}

/*function getExecutivePower ($id, $node, &$max)
{
    $result = '';

    foreach ($node as $item) {
        $arr = [];

        $arr['NAME'] = cp1251(trim($item->NAME->__toString()));
        $arr['CODE'] = cp1251(trim($item->CODE->__toString()));

        $string = $trim_string = implode(chr(9), $arr);
        if (trim($trim_string) !== '') {
            foreach ($arr as $key => $value) {
                if (strlen($value) > $max[$key]) {
                    $max[$key] = strlen($value);
                }
            }
            $result .= $id . chr(9) . $string . PHP_EOL;
        }
    }

    return $result;
}*/

function getExecutivePower ($id, $node, &$max)
{
    $result = [];

    foreach ($node as $item) {
        $arr = [];
        $arr['ID'] = $id;
        $arr['NAME'] = cp1251(trim($item->NAME->__toString()));
        $arr['CODE'] = cp1251(trim($item->CODE->__toString()));

        $trim_string = trim(implode(chr(9), $arr));

        if ($trim_string !== $id) {
            foreach ($arr as $key => $value) {
                if ($key !== 'ID' && strlen($value) > $max[$key]) {
                    $max[$key] = strlen($value);
                }
            }
            $result[] = $arr;
        }
    }

    return $result;
}

/*function getBankruptcyReadjustmentInfo ($id, $node, &$max)
{
    $result = '';

    foreach ($node as $item) {
        $arr = [];

        $arr['OP_DATE'] = cp1251(trim($item->OP_DATE->__toString()));
        $arr['REASON'] = cp1251(trim($item->REASON->__toString()));
        $arr['SBJ_STATE'] = cp1251(trim($item->SBJ_STATE->__toString()));
        $arr['BANKRUPTCY_READJUSTMENT_HEAD_NAME'] = cp1251(trim($item->BANKRUPTCY_READJUSTMENT_HEAD_NAME->__toString()));

        $string = $trim_string = implode(chr(9), $arr);
        if (trim($trim_string) !== '') {
            foreach ($arr as $key => $value) {
                if (strlen($value) > $max[$key]) {
                    $max[$key] = strlen($value);
                }
            }
            $result .= $id . chr(9) . $string . PHP_EOL;
        }
    }

    return $result;
}*/

function getBankruptcyReadjustmentInfo ($id, $node, &$max)
{
    $result = [];

    foreach ($node as $item) {
        $arr = [];
        $arr['ID'] = $id;
        $arr['OP_DATE'] = cp1251(trim($item->OP_DATE->__toString()));
        $arr['REASON'] = cp1251(trim($item->REASON->__toString()));
        $arr['SBJ_STATE'] = cp1251(trim($item->SBJ_STATE->__toString()));
        $arr['BANKRUPTCY_READJUSTMENT_HEAD_NAME'] = cp1251(trim($item->BANKRUPTCY_READJUSTMENT_HEAD_NAME->__toString()));

        $trim_string = trim(implode(chr(9), $arr));
        if ($trim_string !== $id) {
            foreach ($arr as $key => $value) {
                if ($key !== 'ID' && strlen($value) > $max[$key]) {
                    $max[$key] = strlen($value);
                }
            }
            $result[] = $arr;
        }
    }

    return $result;
}

/*function getActivityKinds ($id, $node, &$max)
{
    $result = '';

    foreach ($node as $item) {
        $arr = [];
        $arr['CODE'] = cp1251(trim($item->CODE->__toString()));
        $arr['NAME'] = cp1251(trim($item->NAME->__toString()));
        $arr['PRIMARY'] = cp1251(trim($item->PRIMARY->__toString()));
        foreach ($arr as $key => $value) {
            if (strlen($value) > $max[$key]) {
                $max[$key] = strlen($value);
            }
        }
        $result .= $id . chr(9) . implode(chr(9), $arr) . PHP_EOL;
    }

    return $result;
}*/

function getActivityKinds ($id, $node, &$max)
{
    $result = [];

    foreach ($node as $item) {
        $arr = [];
        $arr['ID'] = $id;
        $arr['CODE'] = cp1251(trim($item->CODE->__toString()));
        $arr['NAME'] = cp1251(trim($item->NAME->__toString()));
        $arr['PRIMARY'] = cp1251(trim($item->PRIMARY->__toString()));

        foreach ($arr as $key => $value) {
            if ($key !== 'ID' && strlen($value) > $max[$key]) {
                $max[$key] = strlen($value);
            }
        }
        $result[] = $arr;
    }

    return $result;
}

/*function getExchangeData ($id, $node, &$max)
{
    $result = '';

    foreach ($node as $item) {
        $arr = [];
        $arr['AUTHORITY_NAME'] = cp1251(trim($item->AUTHORITY_NAME->__toString()));
        $arr['AUTHORITY_CODE'] = cp1251(trim($item->AUTHORITY_CODE->__toString()));
        $arr['TAX_PAYER_TYPE'] = cp1251(trim($item->TAX_PAYER_TYPE->__toString()));
        $arr['START_DATE'] = cp1251(trim($item->START_DATE->__toString()));
        $arr['START_NUM'] = cp1251(trim($item->START_NUM->__toString()));
        $arr['END_DATE'] = cp1251(trim($item->END_DATE->__toString()));
        $arr['END_NUM'] = cp1251(trim($item->END_NUM->__toString()));
        foreach ($arr as $key => $value) {
            if (strlen($value) > $max[$key]) {
                $max[$key] = strlen($value);
            }
        }
        $result .= $id . chr(9) . implode(chr(9), $arr) . PHP_EOL;
    }

    return $result;
}*/

function getExchangeData ($id, $node, &$max)
{
    $result = [];

    foreach ($node as $item) {
        $arr = [];
        $arr['ID'] = $id;
        $arr['AUTHORITY_NAME'] = cp1251(trim($item->AUTHORITY_NAME->__toString()));
        $arr['AUTHORITY_CODE'] = cp1251(trim($item->AUTHORITY_CODE->__toString()));
        $arr['TAX_PAYER_TYPE'] = cp1251(trim($item->TAX_PAYER_TYPE->__toString()));
        $arr['START_DATE'] = cp1251(trim($item->START_DATE->__toString()));
        $arr['START_NUM'] = cp1251(trim($item->START_NUM->__toString()));
        $arr['END_DATE'] = cp1251(trim($item->END_DATE->__toString()));
        $arr['END_NUM'] = cp1251(trim($item->END_NUM->__toString()));

        foreach ($arr as $key => $value) {
            if ($key !== 'ID' && strlen($value) > $max[$key]) {
                $max[$key] = strlen($value);
            }
        }
        $result[] = $arr;
    }

    return $result;
}

/*function getBranches ($id, &$branch_id, $node, &$max)
{
    $result = '';

    foreach ($node as $item) {
        $arr = [];
        $arr['CODE'] = cp1251(trim($item->CODE->__toString()));
        $arr['NAME'] = cp1251(trim($item->NAME->__toString()));
        $arr['ADDRESS'] = cp1251(trim($item->ADDRESS->__toString()));
        $arr['SIGNER'] = cp1251(trim($item->SIGNER->__toString()));
        $arr['CREATE_DATE'] = cp1251(trim($item->CREATE_DATE->__toString()));
        $arr['CONTACTS'] = cp1251(trim($item->CONTACTS->__toString()));
        $branch_id++;
        foreach ($arr as $key => $value) {
            if (strlen($value) > $max[$key]) {
                $max[$key] = strlen($value);
            }
        }
        $result .= $branch_id . chr(9) . $id . chr(9) . implode(chr(9), $arr) . PHP_EOL;
    }

    return $result;
}*/

function getBranches ($id, &$branch_id, $node, &$max)
{
    $result = [];

    foreach ($node as $item) {
        $arr = [];
        $arr['ID'] = $id;
        $arr['BRANCH_ID'] = $branch_id;
        $arr['CODE'] = cp1251(trim($item->CODE->__toString()));
        $arr['NAME'] = cp1251(trim($item->NAME->__toString()));
        $arr['ADDRESS'] = cp1251(trim($item->ADDRESS->__toString()));
        $arr['SIGNER'] = cp1251(trim($item->SIGNER->__toString()));
        $arr['CREATE_DATE'] = cp1251(trim($item->CREATE_DATE->__toString()));
        $arr['CONTACTS'] = cp1251(trim($item->CONTACTS->__toString()));
        $branch_id++;

        foreach ($arr as $key => $value) {
            if ($key !== 'ID' && $key !== 'BRANCH_ID' && strlen($value) > $max[$key]) {
                $max[$key] = strlen($value);
            }
        }
        $result[] = $arr;
    }

    return $result;
}

/*function getBranchesActivityKinds ($id, $branch_id, $node, &$max)
{
    $result = '';

    foreach ($node as $item) {
        $arr = [];
        $arr['CODE'] = cp1251(trim($item->CODE->__toString()));
        $arr['NAME'] = cp1251(trim($item->NAME->__toString()));
        $arr['PRIMARY'] = cp1251(trim($item->PRIMARY->__toString()));
        foreach ($arr as $key => $value) {
            if (strlen($value) > $max[$key]) {
                $max[$key] = strlen($value);
            }
        }
        $result .= $branch_id . chr(9) . $id . chr(9) . implode(chr(9), $arr) . PHP_EOL;
    }

    return $result;
}*/

function getBranchesActivityKinds ($id, $branch_id, $node, &$max)
{
    $result = [];

    foreach ($node as $item) {
        $arr = [];
        $arr['ID'] = $id;
        $arr['BRANCH_ID'] = $branch_id;
        $arr['CODE'] = cp1251(trim($item->CODE->__toString()));
        $arr['NAME'] = cp1251(trim($item->NAME->__toString()));
        $arr['PRIMARY'] = cp1251(trim($item->PRIMARY->__toString()));
        foreach ($arr as $key => $value) {
            if ($key !== 'ID' && $key !== 'BRANCH_ID' && strlen($value) > $max[$key]) {
                $max[$key] = strlen($value);
            }
        }
        $result[] = $arr;
    }

    return $result;
}

/*function getBranchesExchangeData ($id, $branch_id, $node, &$max)
{
    $result = '';

    foreach ($node as $item) {
        $arr = [];
        $arr['AUTHORITY_NAME'] = cp1251(trim($item->AUTHORITY_NAME->__toString()));
        $arr['AUTHORITY_CODE'] = cp1251(trim($item->AUTHORITY_CODE->__toString()));
        $arr['TAX_PAYER_TYPE'] = cp1251(trim($item->TAX_PAYER_TYPE->__toString()));
        $arr['START_DATE'] = cp1251(trim($item->START_DATE->__toString()));
        $arr['START_NUM'] = cp1251(trim($item->START_NUM->__toString()));
        $arr['END_DATE'] = cp1251(trim($item->END_DATE->__toString()));
        $arr['END_NUM'] = cp1251(trim($item->END_NUM->__toString()));
        foreach ($arr as $key => $value) {
            if (strlen($value) > $max[$key]) {
                $max[$key] = strlen($value);
            }
        }
        $result .= $branch_id . chr(9) . $id . chr(9) . implode(chr(9), $arr) . PHP_EOL;
    }

    return $result;
}*/

function getBranchesExchangeData ($id, $branch_id, $node, &$max)
{
    $result = [];

    foreach ($node as $item) {
        $arr = [];
        $arr['ID'] = $id;
        $arr['BRANCH_ID'] = $branch_id;
        $arr['AUTHORITY_NAME'] = cp1251(trim($item->AUTHORITY_NAME->__toString()));
        $arr['AUTHORITY_CODE'] = cp1251(trim($item->AUTHORITY_CODE->__toString()));
        $arr['TAX_PAYER_TYPE'] = cp1251(trim($item->TAX_PAYER_TYPE->__toString()));
        $arr['START_DATE'] = cp1251(trim($item->START_DATE->__toString()));
        $arr['START_NUM'] = cp1251(trim($item->START_NUM->__toString()));
        $arr['END_DATE'] = cp1251(trim($item->END_DATE->__toString()));
        $arr['END_NUM'] = cp1251(trim($item->END_NUM->__toString()));
        foreach ($arr as $key => $value) {
            if ($key !== 'ID' && $key !== 'BRANCH_ID' && strlen($value) > $max[$key]) {
                $max[$key] = strlen($value);
            }
        }
        $result[] = $arr;
    }

    return $result;
}
