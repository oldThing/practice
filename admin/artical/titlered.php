<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2017/3/13
 * Time: 14:35
 * 标题加红
 */
include "../../MyPDO.class.php";
const TABLE_A = 't_artical';
if ($_REQUEST['artical_id']) {
    $artical_id = $_REQUEST['artical_id'];
    $db = MyPDO::getInstance('localhost', 'root', '', 'practice', 'utf-8');
    $arrayDataValue = [
        "is_red" => 1,
    ];
    $where = "artical_id = $artical_id";

    $result = $db->update(TABLE_A, $arrayDataValue, $where);
    if ($result > 0) {
        //标题加红成功
//        $errorCode = [
//            "errorNo" => "0",
//            "message" => "标题加红成功"
//        ];

        echo "<script>alert('操作成功!!'); window.location.href='../artical.php'</script>";
    } else {
//        $errorCode = [
//            "errorNo" => "1",
//            "message" => "标题加红失败"
//        ];
        echo "<script>alert('操作失败!!')</script>";
    }
    echo json_encode($errorCode);
//    echo $artical_id;
}

