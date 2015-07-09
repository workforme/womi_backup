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
     <p style='font:15px "微软雅黑",Arial,Times;color:#000;'>如果基础信息不正确，请您到个人中心修改</p>
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
				case "ws":
					$model->loan_type="网商贷";break;
				case "qy":
					$model->loan_type="企业贷";break;
				default:
					$model->loan_type=" ";break;
			}
			
			$model->realname=$user->realname;
			$model->phone=$user->phone;
			$model->fee_rate=$user->fee_rate;
		 ?>

                           <div class="loan">
                                   <div class="loan-hide" id="loan-type"><input  id="testalert"></input></div>
				   <div class="loanr">
			 	   <?= $form->field($model,'loan_type')->textInput(['readonly' => true,'style'=>'width:240px']);?>
				   </div>
                                   <div class="loanl">贷款类型</div>
                           </div>
                           <div class="loan">
                                   <div class="loan-hide" id="loan-name"><input  id="testalert"></input></div>
                                   <div class="loanr">
					<?= $form->field($model, 'realname')->textInput(['readonly' => true,'style'=>'width:240px']);?>
				   </div>
                                   <div class="loanl">真实姓名</div>
                           </div>
                           <div class="loan">
                                   <div class="loan-hide" id="loan-phone"><input  id="testalert"></input></div>
                                   <div class="loanr">
					<?= $form->field($model, 'phone')->textInput(['readonly' => true,'style'=>'width:240px']);?>
				   </div>
                                   <div class="loanl">联系电话</div>
                           </div>
                          <div class="loan">
                                   <div class="loan-hide" id="loan-amount"><input  id="testalert"></input></div>
                                   <div class="loanr" id="loan-fee">
					<?= $form->field($model, 'fee_rate')->textInput(['readonly' => true,'style'=>'width:240px']);?>
				   </div>
			           <div class="loanl">手续费率%</div>
				   </div>
                          <div class="loan">
                                   <div class="loan-hide" id="loan-amount"><input  id="testalert"></input></div>
                                   <div class="loanr" id="loan-amount"><?= $form->field($model, 'amount')?></div>
                                   <div class="loanl">申请金额/元</div>
                          </div>  
                          <div class="loan">
                                   <div class="loan-hide" id="loan-amount"><input  id="testalert"></input></div>
                                   <div class="loanr" id="loan-rate"><?= $form->field($model, 'loan_rate')?></div>
                                   <div class="loanl">期望年利率%</div>
                          </div>
			  <div class="loan">
                                   <div class="loan-hide" id="loan-amount"><input  id="testalert"></input></div>
                                   <div class="loanr" id="loan-rate"><?= $form->field($model, 'desc')->textArea();?></div>
                                   <div class="loanl">用途申述</div>
                          </div>

			 <!--div class="loan">
				   <?//这个fee可以搞成结合fee_rate*amount动态展示?>
                                   <div class="loan-hide" id="loan-amount"><input  id="testalert"></input></div>
                                   <div class="loanr" id="loan-fee"><?//= $form->field($model, 'fee')?></div>
                                   <div class="loanl">手续费</div>
                           </div-->

                           <div class="loan">
                                   <div class="loan-hide" id="loan-btn"><input  id="testalert"></input></div>
                                   <div class="loanr">
                                   <?= Html::submitButton('申请贷款', ['class' => 'sbtn btn btn-primary']) ?>
                                   </div>
                           </div>
                  <?php ActiveForm::end(); ?>
        </div>
</div>
