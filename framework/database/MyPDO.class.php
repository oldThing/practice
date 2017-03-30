<?php

/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2017/3/9
 * Time: 16:07
 */
header("Content-type: text/html; charset=utf-8");

class MyPDO
{
    private static $_instace;
    public $dsn;
    private static $_db;

    private function __construct($host, $user, $pwd, $dbname, $dbCharset)
    {
        try {
            $this->dsn = "mysql:host=" . $host . ";dbname=" . $dbname;
            self::$_db = new PDO($this->dsn, $user, $pwd);
            self::$_db->exec("SET character_set_connection='.$dbCharset.', character_set_results='.$dbCharset.', character_set_client=binary");  //字符集
        } catch (PDOException $e) {
            echo $e;
            echo "数据库连接失败";
        }
    }

    //禁止克隆
    private function __clone()
    {
    }

    /**
     * 初始化
     * @return MyPDO  返回pdo对象
     */
    public function getInstance($host, $user, $pwd, $dbname, $dbCharset)
    {
        if (!isset(self::$_instace)) {
            self::$_instace = new self($host, $user, $pwd, $dbname, $dbCharset);
        }
        return self::$_instace;
    }

    /**
     * 查询操作
     * @param $sqlStr                       查询语句
     * @param string $queryModel 结果的类型
     * @param bool $debug 显示debug调试
     * @return array|mixed|null             返回结果集
     */
    public function query($sqlStr, $queryModel = "All", $debug = false)
    {
        if ($debug) $this->debug($sqlStr);
        $recodeSet = self::$_db->query($sqlStr);    //查询返回的结果是一个PDOStatement对象,预处理语句，一个相关的结果集
        $this->getPDOError();
        if ($recodeSet) {
            $recodeSet->setFetchMode(PDO::FETCH_ASSOC);           //设置结果集的模式
            if ($queryModel == "All") {
                $result = $recodeSet->fetchAll();                 //全部的结果集
            } else if ($queryModel == "Row") {
                $result = $recodeSet->fetch();                    //一条结果集
            }
        } else {
            $result = null;
        }
        return $result;
    }

    /**
     * 添加操作
     * @param $table                 表
     * @param $arrayDataValue        键值对
     * @param bool $debug 调试模式
     * @return int                   受影响的行数
     */
    public function insert($table, $arrayDataValue, $debug = false)
    {
        $this->checkField($table, $arrayDataValue);
        $sqlStr = "INSERT INTO `$table` (`" . implode("`,`", array_keys($arrayDataValue)) . "`) VALUES ('" . implode("','", $arrayDataValue) . "')";
        if ($debug) $this->debug($sqlStr);
        $result = self::$_db->exec($sqlStr);
        $this->getPDOError();
        return $result;
    }

    /**
     * 改操作(注：没有条件时，有问题，待解决)
     * @param $table                表
     * @param $arrayDataValue       键值对
     * @param $where                判断条件
     * @param $debug                打开调试模式
     */
    public function update($table, $arrayDataValue, $where = '', $debug = false)
    {
        $this->checkField($table, $arrayDataValue);
        if ($where) {
            $strSql = "";
            foreach ($arrayDataValue as $key => $value) {
                $strSql .= ", `$key`='$value'";
            }
            $strSql = substr($strSql, 1);
            $strSql = "UPDATE $table SET $strSql WHERE $where";
        } else {
//            $strSql = "REPLACE INTO $table (".implode("','", array_keys($arrayDataValue)).") VALUES (".implode("','",$arrayDataValue).") ";
            $strSql = "REPLACE INTO `$table` (`" . implode('`,`', array_keys($arrayDataValue)) . "`) VALUES (" . implode("','", $arrayDataValue) . ")";
        }

        if ($debug) $this->debug($strSql);
        $result = self::$_db->exec($strSql);
        $this->getPDOError();
        return $result;
    }

    /**
     * 删除操作
     * @param $table              表
     * @param string $where 删除条件
     * @param bool $debug 是否打开调试
     * @return int                受影响的行数
     */
    public function delete($table, $where = '', $debug = false)
    {
        if ($where == '') {
            $this->outputError("WHERE IS NULL");
        } else {
            $strSql = "DELETE FROM `$table` WHERE $where";
            if ($debug) $this->debug($strSql);
            $result = self::$_db->exec($strSql);
            $this->getPDOError();
            return $result;
        }
    }

    /**
     * 执行sql语句的操作
     * @param $sqlStr           SQL语句
     * @param bool $debug 打开调试
     * @return int              受影响的行数
     */
    public function execSql($sqlStr, $debug = false)
    {
        if ($debug) $this->debug($sqlStr);
        $result = self::$_db->exec($sqlStr);
        $this->getPDOError();
        return $result;
    }

    /**
     * 判断所给的字段是否存在于表中字段
     * @param $table        表
     * @param $fieldArray   字段数组
     */
    public function checkField($table, $fieldArray)
    {
        $fields = $this->getFields($table);
        foreach ($fieldArray as $key => $value) {
            if (!in_array($key, $fields)) {
                $this->outputError("UnKnown column $key in field list.");
            }
        }
    }

    /**
     * 返回表中所有的字段
     * @param $table    表
     * @return array
     */
    public function getFields($table)
    {
        $fields = array();
        $recordSet = self::$_db->query("SHOW COLUMNS FROM $table");
        $recordSet->setFetchMode(PDO::FETCH_ASSOC);
        $result = $recordSet->fetchAll();
        foreach ($result as $row) {
            $fields[] = $row['Field'];
        }

        return $fields;
    }

    public function getCount($table, $filed, $where = "", $debug = false)
    {
        $sql = "select count($filed) as num from " . $table;
        if ($where != "") $sql .= "where $where";
        if ($debug) $this->debug($sql);
        $arrResult = $this->query($sql,'Row');
        return $arrResult['num'];
    }

    /**
     * getPDOError 捕获PDO错误信息
     */
    private function getPDOError()
    {
        if (self::$_db->errorCode() != '00000') {
            $arrayError = self::$_db->errorInfo();
            $this->outputError($arrayError[2]);
        }
    }

    /**
     * 输出错误信息
     * @param $strErrMsg
     * @throws Exception
     */
    private function outputError($strErrMsg)
    {
        throw new Exception('MySQL Error: ' . $strErrMsg);
    }

    /**
     * 打开调试信息
     * @param $debugInfo
     */
    public function debug($debugInfo)
    {
        var_dump($debugInfo);
        exit();
    }

}