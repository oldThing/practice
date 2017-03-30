<?php

/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2017/3/16
 * Time: 11:30
 */
class IndexController extends Controller
{
    public function indexAction(){
        $index = new IndexModel();
        $sql1 = "select * from " . TABLE_A . " order by alert_time desc";    //文章的显示  排序（按置顶的方式（按时间））
        $sql2 = "select * from " . TABLE_C;
        $result1 = $index->inquire($sql1);
        $result2 = $index->inquire($sql2);

        include CUR_VIEW_PATH.'index.html';
    }
}