<?php

/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2017/3/29
 * Time: 11:56
 */
class ArticalController extends Controller
{
    /**
     * 显示数据
     */
    public function showAction()
    {
        $article = new ArticalModel();
        $total = $article->getCount(TABLE_A, 'artical_id');
        $per = 7;

        $page = new Page2($total, $per);
        $sqlStr = "select * from " . TABLE_A . $page->limit;
        $result = $article->inquire($sqlStr);
        $pageStr = $page->fpage();

        include CUR_VIEW_PATH . "article.html";
    }

    /**
     * 增加数据
     */
    public function addArticleAction()
    {
        $article = new ArticalModel();
        $classify = new ClassifyModel();
        if (isset($_REQUEST["artical_title"])) {
            $title = $_REQUEST["artical_title"];
            $artical_comment = $_REQUEST["artical_comment"];
            $column_id = $_REQUEST["column_id"];
            if (!is_numeric($column_id)) {
                $column_id = 0;
            }
            //进行入库
            $arrayDataValue = [
                'artical_title' => $title,
                'artical_comment' => $artical_comment,
                'column_id' => $column_id
            ];
            $result = $article->add(TABLE_A, $arrayDataValue);
            if ($result > 0) {
                //添加成功
                $errorCode = [
                    "errorNo" => "0",
                    "message" => "添加成功"
                ];
            } else {
                //添加失败
                $errorCode = [
                    "errorNo" => "1",
                    "message" => "添加失败"
                ];
            }
            echo json_encode($errorCode);
            exit();
        }
        //获得栏目信息
        $sqlStr = "select * from " . TABLE_C;
        $classifys = $classify->inquire($sqlStr);
        include CUR_VIEW_PATH . 'addArticle.html';
    }

    /**
     * 加红或者取消加红
     */
    public function redAction()
    {
        $article = new ArticalModel();
        $artical_id = $_REQUEST['artical_id'];
        $is_red = $_REQUEST['is_red'];
        $where = "artical_id = $artical_id";
        if ($is_red) {      //取消加红
            $arrayDataValue = [
                "is_red" => 0,
            ];
            $result = $article->update(TABLE_A, $arrayDataValue, $where);
            if ($result > 0) {
                echo "<script>alert('取消成功!!'); window.location.href='index.php?p=admin&c=Artical&a=show'</script>";
            } else {
                echo "<script>alert('取消失败!!')</script>";
            }
        } else {            //加红
            $arrayDataValue = [
                "is_red" => 1,
            ];
            $result = $article->update(TABLE_A, $arrayDataValue, $where);
            if ($result > 0) {
                echo "<script>alert('加红成功!!'); window.location.href='index.php?p=admin&c=Artical&a=show'</script>";
            } else {
                echo "<script>alert('取消失败!!')</script>";
            }
        }
    }

    /**
     * 置顶
     */
    public function topAction()
    {
        $article = new ArticalModel();
        $artical_id = $_REQUEST['artical_id'];
        $is_top = $_REQUEST['is_top'];
        $where = "artical_id = $artical_id";
        if ($is_top) {      //取消置顶
            $arrayDataValue = [
                "is_top" => 0,
            ];
            $result = $article->update(TABLE_A, $arrayDataValue, $where);
            if ($result > 0) {
                echo "<script>alert('取消成功!!'); window.location.href='index.php?p=admin&c=Artical&a=show'</script>";
            } else {
                echo "<script>alert('置顶失败!!')</script>";
            }
        } else {            //置顶
            $arrayDataValue = [
                "is_top" => 1,
            ];
            $result = $article->update(TABLE_A, $arrayDataValue, $where);
            if ($result > 0) {
                echo "<script>alert('置顶成功!!'); window.location.href='index.php?p=admin&c=Artical&a=show'</script>";
            } else {
                echo "<script>alert('置顶失败!!')</script>";
            }
        }
    }

    /**
     * 删除文章
     */
    public function delArticleAction()
    {
        if ($_REQUEST['artical_id']) {
            $artical_id = $_REQUEST['artical_id'];
            $article = new ArticalModel();
            $where = "artical_id=" . $artical_id;
            $result = $article->delete(TABLE_A, $where);

            if ($result > 0) {
                echo "<script>alert('删除成功!!'); window.location.href='index.php?p=admin&c=Artical&a=show'</script>";
            } else {
                echo "<script>alert('删除失败!!')</script>";
            }
        }
    }

    /**
     * 修改文章
     */
    public function upArticleAction()
    {
        $article = new ArticalModel();
        //显示数据
        if ($_REQUEST['artical_id'] && $_REQUEST['method'] == 'updateShow') {
            $artical_id = $_REQUEST['artical_id'];
            $sql = "select * from " . TABLE_A . " where artical_id=" . $artical_id;
            $result = $article->inquire($sql, "Row");

            $sql2 = "select * from " . TABLE_C;
            $classifys = $article->inquire($sql2);
            include CUR_VIEW_PATH . "upArticle.html";
        }

        if ($_REQUEST['method'] == 'updateOP') {
            $artical_id = $_REQUEST['artical_id'];
            $artical_comment = $_REQUEST['artical_title'];
            $artical_columns = $_REQUEST['artical_comment'];
            $column_id = $_REQUEST['column_id'];
            $where = "artical_id=" . $artical_id;
            $arrayDataValue = [
                'artical_title' => $artical_comment,
                'artical_comment' => $artical_columns,
                'column_id' => $column_id
            ];
            $result = $article->update(TABLE_A, $arrayDataValue, $where);
            if ($result > 0) {
                //添加成功
                $errorCode = [
                    "errorNo" => "0",
                    "message" => "修改成功"
                ];
            } else {
                //添加失败
                $errorCode = [
                    "errorNo" => "1",
                    "message" => "修改失败"
                ];
            }
            echo json_encode($errorCode);
            exit;
        }


    }
}