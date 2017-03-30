<?php

/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2017/3/16
 * Time: 14:20
 * 对分类类进行封装
 */
class ClassifyController extends Controller
{
    /**
     * 显示数据
     */
    public function showAction(){

        $classify = new ClassifyModel();
        $total = $classify->getCount(TABLE_C, 'column_id');
        $per = 2;
        $page = new Page2($total, $per);
        $sql = "select * from ". TABLE_C . $page->limit;
        $result = $classify->inquire($sql);
        $pageStr = $page->fpage();

        include CUR_VIEW_PATH."classify.html";
    }

    /**
     * 添加操作
     */
    public function addClassifyAction(){
        $classify = new ClassifyModel();
        if (isset($_REQUEST['column_name']) && !isset($_REQUEST['column_id'])) {
            $column_name = $_REQUEST['column_name'];
            $errorCode = [];
            $arrayDataValue = [
                "column_name" => $column_name,
            ];
            $result = $classify->add(TABLE_C, $arrayDataValue);
            if ($result) {
                $errorCode = $this->jsonObject(0,"添加成功");
            } else {
                $errorCode = $this->jsonObject(1,"添加失败");
            }
            echo $errorCode;
            exit();
        }
        include CUR_VIEW_PATH."addClassify.html";
    }

    /**
     * 删除操作
     */
    public function delClassifyAction(){

    }

    /**
     * 更改操作
     */
    public function upClassifyAction(){
        $classify = new ClassifyModel();
        if (isset($_REQUEST['column_id'])) {
            $column_id = $_REQUEST['column_id'];
            $quertStr = "select * from ".TABLE_C. " where column_id = $column_id";
            $result = $classify->inquire($quertStr, "Row");
            $column_name = $result['column_name'];
            include CUR_VIEW_PATH."upClassify.html";
        }

        if(isset($_REQUEST['method'])){
            $arrayDataValue = [
                "column_name" => $_REQUEST["column_name"]
            ];
            $where = "column_id=" . $_REQUEST['column_id'];

            $result = $classify->update(TABLE_C, $arrayDataValue, $where, true);
            if ($result) {
                $errorCode = $this->jsonObject(0,"修改成功");
            } else {

                $errorCode = $this->jsonObject(1,"修改失败");
            }
            echo $errorCode;
            exit();
        }
    }
}