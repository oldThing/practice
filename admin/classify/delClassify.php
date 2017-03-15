<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2017/3/10
 * Time: 17:01
 */
include "../../MyPDO.class.php";
$db = MyPDO::getInstance('localhost', 'root', '', 'practice', 'utf-8');
$column_id = $_REQUEST['column_id'];
$table = "t_classify";
$where = "column_id = " . $column_id;
$url = "./classify.php";
$result = $db->delete($table, $where);
//页面的跳转
if ($result) {
    echo "<script>alert('删除成功!'); window.location.href='../classify.php';</script>";
} else {
    echo "<script>alert('删除失败!')</script>";
}
