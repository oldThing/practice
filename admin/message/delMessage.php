<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2017/3/14
 * Time: 14:42
 */
include "../../MyPDO.class.php";
$db = MyPDO::getInstance('localhost', 'root', '', 'practice', 'utf-8');
const TABLE_M = "t_message";
//删除操作
$message_id = $_REQUEST['message_id'];
$where = "message_id = ". $message_id;
$result = $db->delete(TABLE_M, $where);
if($result > 0){
    echo "<script> alert('删除成功!'); window.location.href='../message.php'</script>";
} else {
    echo "<script>alert('删除失败!');</script>";
}
