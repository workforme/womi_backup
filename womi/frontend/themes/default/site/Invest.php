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
$this->title = 'InvestChannel';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invest-bg">
       <p>请输入您的理财信息：</p>
        <div class="invest-outer">
                 <?php $form = ActiveForm::begin(['id' => 'form-investchannel',
                                                  'fieldConfig' => [
                                                                    'template'=>'{input}{error}',
                                                                   ],
                  ]); ?>

                           <div class="invest">
                                   <div class="invest-hide" id="sign-type"><input  id="testalert"></input></div>
                                   <div class="investr"><?= $form->field($model, 'invest_type')?></div>
                                   <div class="investl">理财类型</div>
                           </div>
                           <div class="invest">
                                   <div class="invest-hide" id="sign-name"><input  id="testalert"></input></div>
                                   <div class="investr"><?= $form->field($model, 'real_name')?></div>
                                   <div class="investl">真实姓名</div>
                           </div>
                           <div class="invest">
                                   <div class="invest-hide" id="sign-card"><input  id="testalert"></input></div>
                                   <div class="investr"><?= $form->field($model, 'ident_card_id')?></div>
                                   <div class="investl">身份验证号码</div>
                           </div>
                           <div class="invest">
                                   <div class="invest-hide" id="sign-phone"><input  id="testalert"></input></div>
                                   <div class="investr"><?= $form->field($model, 'phone')?></div>
                                   <div class="investl">电话</div>
                           </div>
                           <div class="invest">
                                   <div class="invest-hide" id="sign-amount"><input  id="testalert"></input></div>
                                   <div class="investr"><?= $form->field($model, 'amount')?></div>
                                   <div class="investl">理财金额</div>
                           </div>
                           <div class="invest">
                                   <div class="invest-hide" id="sign-btn"><input  id="testalert"></input></div>
                                   <div class="investr">
                                   <?= Html::submitButton('我要理财', ['class' => 'sbtn btn btn-primary']) ?>
                                   </div>
                           </div>
                  <?php ActiveForm::end(); ?>
        </div>
</div>
