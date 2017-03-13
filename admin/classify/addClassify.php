<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2017/3/10
 * Time: 15:10
 */
include "../../MyPDO.class.php";
header("Content-type: text/html; charset=utf-8");
$db = MyPDO::getInstance('localhost','root','','practice','utf-8');
/**
 * 添加操作
 */
if(isset($_REQUEST['column_name']) && !isset($_REQUEST['column_id'])){
    $column_name = $_REQUEST['column_name'];

    $errorCode = [];
    $arrayDataValue = [
        "column_name" => $column_name,
    ];
    $table = "t_classify";
    $result = $db->insert($table,$arrayDataValue);
    if ($result){
        $errorCode = [
            "errorNo" => "0",
            "message" => "添加成功"
        ];
    } else {
        $errorCode = [
            "errorNo" => "1",
            "message" => "添加失败"
        ];
    }
    echo json_encode($errorCode);
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>添加分类</title>
    <script type="text/javascript" src="classify.js" ></script>
</head>
<body>
分类名:<input type="text" id="column_name" />
    <button onclick="addClassifyOK()">确定</button>
<!--        <button onclick="addClassifyOK()">确定</button>-->
</body>
</html>





