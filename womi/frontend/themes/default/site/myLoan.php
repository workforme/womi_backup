<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>

<h1>您的贷款申请列表如下</h1>
<ul>
<?php foreach ($loanList as $loan): ?>
    <li>
        <?= Html::encode("{$loan->real_name}") ?>  
        <?= $loan->ident_card_id ?>
        <?= $loan->phone ?>
        <?= $loan->amount ?>
        <?= $loan->create_time ?>
    </li>
<?php endforeach; ?>
</ul>

<?= LinkPager::widget(['pagination' => $pagination]) ?>
