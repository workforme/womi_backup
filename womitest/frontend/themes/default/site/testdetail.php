<?php
use yii\helpers\VarDumper;
use yii\helpers\Html;
use components\LuLu;
use common\includes\DataSource;
use components\helpers\TTimeHelper;
use components\widgets\LoopData;
use data\AttachmentAsset;
use common\includes\UrlUtility;
use common\includes\CommonUtility;
use yii\bootstrap\ActiveForm;
?>
<div id="main">
 <?php $form = ActiveForm::begin(['id' => 'detailinfo','options' => ['enctype' => 'multipart/form-data']]);?>
	<div id="wizard">
		<ul id="status">
			<li class="active"><strong>1.</strong>个人资料</li>
			<li><strong>2.</strong>亲友信息</li>
			<li><strong>3.</strong>资产情况</li>
			<li><strong>4.</strong>复核材料</li>
		</ul>

		<div class="items">
		    <div class="page">
                <h3>身份信息&nbsp&nbsp<em></em></h3>
                <p><label>姓名</label><div class="inp"><?= $form->field($model,'real_name')->inline()->label(false)?></div></p>
                       <p><label>身份证正面照</label><div class="myfield"><?= $form->field($model,'idcard_front')->fileInput()?></div></p>
                           
               <div class="btn_nav">
                  <input type="submit" class="next right" id="sub" value="完成提交" />
<?//= Html::submitButton('完成提交', ['class' => 'sbtn btn btn-primary']) ?>
               </div>
</div>
		</div>
<?php ActiveForm::end(); ?>
<br />
<br />
<br />

</div>

