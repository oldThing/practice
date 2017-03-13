<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2017/3/13
 * Time: 16:36
 */
include "../MyPDO.class.php";
const TABLE_A = 't_artical';
if(isset($_REQUEST['artical_id'])){
    $artical_id =  $_REQUEST['artical_id'];
    $db = MyPDO::getInstance('localhost','root','','practice','utf-8');
    $sql = "select * from ". TABLE_A . " where artical_id = $artical_id";
    $result = $db->query($sql,'Row');
//    var_dump($result);
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<!--    <script type="text/javascript" src="message.js" > </script>-->
    <title>文章显示页面</title>
</head>
<body>
<h2><?php echo $result["artical_title"];?></h2>
<label><?php echo $result["artical_comment"];?></label>
<br/>
<hr/>
留言人内容:<br/>
回复留言内容:<br/>
留言时间:
<hr/>

<textarea id="message">

</textarea>
<button onclick="ShowOK()">确定</button>

</body>
<script>
    function ShowOK() {
        var message = document.getElementById("message").value;
//        alert(message);
        var xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function () {
            if(xhr.readyState == 4){
                alert(xhr.responseText);
            }
        }

        var postData = {
            "message": message
        }

        var postData = (function(obj){ // 转成post需要的字符串.
            var str = "";
            for(var prop in obj){
                str += prop + "=" + obj[prop] + "&"
            }
            return str;
        })(postData);

        xhr.open("post",'message.php');
        xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        //3.发送请求
        xhr.send(postData);
    }

</script>
</html>
