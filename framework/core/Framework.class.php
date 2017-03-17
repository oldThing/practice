<?php

/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2017/3/16
 * Time: 10:52
 */
class Framework
{
    public static function run()
    {
//        echo "run....";
        self::init();
        self::autoload();
        self::router();
    }

    /**
     * 初始化工作（路由）
     */
    public static function init()
    {
        define("DS", DIRECTORY_SEPARATOR);
        define("ROOT", getcwd() . DS);
        define("APP_PATH", ROOT . 'application' . DS);
        define("FRA_PATH", ROOT . 'framework' . DS);
        define("PUB_PATH", ROOT . 'public' . DS);
        define("CONFIG_PATH", APP_PATH . 'config' . DS);
        define("CON_PATH", APP_PATH . 'controllers' . DS);
        define("MODEL_PATH", APP_PATH . 'model' . DS);
        define("VIEW_PATH", APP_PATH . 'views' . DS);
        define("CORE_PATH", FRA_PATH . 'core' . DS);
        define("DB_PATH", FRA_PATH . 'database' . DS);
        define("HELPER_PATH", FRA_PATH . 'helpers' . DS);
        define("LIB_PATH", FRA_PATH . 'database' . DS);
        define("JS_PATH", PUB_PATH . 'js' . DS);

        //=================前后台确定时间===========================//
        define("PLATFORM", isset($_REQUEST['p']) ? $_REQUEST['p'] : 'home');
        define("CONTROLLER", isset($_REQUEST['c']) ? $_REQUEST['c'] : 'Index');
        define("ACTION", isset($_REQUEST['a']) ? $_REQUEST['a'] : 'index');
        define("CUR_CON_PATH", CON_PATH . PLATFORM . DS);
        define("CUR_VIEW_PATH", VIEW_PATH . PLATFORM . DS);

        //===================手动加载=============================//
        include CORE_PATH . "Controller.class.php";
        include CORE_PATH . "Model.class.php";
        include DB_PATH . "MyPDO.class.php";
        include HELPER_PATH . "Page2.class.php";

        //===================超全局变量=============================//
        $GLOBALS['config'] = include CONFIG_PATH . "config.php";

        //===================数据库的名称=============================//
        define("TABLE_C", "t_classify");
        define("TABLE_A", "t_artical");
        define("TABLE_M", "t_message");
    }

    /**
     * 路由
     */
    public static function router()
    {
        $controllerName = CONTROLLER . 'Controller';
        $actionName = ACTION . 'Action';
        $controller = new $controllerName();
        $controller->$actionName();
    }


    /**
     * 加载
     */
    public static function autoload()
    {
        spl_autoload_register(array(__CLASS__, 'load'));
    }

    public static function load($className)
    {
        //加载的是application中的加载
        if (substr($className, -10) == "Controller") {
            require CUR_CON_PATH . "{$className}.class.php";
        } else if (substr($className, -5) == "Model") {
            require MODEL_PATH . "{$className}.class.php";
        } else {
            //加载其他的
        }
    }


}