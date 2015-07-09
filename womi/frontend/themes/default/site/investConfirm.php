<?php
use yii\helpers\Html;
?>

<p>您成功录入了如下的理财信息:</p>

<ul>
    <li><label>理财类型</label>: <?= Html::encode($model->invest_type) ?></li>
    <li><label>真实姓名</label>: <?= Html::encode($model->real_name) ?></li>
    <li><label>身份验证号码</label>: <?= Html::encode($model->ident_card_id) ?></li>
    <li><label>电话</label>: <?= Html::encode($model->phone) ?></li>
    <li><label>理财金额</label>: <?= Html::encode($model->amount) ?></li>
</ul>

