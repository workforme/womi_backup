<?php
use yii\grid\GridView;
?>
<?=GridView::widget([
         'dataProvider' => $dataProvider,
         'columns' => [
	         'username',
		  [
	          	'attribute' => 'created_at',
	          //	'format' => ['data', 'Y-m-d H:i:s'],
	          	'options' => ['width' => '200']
	          ],
	  ],
         // ['class' => 'yii\grid\ActionColumn', 'header' => '操作', 'headerOptions' => ['width' => '80']],
]);
?>
