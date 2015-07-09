<?php
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
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

<div class="sign-bg">
	<div  class="sign-outer">
		<?php $form = ActiveForm::begin([
						//	'layout' => 'horizontal',
						//	'fieldConfig' => [
						//	'template'=>"{input}\n{error}",
							    //'hintOptions'=>['style'=>'display:inline; color:red; font-size:12px;'],
   /* 'template' => "{label}\n{input}\n{error}",
        'horizontalCssClasses' => [
          //  'label' => 'col-sm-4',
            //'offset' => 'col-sm-offset-4',
            //'wrapper' => 'col-sm-8',
            'error' => 'sign-hide',
            //'hint' => '',*/
//        ],
						//	],
							/*'validateOnChange'=>true,
							'validateOnSubmit'=>true,
							'enableClientValidation'=>true,*/
							'enableAjaxValidation'=>true,
							'id' => 'form-signup',
							//'clientOptions'=>[
							//			'validateOnSubmit'=>true,
							//			'validateOnChange'=>true,
							//],
			     ]);?>
				<div class="sign">
					<div class="signr"><?= $form->field($model,'username')?></div>
					<div class="signl">昵称</div>
				</div>
				<div class="sign">
					<div class="signr"><?= $form->field($model, 'email')?></div>
					<div class="signl">邮箱</div>
				</div>
							<div class="sign">
					<div class="sign-hide" id="sign-btn"><input  id="testalert"></input></div>
					<div class="signr">
					<?= Html::submitButton('注册沃米', ['class' => 'sbtn btn btn-primary']) ?>
					</div>
				</div>
			<?php ActiveForm::end(); ?>
	</div>
</div>
