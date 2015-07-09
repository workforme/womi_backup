<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use yii\bootstrap\ActiveForm;
use yii\web\Session;
use common\includes\CommonUtility;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var common\models\User $model
 */
$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="sg-bg">
	<div  class="sg-outer">
		<?php $form = ActiveForm::begin([
							'enableAjaxValidation'=>true,
							'id' => 'form-sgup',
			     ]);?>
				<div class="sg">
					<div class="sgr"><?= $form->field($model,'username')?></div>
					<div class="sgl">昵称</div>
				</div>
				<div class="sg">
					<div class="sgr"><?= $form->field($model, 'email')?></div>
					<div class="sgl">邮箱</div>
								<div class="sg">
					<div class="sgr">
					<?= Html::submitButton('测试', ['class' => 'sbtn btn btn-primary']) ?>
					</div>
				</div>
			<?php ActiveForm::end(); ?>
	</div>
</div>
