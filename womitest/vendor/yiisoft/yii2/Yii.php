<?php
/**
 * Yii bootstrap file.
 *
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

require(__DIR__ . '/BaseYii.php');
use yii\web\Controller;
/**
 * Yii is a helper class serving common framework functionalities.
 *
 * It extends from [[\yii\BaseYii]] which provides the actual implementation.
 * By writing your own Yii class, you can customize some functionalities of [[\yii\BaseYii]].
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class Yii extends \yii\BaseYii
{

    static function wmsucc($msg="",$jumpurl="",$wait=3){
        self::_jump($msg, $jumpurl, $wait, 1);
    }

    static function wmerr($msg="",$jumpurl="",$wait=3){
        self::_jump($msg, $jumpurl, $wait, 0);
    }

    static private function _jump($msg="",$jumpurl="",$wait=3,$type=0){
        $data = array(
            'msg' => $msg,
            'jumpurl' => $jumpurl,
            'wait' => $wait,
            'type' => $type
        );
        $data['title'] = ($type==1) ? "提示信息" : "错误信息";
        if(empty($jumpurl)){
            if($type==1){
                $data['jumpurl']=isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:"javascript:window.close();";
            }else{
                $data['jumpurl'] = "javascript:history.back(-1);";
            }
        }
	Yii::$app->response->redirect(['site/mesg','data'=>$data],200);//statusCode主要防止某些ajax误判为失败报错
        ///$cc = Yii::$app->createController('site/show');
	//$cc[0]->run('show_message')->renderPartial("show_message",$data);
	///$cc[0]->runAction('show');
	//$cc[0]->runAction('show')->render("/site/show");
	//$cc[0]->render("/site/show");
	//self::show("aaaaaaa");
    }
	
}

spl_autoload_register(['Yii', 'autoload'], true, true);
Yii::$classMap = include(__DIR__ . '/classes.php');
Yii::$container = new yii\di\Container;
