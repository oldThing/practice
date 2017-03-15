<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2017/3/15
 * Time: 12:09
 */
include "../../MyPDO.class.php";
const TABLE_A = 't_artical';
if ($_REQUEST['artical_id']) {
    $artical_id = $_REQUEST['artical_id'];
    $db = MyPDO::getInstance('localhost', 'root', '', 'practice', 'utf-8');

    $where = "artical_id=".$artical_id;
    $result = $db->delete(TABLE_A,$where);
//    echo $result;
//    echo $result;
    if($result > 0){
        echo "<script>alert('置顶成功!!'); window.location.href='../artical.php'</script>";
    } else {
        echo "<script>alert('置顶失败!!')</script>";
    }
}