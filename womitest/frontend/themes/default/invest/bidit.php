<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\Session;
use common\includes\CommonUtility;
use common\models\User;

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
		 //借款人信息/如有必要
		 $name=Yii::$app->user->identity->username;
		 $who= User::findByUsername($name);
		 //$invest->bidder=$who->username;
		 $invest->phone=$who->phone;
		 
		 $invest->loan_rate=$loan->loan_rate;
		 $invest->loanid=$loan->loanid;
		 $invest->wmstat=0;
		 ?>



			 <?//= $form->field($invest,'bidder')->hiddenInput(['style'=>'width:240px']);?>
			 <?//= $form->field($invest,'phone')->hiddenInput(['style'=>'width:240px']);?>
			 <?//= $form->field($invest,'loan_rate')->hiddenInput(['style'=>'width:240px']);?>
			 <?//= $form->field($invest,'loanid')->hiddenInput(['style'=>'width:240px']);?>
			 <?//= $form->field($invest,'wmstat')->hiddenInput(['style'=>'width:240px']);?>
                       	 <div class="loan">
                                   <div class="loan-hide" id="loan-amount"><input  id="testalert"></input></div>
                                   <div class="loanr" id="loan-rate"><?= $form->field($invest,'amount')->textArea(['readonly' => true,'style'=>'width:240px']);?></div>
                                   <div class="loanl">投标金额</div>
                          </div>


			                            <div class="loan">
                                   <div class="loan-hide" id="loan-btn"><input  id="testalert"></input></div>
                                   <div class="loanr">
                                   <?= Html::submitButton('确认投标', ['class' => 'sbtn btn btn-primary']) ?>
                                   </div>
                           </div>
                  <?php ActiveForm::end(); ?>
        </div>
</div>
