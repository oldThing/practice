<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2017/3/13
 * Time: 17:23
 */
include "../MyPDO.class.php";
$db = MyPDO::getInstance('localhost','root','','practice','utf-8');
const TABLE_M = "t_message";
if(isset($_REQUEST["message"])){
    //进行入库操作
    $result = $db->insert(TABLE_M,$arrayDataValue, true);
    echo $result;
    eixt();
}