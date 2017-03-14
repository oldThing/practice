<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2017/3/14
 * Time: 13:58
 * 回复留言操作
 *
 */
include "../../MyPDO.class.php";
const TABLE_M = "t_message";
$db = MyPDO::getInstance('localhost', 'root', '', 'practice', 'utf-8');
$message_id = $_REQUEST['message_id'];
if(isset($_REQUEST['replay'])){
    $replay = $_REQUEST['replay'];
    $messageId = $_REQUEST['message_id'];
    $arrayDataValue = [
        "replay" => $replay
    ];
    $where = "message_id = ". $message_id;
    $result = $db->update(TABLE_M,$arrayDataValue,$where);
    if($result > 0){
        $errorCode = [
            "errorNo" => "0",
            "message" => "回复成功"
        ];
    } else {
        $errorCode = [
            "errorNo" => "1",
            "message" => "回复失败"
        ];
    }
    echo json_encode($errorCode);
    exit();
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="../replay.js" type="text/javascript"></script>
    <title>回复留言</title>
</head>
<body>
留言回复:<textarea id="replayMessage"></textarea>
<input id="message_id" value="<?php echo $message_id;?>" hidden />
<button onclick="replayOK()">确定</button>
</body>
</html>
