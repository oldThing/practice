<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2017/3/15
 * Time: 12:04
 * 取消置顶
 */
include "../../MyPDO.class.php";
const TABLE_A = 't_artical';
if ($_REQUEST['artical_id']) {
    $artical_id = $_REQUEST['artical_id'];
    $db = MyPDO::getInstance('localhost', 'root', '', 'practice', 'utf-8');
    $arrayDataValue = [
        "is_top" => 0,
    ];
    $where = "artical_id=".$artical_id;
    $result = $db->update(TABLE_A, $arrayDataValue, $where);
    if($result > 0){
        echo "<script>alert('取消成功!!'); window.location.href='../artical.php'</script>";
    } else {
        echo "<script>alert('取消失败!!')</script>";
    }
}