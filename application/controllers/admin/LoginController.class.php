<?php

/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2017/3/29
 * Time: 15:30
 */
class LoginController extends Controller
{
    public function loginAction(){

        include CUR_VIEW_PATH ."login.html";
    }

    public function doLoginAction(){
        echo "进行表单验证";

    }

}