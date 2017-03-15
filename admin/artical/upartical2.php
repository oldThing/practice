<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2017/3/15
 * Time: 14:22
 */
include "../../MyPDO.class.php";
const TABLE_A = 't_artical';
const TABLE_C = 't_classify';
$db = MyPDO::getInstance('localhost', 'root', '', 'practice', 'utf-8');
//数据进行修改
if ($_REQUEST['method'] == 'updateOP') {
    $artical_id = $_REQUEST['artical_id'];
    $artical_comment = $_REQUEST['artical_title'];
    $artical_columns = $_REQUEST['artical_comment'];
    $column_id = $_REQUEST['column_id'];
    $where = "artical_id=".$artical_id;
    $arrayDataValue =[
        'artical_title' => $artical_comment,
        'artical_comment' => $artical_columns,
        'column_id'       => $column_id
    ];
    $result = $db->update(TABLE_A,$arrayDataValue,$where);
    if ($result > 0) {
        //添加成功
        $errorCode = [
            "errorNo" => "0",
            "message" => "修改成功"
        ];
    } else {
        //添加失败
        $errorCode = [
            "errorNo" => "1",
            "message" => "修改失败"
        ];
    }
    echo json_encode($errorCode);
//    echo $result;
}