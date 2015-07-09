<?php
use yii\helpers\VarDumper;
use yii\helpers\Html;
use components\LuLu;
use common\includes\DataSource;
use components\helpers\TTimeHelper;
use components\widgets\LoopData;
use data\AttachmentAsset;
use common\includes\UrlUtility;
use common\includes\CommonUtility;
use yii\bootstrap\ActiveForm;
?>
<style type="text/css">
.fl{float:left}
.clc{clear:both}
.hd{width:70%;margin-bottom:20px;}
.fl{float:left}
.clc{clear:both}
.hd{width:70%;margin-bottom:20px;}
</style>


 <?php $form = ActiveForm::begin(['id' => 'detailinfo',
'layout' => 'horizontal',
'fieldConfig' => [
    'template' => "{label}\n{beginWrapper}\n{input}\n{endWrapper}",
    'horizontalCssClasses' => [
        'label' => 'col-sm-4',
        'offset' => 'col-sm-offset-2',
        'wrapper' => 'col-sm-8',
        'error' => '',
        'hint' => '',
    ],
     ],
'options' => ['enctype' => 'multipart/form-data']]);

$bixu=['idcard_front','idcard_back','idcard_self','zhizhao','zhizhao_copy','hetong','shuidian','liushui','zhengxin'];
$jiafen=['xingshi','fangchan','zhicheng'];
$ts=['idcard_front'=>'身份证正面','idcard_back'=>'身份证反面','idcard_self'=>'本人持证照片','zhizhao'=>'营业执照','zhizhao_copy'=>'营业执照副本','hetong'=>'合同','shuidian'=>'水电费发票','liushui'=>'公司流水单','zhengxin'=>'征信报告','xingshi'=>'行驶证','fangchan'=>'房产证','zhicheng'=>'职称证明'];

$who=Yii::$app->user->identity->username;
$dir=$dir=Yii::getAlias('@webroot').'/userdata/'.$who.'/detail/';
$files=scandir($dir);
$list=[];
foreach($files as $f){
	$list[]=explode('.',$f)[0];
}
VarDumper::dump($list);
?>
                <div class="hd_left"><h1>必须资料</h1></div>
		<?php

		foreach($bixu as $bx){
			if(in_array($bx,$list,true)){
				echo "<p>".$ts[$bx]." 已上传</p>"; 
			}else{
				echo "<p>".$ts[$bx]." 未上传</p>";
			}
				echo "<br/>";
		}
		
		?>

                <div class="hd_left"><h1>加分资料</h1></div>
		<?php
		foreach($jiafen as $bx){
			if(in_array($bx,$list,true)){
				echo "<p>".$ts[$bx]." 已上传</p>"; 
			}else{
				echo "<p>".$ts[$bx]." 未上传</p>";
			}
				echo "<br/>";
		}
		
		?>

                <div class="hd_right">
                        <?= Html::a('更改信息', ['/site/detail'], ['class' => 'btn btn-primary','style'=>'width:100px;']) ?>
                </div>
		<div class="clc"></div>
<?php ActiveForm::end(); ?>





















