<?php
 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
 
/* @var $this yii\web\View */
/* @var $model app\models\Countries */
/* @var $form yii\widgets\ActiveForm */
?>
 
<?php
 
$this->registerJs(
   '$("document").ready(function(){ 
        $("#new_country").on("pjax:end", function() {
            $.pjax.reload({container:"#countries",timeout:10000});  //Reload GridView
        });
    });'
);
?>
 
<div class="countries-form">
 
<?php yii\widgets\Pjax::begin(['id' => 'new_country']) ?>
<?php $form = ActiveForm::begin(['options' => ['data-pjax' => true ]]); ?>
 
    <?= $form->field($model2, 'username')->textInput(['maxlength' => 200]) ?> 
    <?= $form->field($model2, 'email')->textInput(['maxlength' => 200]) ?> 
    <?= $form->field($model2, 'password')->textInput(['maxlength' => 200]) ?> 
    <?= $form->field($model2, 'intend')->textInput(['maxlength' => 200]) ?> 
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
 
<?php ActiveForm::end(); ?>
<?php yii\widgets\Pjax::end() ?>
</div>

