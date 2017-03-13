<?php
//获得文章的数据
include '../../MyPDO.class.php';
const TABLE_A = 't_artical';
$db = MyPDO::getInstance('localhost', 'root', '', 'practice', 'utf-8');
$sqlStr = "select * from ". TABLE_A;
$result = $db->query($sqlStr);
//var_dump($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script type="text/javascript" src="artical.js"></script>
</head>
<body>
<a href="../index.html">首页</a>
<a href="addArtical.php">添加文章</a>
<table style="border: 1px solid">
    <tr>
        <th>编号</th>
        <th>标题</th>
        <th>内容</th>
        <th>所属栏目</th>
        <th>操作</th>
    </tr>
    <?php foreach ($result as $key=>$value):?>
    <tr>
        <td><?php echo ($key+1);?></td>
        <td><?php echo $value['artical_title'];?></td>
        <td><?php echo $value['artical_comment'];?></td>
        <td><?php echo $value['column_id'];?></td>
        <td>
            <a href="titlered.php/?artical_id=<?php echo $value['artical_id']?>">标题加红</a>
            <a href="stick.php/?artical_id=<?php echo $value['artical_id']?>">置顶</a>
            <a href="#">删除</a>
            <a href="#">修改</a>
        </td>
    </tr>
    <?php endforeach;?>
</table>
</body>
</html>