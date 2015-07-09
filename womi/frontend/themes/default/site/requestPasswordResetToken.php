<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var common\models\User $model
 */
$this->title = '申请密码重置';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-request-password-reset">
	<h1 style="font-size:14px;"><?= Html::encode($this->title) ?></h1>

	<p style="font-size:14px;">请填写您的注册邮箱，您会收到一封指导您修改密码的邮件.</p>

	<?php 
		if(Yii::$app->getSession()->hasFlash('reset-req-result')){
			Yii::info("has flash");?>
			<div style="width:320px;margin:5px auto;height:70px;">
                	<?= Yii::$app->getSession()->getFlash('reset-req-result');?>
			</div>
		<?php
        	}else{
			Yii::info("no flash");
	?>	
	<?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
	<div style="width:320px;margin:5px auto;height:70px;">
		<?= $form->field($model, 'email') ?>
		<?= Html::submitButton('发送邮件', ['class' => 'sbtn btn btn-primary']) ?>
	</div>
	<?php ActiveForm::end(); ?>
	<?php	}?>
</div>
