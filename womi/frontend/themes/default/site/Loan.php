<?php
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\web\Session;
use common\includes\CommonUtility;
/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var common\models\Loan $model
 */
$this->title = 'LoanChannel';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="loan-bg">
     <p>请输入您的贷款信息：</p>
        <div class="loan-outer">
                 <?php $form = ActiveForm::begin(['id' => 'form-loan',
                                                  'fieldConfig' => [
                                                                    'template'=>"{input}\n{error}",
                                                                   ],
				]);

			switch($_GET['type'])
			{
				case "gx":
					$model->loan_type="工薪贷";break;
				case "wx":
					$model->loan_type="网商贷";break;
				case "qy":
					$model->loan_type="企业贷";break;
				default:
					$model->loan_type=" ";break;
			}
		 ?>

                           <div class="loan">
                                   <div class="loan-hide" id="loan-type"><input  id="testalert"></input></div>
                                   <div class="loanr"><?= $form->field($model,'loan_type')->textarea(array('row'=>1,'readonly' => 'true'));?></div>
                                   <div class="loanl">贷款类型</div>
                           </div>
                           <div class="loan">
                                   <div class="loan-hide" id="loan-name"><input  id="testalert"></input></div>
                                   <div class="loanr"><?= $form->field($model, 'realname')?></div>
                                   <div class="loanl">真实姓名</div>
                           </div>
                           <div class="loan">
                                   <div class="loan-hide" id="loan-card"><input  id="testalert"></input></div>
                                   <div class="loanr"><?= $form->field($model, 'idcard')?></div>
                                   <div class="loanl">身份验证号码</div>
                           </div>
                           <div class="loan">
                                   <div class="loan-hide" id="loan-phone"><input  id="testalert"></input></div>
                                   <div class="loanr"><?= $form->field($model, 'phone')?></div>
                                   <div class="loanl">电话</div>
                           </div>
                           <div class="loan">
                                   <div class="loan-hide" id="loan-amount"><input  id="testalert"></input></div>
                                   <div class="loanr"><?= $form->field($model, 'amount')?></div>
                                   <div class="loanl">申请金额</div>
                           </div>
                           <div class="loan">
                                   <div class="loan-hide" id="loan-btn"><input  id="testalert"></input></div>
                                   <div class="loanr">
                                   <?= Html::submitButton('申请贷款', ['class' => 'sbtn btn btn-primary']) ?>
                                   </div>
                           </div>
                  <?php ActiveForm::end(); ?>
        </div>
</div>
