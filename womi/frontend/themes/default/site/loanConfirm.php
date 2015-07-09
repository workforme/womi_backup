<?php
use yii\helpers\Html;
?>

<p>您成功录入了如下的借贷信息:</p>

<ul>
    <li><label>贷款类型</label>: <?= Html::encode($model->loan_type) ?></li>
    <li><label>真实姓名</label>: <?= Html::encode($model->realname) ?></li>
    <li><label>身份验证号码</label>: <?= Html::encode($model->idcard) ?></li>
    <li><label>电话</label>: <?= Html::encode($model->phone) ?></li>
    <li><label>申请贷款金额</label>: <?= Html::encode($model->amount) ?></li>
</ul>

