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
  /**
     * 成功提示
     * @param type $msg 提示信息
     * @param type $jumpurl 跳转url
     * @param type $wait 等待时间
     */
    static function success($msg="",$jumpurl="",$wait=3){
        self::_jump($msg, $jumpurl, $wait, 1);
    }
    /**
     * 错误提示
     * @param type $msg 提示信息
     * @param type $jumpurl 跳转url
     * @param type $wait 等待时间
     */
    static function error($msg="",$jumpurl="",$wait=3){
        self::_jump($msg, $jumpurl, $wait, 0);
    }
    /**
     * 最终跳转处理
     * @param type $msg 提示信息
     * @param type $jumpurl 跳转url
     * @param type $wait 等待时间
     * @param int $type 消息类型 0或1
     */

    static function show($data=" "){
return '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>跳转提示</title>
<style type="text/css">
*{ padding: 0; margin: 0; }
body{ background: #fff; font-family: "微软雅黑"; color: #333; font-size: 16px; }
.system-message{ width:500px;height:100px; margin:auto;border:6px solid #999;text-align:center; position:relative;top:50px;}
.system-message legend{font-size:24px;font-weight:bold;color:#999;margin:auto;width:100px;}
.system-message h1{ font-size: 100px; font-weight: normal; line-height: 120px; margin-bottom: 12px; }
.system-message .jump{ padding-right:10px;height:25px;line-height:25px;font-size:14px;position:absolute;bottom:0px;left:0px;background-color:#e6e6e1 ; display:block;width:490px;text-align:right;}
.system-message .jump a{ color: #333;}
.system-message .success,.system-message .error{ line-height: 1.8em; font-size: 15px }
.system-message .detail{ font-size: 12px; line-height: 20px; margin-top: 12px; display:none}
</style>
</head>
<body>
<fieldset class="system-message">
    <legend><?php echo $title;?></legend>
    <div style="text-align:left;padding-left:10px;height:75px;width:490px;  ">
         
        <?php if($type==1):?>
        <p class="success">恭喜^_^!~<?php echo($msg); ?></p>
        <?php else:?>
        <p class="error">Sorry!~<?php echo($msg); ?></p>
        <?php endif;?>
        <p class="detail"></p>
         
    </div>
    <p class="jump">
        页面自动 <a id="href" href="<?php echo($jumpurl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($wait); ?></b>
    </p>
</fieldset>
<script type="text/javascript">
     
(function(){
var wait = document.getElementById("wait"),href = document.getElementById("href").href;
//totaltime=parseInt(wait.innerHTML);
totaltime=2;
var interval = setInterval(function(){
    var time = --totaltime;
        wait.innerHTML=""+time;
    if(time === 0) {
        location.href = href;
        clearInterval(interval);
    };
}, 1000);
})();
 
</script>
</body>
</html>';
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
        $cc = Yii::$app->createController('site/test');
	//$cc[0]->run('show_message')->renderPartial("show_message",$data);
	$cc[0]->runAction('test');
	//$cc[0]->runAction('show')->render("/site/show");
	//$cc[0]->render("/site/show");
//	self::show("aaaaaaa");
	Yii::info("JUMP");	
    }
}

spl_autoload_register(['Yii', 'autoload'], true, true);
Yii::$classMap = include(__DIR__ . '/classes.php');
Yii::$container = new yii\di\Container;
