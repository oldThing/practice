<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2017/3/13
 * Time: 15:49
 */
include "../MyPDO.class.php";
$db = MyPDO::getInstance('localhost', 'root', '', 'practice', 'utf-8');
const TABLE_C = 't_classify';
const TABLE_A = 't_artical';

$sql1 = "select * from " . TABLE_A . " order by alert_time desc";    //文章的显示  排序（按置顶的方式（按时间））
$sql2 = "select * from " . TABLE_C;
$result1 = $db->query($sql1);
$result2 = $db->query($sql2);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>文章首页</title>
</head>
<body>

<?php foreach ($result2 as $one): ?>
    <h2><?php echo $one['column_name'] ?></h2>
    <hr />
    <?php foreach ($result1 as $item): ?>
        <?php if ($one['column_id'] == $item['column_id']): ?>
            <h3 >
                <a style="<?php echo $item['is_red'] == 1?"color:red;":"";?>" href="show.php?artical_id=<?php echo $item['artical_id']; ?>"><?php echo $item['artical_title'] ?></a>
            </h3>
        <?php endif; ?>
    <?php endforeach; ?>
    <hr />
<?php endforeach; ?>

</body>
</html>
