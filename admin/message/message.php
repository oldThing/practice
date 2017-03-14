<?php
include "../../MyPDO.class.php";
$db = MyPDO::getInstance('localhost', 'root', '', 'practice', 'utf-8');
const TABLE_M = "t_message";
const TABLE_A = "t_artical";
$sqlStr = "select * from ".TABLE_M;
$sqlStr = "select m.*,a.artical_title from ".TABLE_M." as m left join ".TABLE_A." as a on m.artical_id = a.artical_id";
$result = $db->query($sqlStr);
//var_dump($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<a href="../index.html">首页</a>
<table style="border: solid 1px;">
    <tr>
        <th>序号</th>
        <th>留言时间</th>
        <th>留言内容</th>
        <th>IP地址</th>
        <th>所属文章</th>
        <th>是否回复</th>
        <th>操作</th>
    </tr>
    <?php foreach ($result as $key=>$item):?>
    <tr>
        <td><?php echo ($key+1);?></td>
        <td><?php echo date("Y-m-d H:i:s", $item['message_time'])?></td>
        <td><?php echo $item['message'];?></td>
        <td><?php echo $item['ip'];?></td>
        <td><?php echo $item['artical_title'];?></td>
        <td><?php echo $item['replay'] != "" ? "是":"否";?></td>
        <td>
            <a href="replay.php/?message_id=<?php echo $item['message_id'];?>">回复留言</a>
            <a href="delMessage.php/?message_id=<?php echo $item['message_id'];?>">删除留言</a>
        </td>
    </tr>
    <?php endforeach;?>
</table>
</body>
</html>