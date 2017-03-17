<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2017/3/13
 * Time: 16:36
 */
include "../MyPDO.class.php";
const TABLE_A = 't_artical';
const TABLE_M = 't_message';

if (isset($_REQUEST['artical_id'])) {
    $artical_id = $_REQUEST['artical_id'];
    $db = MyPDO::getInstance('localhost', 'root', '', 'practice', 'utf-8');
    $sql = "select * from " . TABLE_A . " where artical_id = $artical_id";
    $result = $db->query($sql, 'Row');
    $ip = $_SERVER["REMOTE_ADDR"];

    $sql2 = "select * from " . TABLE_M . " where artical_id = $artical_id";
    $result2 = $db->query($sql2);

//    var_dump($result2);
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="../message.js" type="text/javascript"></script>
    <title>文章显示页面</title>
</head>
<body>
<h2><?php echo $result["artical_title"]; ?></h2>
<label><?php echo $result["artical_comment"]; ?></label>
<input id="artical_id" value="<?php echo $artical_id; ?>" hidden/>
<input id="ip" value="<?php echo $ip; ?>" hidden/>
<br/>
<hr/>
<?php foreach ($result2 as $item): ?>
    留言人内容:<?php echo $item['message']; ?><br/>
    回复留言内容:<?php echo $item['replay']; ?><br/>
    留言时间:<?php echo date("Y-m-d H:i:s", $item['message_time']); ?>
    <hr style="width: 99%"/>
<?php endforeach; ?>

<textarea id="message">
</textarea>
<button onclick="showOK()">确定</button>

</body>

</html>
