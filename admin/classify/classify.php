<?php
    include "../../MyPDO.class.php";
    $db = MyPDO::getInstance('localhost','root','','practice','utf-8');
    $result = $db->query("select * from t_classify");
//    var_dump($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<a href="../index.html">首页</a><a href="addClassify.php">添加分类</a>
<table style="border: 1px solid">
    <tr>
        <th>分类ID</th>
        <th>分类名</th>
        <th>操作</th>
    </tr>
    <?php foreach ($result as $key => $item):?>
    <tr>
        <!--进行循环的操作-->
        <td><?php echo ($key+1);?></td>
        <td><?php echo $item['column_name'];?></td>
        <td>
            <a href="./delClassify.php/?column_id=<?php echo $item['column_id'];?>" >删除</a>
            <a href="./updateClassify.php/?column_id=<?php echo $item['column_id'];?>" >修改</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>