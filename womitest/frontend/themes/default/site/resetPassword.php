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
<div class="site-reset-password">
	<h1  style="font-size:14px;"><?= Html::encode($this->title) ?></h1>

	<p   style="font-size:14px;">在这里输入您的新密码</p>

			<?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
				<div style="width:320px;margin:5px auto;height:70px;">
				<?= $form->field($model, 'password')->passwordInput() ?>
				<div class="form-group">
					<?= Html::submitButton('点击生效', ['class' => 'sbtn btn btn-primary']) ?>
				</div>
				</div>
			<?php ActiveForm::end(); ?>
</div>
