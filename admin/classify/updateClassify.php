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
 * 修改操作的数据的显示
 */
if(isset($_REQUEST['column_id'])){
    $column_id = $_REQUEST['column_id'];
    $quertStr = "select * from t_classify where column_id = $column_id";
    $result = $db->query($quertStr,"Row");
    $column_name = $result['column_name'];
//    $db->update('t_classify', $arrayDataValue, $wehere , true);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>更改分类</title>
    <script type="text/javascript" src="classify.js" ></script>
</head>
<body>
分类名:<input type="text" id="column_name" value="<?php if(isset($column_name)) echo $column_name; else echo "";?>" />
<button onclick="updateClassifyOK()">确定</button>
</body>
<script>
    function updateClassifyOK(){
        alert(123);
    }

</script>
</html>







