<?php

/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2017/3/16
 * Time: 11:30
 */
class IndexController
{
    public function indexAction(){
//        echo "hello world";
        $indexModel = new IndexModel();
//        var_dump($indexModel);
        $result = $indexModel->inquire("select * from t_artical");
        var_dump($result);
    }

}