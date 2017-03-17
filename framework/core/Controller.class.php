<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2017/3/16
 * Time: 11:37
 * 基础的控制器
 * 1.跳转
 * 2.数据的处理 json
 */
class Controller
{
    /**
     * 页面的跳转
     * @param $url
     * @param $message
     * @param $time
     */
    public function jump($url, $message, $wait = 3)
    {
        if($wait == 0){
            //直接跳转
        } else {
            //给出提示信息
        }
    }

    /**
     * 将信息数据封装成json对象进行封装
     * @param $errorNo          错误代号
     * @param $message          错误信息
     * @return string           返回字符串
     */
    public function jsonObject($errorNo, $message){
        $messageInfo = [
            'errorNo' => $errorNo,
            'message' => $message
        ];
        return json_encode($messageInfo);
    }

}