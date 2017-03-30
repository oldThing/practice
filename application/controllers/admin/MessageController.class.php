<?php

/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2017/3/30
 * Time: 12:26
 */
class MessageController extends Controller
{
    public function showAction(){
        $message = new MessageModel();
        $total = $message->getCount(TABLE_M, "message_id");
        $per = 5;
        $page = new Page2($total, $per);
        $sqlStr = "select m.*,a.artical_title from " . TABLE_M . " as m left join " . TABLE_A . " as a on m.artical_id = a.artical_id " . $page->limit;
        $result = $message->inquire($sqlStr);
        $pageStr = $page->fpage();
//        var_dump($result);

        include CUR_VIEW_PATH . 'message.html';
    }

    public function delMessageAction(){
        //删除操作
        $message = new MessageModel();
        $message_id = $_REQUEST['message_id'];
        $where = "message_id = " . $message_id;
        $result = $message->delete(TABLE_M, $where);
        if ($result > 0) {
            echo "<script> alert('删除成功!'); window.location.href='index.php?p=admin&c=Message&a=show'</script>";
        } else {
            echo "<script>alert('删除失败!');</script>";
        }
    }

    public function replayAction(){
        $message = new MessageModel();
        $message_id = $_REQUEST['message_id'];
        if (isset($_REQUEST['replay'])) {
            $replay = $_REQUEST['replay'];
            $arrayDataValue = [
                "replay" => $replay
            ];
            $where = "message_id = " . $message_id;
            $result = $message->update(TABLE_M, $arrayDataValue, $where);
            if ($result > 0) {
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

        include CUR_VIEW_PATH.'replay.html';
    }

}