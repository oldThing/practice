<?php

/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2017/3/15
 * Time: 10:55
 */
include "../../MyPDO.class.php";
const TABLE_A = 't_classify';
if ($_REQUEST['column_name'] && $_REQUEST['column_id']) {
    $db = MyPDO::getInstance('localhost', 'root', '', 'practice', 'utf-8');
    $arrayDataValue = [
        "column_name" => $_REQUEST["column_name"]
    ];
    $where = "column_id=" . $_REQUEST['column_id'];

    $result = $db->update(TABLE_A, $arrayDataValue, $where);
    if ($result) {
        $errorCode = [
            "errorNo" => "0",
            "message" => "修改成功"
        ];
    } else {
        $errorCode = [
            "errorNo" => "1",
            "message" => "修改失败"
        ];
    }
    echo json_encode($errorCode);
    exit();
}