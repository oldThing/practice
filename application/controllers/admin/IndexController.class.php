<?php

/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2017/3/16
 * Time: 16:37
 */
class IndexController extends Controller
{
    public function indexAction(){
        include CUR_VIEW_PATH . "index.html";
    }

}