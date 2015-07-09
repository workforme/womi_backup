<?php
 
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
 
/* @var $this yii\web\View */
/* @var $searchModel app\models\CountriesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
 
?>
<div class="countries-index">
 
    <?= $this->render('f', [
        'model' => $model,
        'model2' => $model2,
    ]) ?>
 
 
<?php Pjax::begin(['id' => 'countries']) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
          //  ['class' => 'yii\grid\SerialColumn'],
            'username',
            'created_at',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end() ?>
</div>
