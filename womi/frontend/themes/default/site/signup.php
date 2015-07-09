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
							'fieldConfig' => [
							'template'=>"{input}\n{error}",
							    //'hintOptions'=>['style'=>'display:inline; color:red; font-size:12px;'],
   /* 'template' => "{label}\n{input}\n{error}",
        'horizontalCssClasses' => [
          //  'label' => 'col-sm-4',
            //'offset' => 'col-sm-offset-4',
            //'wrapper' => 'col-sm-8',
            'error' => 'sign-hide',
            //'hint' => '',*/
//        ],
							],
							/*'validateOnChange'=>true,
							'validateOnSubmit'=>true,
							'enableClientValidation'=>true,
							'enableAjaxValidation'=>true,*/
							'id' => 'form-signup',
							//'clientOptions'=>[
							//			'validateOnSubmit'=>true,
							//			'validateOnChange'=>true,
							//],
			     ]);?>
				<div class="sign">
					<div class="sign-hide" id="sign-nick"><input  id="testalert"></input></div>
					<div class="signr"><?= $form->field($model,'username')?></div>
					<div class="signl">昵称</div>
				</div>
				<div class="sign">
					<div class="sign-hide" id="sign-mail"><input  id="testalert"></input></div>
					<div class="signr"><?= $form->field($model, 'email')?></div>
					<div class="signl">邮箱</div>
				</div>
				<div class="sign">
				       <div class="sign-hide" id="sign-code"><input  id="testalert"/></div>
				       <input type="hidden" id="csrfcode" value="<?php echo Yii::$app->request->csrfToken;?>"/> 
				       <div class="signr">
					    <div style="float:right;width:110px;"><?= Html::buttonInput('获取验证码',['class' => 'btn btn-primary','id'=>'btnSendCode','style'=>'width:110px;']) ?></div>
					    <div style="float:right;width:115px;margin-right:15px;"><?= $form->field($model, 'mailcode') ?></div>
	                                </div>
					<div class="signl">验证邮箱</div>
				</div>

				<div class="sign">
					<div class="sign-hide" id="sign-pass"><input  id="testalert"></input></div>
					<div class="signr" ><?= $form->field($model, 'password')->passwordInput() ?></div>
					<div class="signl">密码</div>
				</div>

				<div class="sign">
					<div class="sign-hide" id="sign-intend"><input  id="testalert"></input></div>
					<div class="signr" id="intend">
					<?=$form->field($model, 'intend')->dropDownList(
						['1'=>'我要借贷','0'=>'我要理财']) ?>
					</div><!-- ['prompt'=>'两种账户均可理财或者借贷']-->
					<div class="signl">账户类型</div>
				</div>
				<div class="sign">
					<div class="sign-hide" id="sign-agree"><input  id="testalert"></input></div>
					<div class="signr" >
					     <div id="agree" style="float:left;color:#999;margin:10px 20px;">
					      <?=Html::checkbox('',true,['label'=>'同意','ischeck'=>true,'checked'=>'true'])?>
					     </div>
					     <div style="float:right;margin:10px 20px">
	<a href='http://www.microriches.cn/index.php?r=site/about&about_id=protocol' target="_blank">《借贷和理财协议》</a>
					     </div>
					     <div class="gdcls"></div>
					</div>
					<div class="signl"></div>
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
