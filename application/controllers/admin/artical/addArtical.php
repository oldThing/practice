<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2017/3/10
 * Time: 14:15
 */
include "../../MyPDO.class.php";

$db = MyPDO::getInstance('localhost', 'root', '', 'practice', 'utf-8');
const TABLE_C = "t_classify";
const TABLE_A = "t_artical";

if (isset($_REQUEST["artical_title"])) {
    $title = $_REQUEST["artical_title"];
    $artical_comment = $_REQUEST["artical_comment"];
    $column_id = $_REQUEST["column_id"];
    if (!is_numeric($column_id)) {
        $column_id = 0;
    }
    //进行入库
    $arrayDataValue = [
        'artical_title' => $title,
        'artical_comment' => $artical_comment,
        'column_id' => $column_id
    ];
    $result = $db->insert(TABLE_A, $arrayDataValue);
    if ($result > 0) {
        //添加成功
        $errorCode = [
            "errorNo" => "0",
            "message" => "添加成功"
        ];
    } else {
        //添加失败
        $errorCode = [
            "errorNo" => "1",
            "message" => "添加失败"
        ];
    }
    echo json_encode($errorCode);
    exit();
}

//获得栏目信息
$sqlStr = "select * from " . TABLE_C;
$classifys = $db->query($sqlStr);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script type="text/javascript" src="../../../../public/js/artical.js"></script>
</head>
<body>
标题:<input name="artical_title" id="artical_title"/><br/>
内容:<textarea rows="10" id="artical_comment"></textarea> <br/>
所属栏目：
<?php if (isset($classifys)): ?>
    <?php foreach ($classifys as $item): ?>
        <input name="column_id" type="radio" value="<?php echo $item['column_id'];?>"/><?php echo $item['column_name'] ?>
    <?php endforeach; ?>
<?php else: ?>
    目前暂时没有分类
<?php endif; ?>
<br/>
<button onclick="articalOk()">确定</button>
</body>
</html>
