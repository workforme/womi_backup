<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\Session;
use common\includes\CommonUtility;
use common\models\User;

?>
<div class="loan-bg">
     <p>请输入您的贷款信息：</p>
        <div class="loan-outer">
                 <?php $form = ActiveForm::begin(['id' => 'form-loan',
                                                  'fieldConfig' => [
                                                                    'template'=>"{input}\n{error}",
                                                                   ],
				]);
		 ?>



			 <?= $form->field($model,'bidder')->hiddenInput(['style'=>'width:240px']);?>
                  <?php ActiveForm::end(); ?>
        </div>
</div>
