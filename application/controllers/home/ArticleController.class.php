<?php

/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2017/3/30
 * Time: 13:48
 */
class ArticleController extends Controller
{
    public function showAction(){
        if (isset($_REQUEST['artical_id'])) {
            $artical_id = $_REQUEST['artical_id'];
            $article = new ArticalModel();
            $sql = "select * from " . TABLE_A . " where artical_id = $artical_id";
            $result = $article->inquire($sql, 'Row');
            $ip = $_SERVER["REMOTE_ADDR"];

            $sql2 = "select * from " . TABLE_M . " where artical_id = $artical_id";
            $result2 = $article->inquire($sql2);

            include CUR_VIEW_PATH . 'show.html';
        }
    }

    public function replayAction(){
        $message = new MessageModel();
        if (isset($_REQUEST["message"])) {
            //进行入库操作
            $ip = $_REQUEST['ip'];
            $time = strtotime(date('Ymd')) + 86400;

            $sql = "select * from ".TABLE_M. " where ip = '$ip' and message_time > " .time() ;
//            var_dump($message->inquire($sql));
            $data = $message->inquire($sql);
            //这里要进行判断，如果这个IP地址今天留言了三次，就提示说，今日留言已上限
//            $length = count($data);
            if(count($data) < 3){
                $arrayDataValue = [
                    "message" => $_REQUEST["message"],
                    "message_time" => $time,
                    "ip" => $_REQUEST["ip"],
                    "artical_id" => $_REQUEST["artical_id"]
                ];
                $result = $message->add(TABLE_M, $arrayDataValue);

                if ($result > 0) {
                    $errorCode = [
                        "errorNo" => "0",
                        "message" => "留言成功"
                    ];
                } else {
                    $errorCode = [
                        "errorNo" => "1",
                        "message" => "留言失败"
                    ];
                }
                echo json_encode($errorCode);
                exit();
            } else {
                echo $this->jsonObject(2,"今日留言已经上限");
            }

        }
    }
}