<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2017/3/10
 * Time: 11:24
 */
include "../MyPDO.class.php";
header("Content-type: text/html; charset=utf-8");
$username = $_REQUEST['username'];
$password = $_REQUEST['password'];
$errorCode = [];

$db = MyPDO::getInstance('localhost','root','','practice','utf-8');

$result = $db->query("select * from t_user where username = '$username'" , 'Row');

if($result){
    if($result['password'] == $password){
        $errorCode = [
            "errorNo"   =>   "0",
            "message"   =>   "登录成功"
        ];

    } else {
        $errorCode = [
            "errorNo"   =>   "1",
            "message"   =>   "密码错误"
        ];
    }
} else {
    $errorCode = [
        "errorNo"   =>   "1",
        "message"   =>   "用户名错误"
    ];
}
echo json_encode($errorCode);


