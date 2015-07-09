<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var app\models\LoginForm $model
 */
$this->title = '欢迎回来';
$this->params['breadcrumbs'][] = $this->title;
?>
<div>
<div class="site-login-left"></div>

<div class="site-login-right">
			<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
				<div class="login"><?= $form->field($model, 'username') ?></div>
				<div class="login"><?= $form->field($model, 'password')->passwordInput() ?></div>
				<div class="login">
					<div style="float:left;color:#999;margin:1em 0">
						<?= $form->field($model, 'rememberMe')->checkbox() ?>
					</div>
					<div style="float:right;margin:1em 0">
						<?= Html::a('忘记密码', ['site/request-password-reset']) ?>.
					</div>
					<div class="gdcls"></div>
				</div>
				<div class="login">
					<?= Html::submitButton('登录沃米', ['class' => 'sbtn btn btn-primary']) ?>
				</div>
			<?php ActiveForm::end(); ?>
</div>

<div class="gdcls"></div>
</div>
