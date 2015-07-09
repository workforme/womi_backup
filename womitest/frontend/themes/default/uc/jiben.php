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
<style type="text/css">
.fl{float:left}
.clc{clear:both}
.hd{width:70%;margin-bottom:20px;}
.hd .hd_left{float:left;}
h1{font:bold 17px "微软雅黑",Arial,Times;color:#444444;}
.hd .hd_right{float:right;}

</style>


 <?php $form = ActiveForm::begin(['id' => 'detailinfo',
'layout' => 'horizontal',
'fieldConfig' => [
    'template' => "{label}\n{beginWrapper}\n{input}\n{endWrapper}",
    'horizontalCssClasses' => [
        'label' => 'col-sm-4',
        'offset' => 'col-sm-offset-2',
        'wrapper' => 'col-sm-8',
        'error' => '',
        'hint' => '',
    ],
     ],
'options' => ['enctype' => 'multipart/form-data']]);?>
<div class="hd">
                <div class="hd_left"><h1>基本信息</h1></div>
                <div class="hd_right">
                        <?= Html::a('更改信息', ['/site/detail'], ['class' => 'btn btn-primary','style'=>'width:100px;']) ?>
                </div>
<div class="clc"></div>
</div>

<div class="bd">               
<div class="fl"> <?= $form->field($model,'realname')->textInput(['placeholder' =>$model->realname,'readonly' => true,'style'=>'width:180px'])->inline()->label('姓    名')?></div>
<div class="fl"> <?= $form->field($model,'education')->inline()->label('学    历')?></div>
<div class="clc"></div>
<div class="fl"> <?= $form->field($model,'idcard_num')->textInput(['placeholder' =>$model->idcard_num,'readonly' => true,'style'=>'width:180px'])->inline()->label('身份证号')?></div>
<div class="fl"> <?= $form->field($model,'phone')->textInput(['placeholder' =>$model->phone,'readonly' => true,'style'=>'width:180px'])->inline()->label('电    话')?></div>
<div class="clc"></div>
<div class="fl"> <?= $form->field($model,'industry')->textInput(['placeholder' =>$model->industry,'readonly' => true,'style'=>'width:180px'])->inline()->label('工作行业')?></div>
<div class="fl"> <?= $form->field($model,'work_year')->textInput(['placeholder' =>$model->work_year,'readonly' => true,'style'=>'width:180px'])->inline()->label('工作年限')?></div>
<div class="clc"></div>
<div class="fl"> <?= $form->field($model,'com_name')->textInput(['placeholder' =>$model->com_name,'readonly' => true,'style'=>'width:180px'])->inline()->label('公司名称')?></div>
<div class="fl"> <?= $form->field($model,'com_addr')->textInput(['placeholder' =>$model->com_addr,'readonly' => true,'style'=>'width:180px'])->inline()->label('公司地址')?></div>
<div class="clc"></div>
<div class="fl"> <?= $form->field($model,'com_phone')->textInput(['placeholder' =>$model->com_phone,'readonly' => true,'style'=>'width:180px'])->inline()->label('公司电话')?></div>
<div class="fl"> <?= $form->field($model,'com_mail')->textInput(['placeholder' =>$model->com_mail,'readonly' => true,'style'=>'width:180px'])->inline()->label('公司邮箱')?></div>

<div class="clc"></div>

<div class="fl"> <?= $form->field($model,'marry')->textInput(['placeholder' =>$model->marry,'readonly' => true,'style'=>'width:180px
'])->inline()->label('婚姻状况')?></div>
<div class="fl"> <?= $form->field($model,'children')->textInput(['placeholder' =>$model->children,'readonly' => true,'style'=>'width:18
0px'])->inline()->label('有无子女')?></div>
<div class="clc"></div>
<div class="fl"> <?= $form->field($model,'house_addr')->textInput(['placeholder' =>$model->house_addr,'readonly' => true,'style'=>'width:
180px'])->inline()->label('家庭住址')?></div>
<div class="fl"> <?= $form->field($model,'bka_name')->textInput(['placeholder' =>$model->bka_name,'readonly' => true,'style'=>'width:18
0px'])->inline()->label('联系人')?></div>
<div class="clc"></div>
<div class="fl"> <?= $form->field($model,'bka_phone')->textInput(['placeholder' =>$model->bka_phone,'readonly' => true,'style'=>'width:1
80px'])->inline()->label('手机')?></div>
<div class="fl"> <?= $form->field($model,'bka_relation')->textInput(['placeholder' =>$model->bka_relation,'readonly' => true,'style'=>'widt
h:180px'])->inline()->label('与本人关系')?></div>
<div class="clc"></div>
<div class="fl"> <?= $form->field($model,'bkb_name')->textInput(['placeholder' =>$model->bkb_name,'readonly' => true,'style'=>'width:18
0px'])->inline()->label('联系人')?></div>
<div class="fl"> <?= $form->field($model,'bkb_phone')->textInput(['placeholder' =>$model->bkb_phone,'readonly' => true,'style'=>'width:1
80px'])->inline()->label('手机')?></div>
<div class="clc"></div>
<div class="fl"> <?= $form->field($model,'bkb_relation')->textInput(['placeholder' =>$model->bkb_relation,'readonly' => true,'style'=>'widt
h:180px'])->inline()->label('与本人关系')?></div>


</div>

<?php ActiveForm::end(); ?>
<br />
<br />
<br />
