<?php

/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2017/3/16
 * Time: 11:44
 * 基础的模型控制器
 * 1.对数据库的操作
 * 2.增删改查的操作
 */
class Model
{
    protected $db;                      //数据库对象
//    protected $table;                   //表名(加前驱)
    protected $fields = array();        //字段列表

    public function __construct()
    {
        $host = $GLOBALS['config']['host'];
        $user = $GLOBALS['config']['user'];
        $password = $GLOBALS['config']['password'];
        $dbName = $GLOBALS['config']['dbname'];
        $charset = $GLOBALS['config']['charset'];

        $this->db = MyPDO::getInstance($host, $user, $password, $dbName, $charset);
    }

    //===========================进行增删改查的操作=====================================//
    /**
     * 增加操作
     * @param $table                数据表
     * @param $arrayDataValue       要添加的数据
     * @param $debug                是否开启调试
     */
    public function add($table, $arrayDataValue, $debug = false)
    {
        return $this->db->insert($table, $arrayDataValue, $debug);
    }

    /**
     * 删除操作
     * @param $table                表名
     * @param $where                条件
     * @param $debug                是否开启调试
     */
    public function delete($table, $where, $debug = false)
    {
        return $this->db->delete($table, $where, $debug);
    }

    /**
     * 更新操作
     * @param $table                表名
     * @param $arrayDataValue       数据
     * @param $where                条件
     * @param $debug                是否开启调试
     */
    public function update($table, $arrayDataValue, $where, $debug = false)
    {
        return $this->db->update($table, $arrayDataValue, $where, $debug);
    }

    /**
     * 查询操作
     * @param $sqlStr               查询语句
     * @param $queryModel           获得结果的形式
     * @param $debug                是否开启调试
     */
    public function inquire($sqlStr, $queryModel = "All", $debug = false)
    {
        return $this->db->query($sqlStr, $queryModel, $debug);
    }

    /**
     * 获得数量
     * @param $table                表名
     * @param $field                字段
     * @param $where                条件
     * @param $debug                是否开启调试
     * @return mixed
     */
    public function getCount($table, $field, $where="", $debug = false){
        return $this->db->getCount($table, $field, $where, $debug);
    }
}