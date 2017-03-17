<?php
include "../../MyPDO.class.php";
include "../../Page2.class.php";
const TABLE_C = 't_classify';
$db = MyPDO::getInstance('localhost', 'root', '', 'practice', 'utf-8');

//$result = $db->query($sql);

$total = $db->getCount(TABLE_C, 'column_id');
$per = 2;
$page = new Page2($total, $per);
$sql = "select * from " . TABLE_C . $page->limit;
$result = $db->query($sql);

$pageStr = $page->fpage();

//    var_dump($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body id="result2">
<a href="../../../views/admin/index.html">首页</a><a href="addClassify.php">添加分类</a>
<table style="border: 1px solid">
    <tr>
        <th>分类ID</th>
        <th>分类名</th>
        <th>操作</th>
    </tr>
    <?php foreach ($result as $key => $item): ?>
        <tr>
            <!--进行循环的操作-->
            <td><?php echo($key + 1); ?></td>
            <td><?php echo $item['column_name']; ?></td>
            <td>
                <a href="delClassify.php?column_id=<?php echo $item['column_id']; ?>">删除</a>
                <a href="updateClassify.php?column_id=<?php echo $item['column_id']; ?>">修改</a>
            </td>
        </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="3"><?php echo $pageStr; ?></td>
    </tr>
</table>
</body>
<script>
    function showpage(url) {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4) {
                document.getElementById('result2').innerHTML = xhr.responseText;
            }
        }
        xhr.open('get', url);
        xhr.send(null);
    }
</script>
</html>