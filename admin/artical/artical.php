<?php
//获得文章的数据
include '../../MyPDO.class.php';
//include "../../Page.class.php";
include "../../Page2.class.php";
const TABLE_A = 't_artical';
$db = MyPDO::getInstance('localhost', 'root', '', 'practice', 'utf-8');

$total = $db->getCount(TABLE_A, 'artical_id');
$per = 7;
//$page = new Page($total,$per);
$page = new Page2($total, $per);
$sqlStr = "select * from " . TABLE_A . $page->limit;
$result = $db->query($sqlStr);
$pageStr = $page->fpage();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script type="text/javascript" src="artical.js"></script>
</head>
<body id="result">
<a href="../index.html">首页</a>
<a href="addArtical.php">添加文章</a>
<table style="border: 1px solid">
    <tr>
        <th>编号</th>
        <th>标题</th>
        <th>内容</th>
        <th>所属栏目</th>
        <th>是否加红</th>
        <th>是否置顶</th>
        <th>操作</th>
    </tr>
    <?php foreach ($result as $key => $value): ?>
        <tr style="text-align: center;">
            <td><?php echo($key + 1); ?></td>
            <td><?php echo $value['artical_title']; ?></td>
            <td><?php echo $value['artical_comment']; ?></td>
            <td><?php echo $value['column_id']; ?></td>
            <td><a href="<?php echo $value['is_red'] == 0? 'titlered.php':'canclered.php';?>/?artical_id=<?php echo $value['artical_id'] ?>"><?php echo $value['is_red'] == 1 ? "取消加红":"未加红";?></a></td>
            <td><a href="<?php echo $value['is_top'] == 0? 'stick.php':'canclestick.php'?>/?artical_id=<?php echo $value['artical_id'] ?>"><?php echo $value['is_top'] == 1 ? "取消置顶":"未置顶";?></a></td>
            <td>
                <a href="delartical.php/?artical_id=<?php echo $value['artical_id']?>">删除</a>
                <a href="upartical.php/?artical_id=<?php echo $value['artical_id']?>&method=updateShow">修改</a>
            </td>
        </tr>
    <?php endforeach; ?>
    <tr style="text-align: center;">
        <td colspan="7"><?php echo $pageStr ?></td>
    </tr>
</table>
</body>
<script type="text/javascript">
    //函数封装，实现ajax获取分页信息
    function showpage(url) {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4) {
                document.getElementById('result').innerHTML = xhr.responseText;
            }
        }
        xhr.open('get', url);
        xhr.send(null);
    }
    window.onload = function () {
        showpage('./artical.php');
    }
</script>
</html>