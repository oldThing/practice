<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2017/3/9
 * Time: 14:36
 */
//include "MyDB.class.php";
//$db = MyDB::getInstance('localhost','root','','one','utf-8');
//$dsn = 'mysql:host=localhost;port=3306;dbname=one';
//$username = 'root';
//$password = '';
//$driver_options = array(
//    PDO::MYSQL_ATTR_INIT_COMMAND	=> 'SET NAMES UTF8',
//);
//$pdo = new PDO($dsn, $username, $password, $driver_options);
//
//$sql = "show databases";
//$result = $pdo->query($sql);
//$list = $result->fetchAll(PDO::FETCH_NUM);
//echo '<pre>';
//var_dump($list);
header("Content-type: text/html; charset=utf-8");
include "./MyPDO.class.php";
$db = MyPDO::getInstance('localhost','root','','one','utf-8');
//var_dump($db->query("select * from test"));
$sqlStr = "select * from test";
$result = $db->query($sqlStr , "Row" );

//增加
//$arrayDataValue = ["id"=>"6","name"=>"小东"];
//$result2 = $db->insert("test", $arrayDataValue);

//更改
//$arrayDataValue = ["name"=>"xiao"];
//$result3 = $db->update("test", $arrayDataValue,'',true);

//删除
$result4 = $db->delete("test", "id = 6");

var_dump($result4);