<?php
/**
 * Created by PhpStorm.
 * User: Tioncico
 * Date: 2019/4/14 0014
 * Time: 12:07
 */
include "./vendor/autoload.php";
\EasySwoole\EasySwoole\Core::getInstance()->initialize();

go(function (){
    $mysqlConfig = new \EasySwoole\ORM\Db\Config(\EasySwoole\EasySwoole\Config::getInstance()->getConf('MYSQL'));
    $connection = new \EasySwoole\ORM\Db\Connection($mysqlConfig);

    $tableName = 'user_list';
    $tableObjectGeneration =  new \EasySwoole\ORM\Utility\TableObjectGeneration($connection, $tableName);
    $schemaInfo = $tableObjectGeneration->generationTable();

    $init = new \AutomaticGeneration\Init();
    $init->initBaseController();
    $init->initBaseModel();


    $path = '\\User';
    $modelConfig = new \AutomaticGeneration\Config\ModelConfig();
    $modelConfig->setBaseNamespace("App\\Model" . $path);
    $modelConfig->setTable($schemaInfo);
//    $modelConfig->setBaseDirectory(EASYSWOOLE_ROOT . '/' .\AutomaticGeneration\AppLogic::getAppPath() . 'Model');
    $modelConfig->setTablePre("");
    $modelConfig->setExtendClass(\App\Model\BaseModel::class);
    $modelConfig->setKeyword('');//生成该表getAll关键字
    $modelBuilder = new \AutomaticGeneration\ModelBuilder($modelConfig);
    $result = $modelBuilder->generateModel();
    var_dump($result);

//
    $path = '\\Api\\Admin\\User';
    $controllerConfig = new \AutomaticGeneration\Config\ControllerConfig();
    $controllerConfig->setBaseNamespace("App\\HttpController" . $path);
//    $controllerConfig->setBaseDirectory( EASYSWOOLE_ROOT . '/' . $automatic::APP_PATH . '/HttpController/Api/');
    $controllerConfig->setTablePre('');
    $controllerConfig->setTable($schemaInfo);
    $controllerConfig->setExtendClass(\App\HttpController\Base::class);
    $controllerConfig->setModelClass($modelBuilder->getClassName());
    $controllerBuilder = new \AutomaticGeneration\ControllerBuilder($controllerConfig);
    $result = $controllerBuilder->generateController();
    var_dump($result);
//

    \EasySwoole\Component\Timer::getInstance()->clearAll();
});