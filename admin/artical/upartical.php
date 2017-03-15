<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2017/3/15
 * Time: 12:11
 * 文章的修改
 */

include "../../MyPDO.class.php";
const TABLE_A = 't_artical';
const TABLE_C = 't_classify';
$db = MyPDO::getInstance('localhost', 'root', '', 'practice', 'utf-8');
//显示数据
if ($_REQUEST['artical_id'] && $_REQUEST['method'] == 'updateShow') {
    $artical_id = $_REQUEST['artical_id'];
    $sql = "select * from " . TABLE_A . " where artical_id=" . $artical_id;
    $result = $db->query($sql, "Row");

    $sql2 = "select * from " . TABLE_C;
    $classifys = $db->query($sql2);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script type="text/javascript" src="../artical.js"></script>
</head>
<body>
标题:<input name="artical_title" id="artical_title" value="<?php echo $result['artical_title'] ?>"/><br/>
内容:<textarea rows="10" id="artical_comment"><?php echo $result['artical_comment'] ?></textarea> <br/>
所属栏目：
<?php if (isset($classifys)): ?>
    <?php foreach ($classifys as $item): ?>
        <input name="column_id" type="radio"
               value="1" <?php echo $item['column_id'] == $result['column_id'] ? 'checked=checked' : ''; ?>/><?php echo $item['column_name'] ?>
    <?php endforeach; ?>
<?php else: ?>
    目前暂时没有分类
<?php endif; ?>
<br/>
<input id="artical_id" value="<?php echo $artical_id; ?>" hidden/>
<button onclick="upArticalOk()">确定</button>
</body>
</html>