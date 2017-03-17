<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2017/3/13
 * Time: 17:23
 */
include "../MyPDO.class.php";
$db = MyPDO::getInstance('localhost', 'root', '', 'practice', 'utf-8');
const TABLE_M = "t_message";
if (isset($_REQUEST["message"])) {
    //进行入库操作
    //这里要进行判断，如果这个IP地址今天留言了三次，就提示说，今日留言已上限
    $arrayDataValue = [
        "message" => $_REQUEST["message"],
        "message_time" => time(),
        "ip" => $_REQUEST["ip"],
        "artical_id" => $_REQUEST["artical_id"]
    ];
    $result = $db->insert(TABLE_M, $arrayDataValue);
//    var_dump($result);
    if ($result > 0) {
        $errorCode = [
            "errorNo" => "0",
            "message" => "留言成功"
        ];
    } else {
        $errorCode = [
            "errorNo" => "1",
            "message" => "留言失败"
        ];
    }
    echo json_encode($errorCode);
    exit();
}