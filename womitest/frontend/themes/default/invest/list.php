<?php
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;
?>
<?php

$this->registerJs(
   '$("document").ready(function(){ 
        $("#new_country").on("pjax:end", function() {
		alert("sssss");
            $.pjax.reload({container:"#w0",timeout:10000});  //Reload GridView
        });
    });'
);
?>
<?php Pjax::begin(['id' => 'w0']) ?>
<?=GridView::widget([
         'dataProvider' => $dataProvider,
	 /*'pager'=>[ ['class'=>'yii\widgets\LinkPager',
                    'prevPageLabel'=>'上一页',  
                    'firstPageLabel'=>'首页',   
                    'nextPageLabel'=>'下一页',  
                    'lastPageLabel'=>'末页',  
                    'header'=>'aaa', ],  ],
*/
	 //'tableOptions'=>['align'=>'center','class'=>'am-table am-table-bd am-table-striped admin-content-table'],
	 'layout'=> '{items}{pager}',
         'columns' => [
	         ['attribute' =>'loan_id','visible'=>false,'label'=>'借款类型','options' => ['width' => '80']],
	         ['attribute' =>'loan_type','label'=>'借款类型','options' => ['width' => '80']],
                 ['attribute' =>'amount','label'=>'金额','options' => ['width' => '80']],
                 ['attribute' =>'loan_rate','label'=>'还款利率','options' => ['width' => '80']],
                 ['attribute' =>'bid_amount','label'=>'已投标额','options' => ['width' => '80']],  
		 //wmstat可以识别是否审核过，是否用户撤销，撤销是否通过，但是不展现给投资者
	
		 ['attribute' =>'comment','label'=>'审核意见','options' => ['width' => '80']],
		 ['attribute' => 'created_at','value' =>function($model){return date('Y-m-d',strtotime($model->created_at));},'label'=>'申请时间','options' => ['width' => '150']],

// ['class' => 'yii\grid\ActionColumn','header' => '操作','template' => '{view} {update}','headerOptions' => ['width' => '80']],
                 [
                 'class' => 'yii\grid\ActionColumn',
                 'header' => '操作',
                 'template' => '{bid}',
	/*	 'buttons' => [
        		'bid' => function ($url, $model) {
            return Html::a('<span class="glyphicon glyphicon-trash"></span>', '#'Url::toRoute('/loan/delete?phone=aaa'), [
            			'title' =>'xxx',
                		'data-confirm' => 'hello all',
                		//'data-method' => 'post',
                		'data-pjax' => 'w0',
            		    ]);
        	 	},
    		 ],*/
                 'buttons' => [
                 	'bid' => function ($url,$model) {
                   		//return Html::a('<span id="xxxx" class="glyphicon glyphicon-user"></span>',$url,['title'=>'审核']);},
                   		//return Html::a('<span id="xxxx" class="glyphicon glyphicon-user"></span>','#',['title'=>'审核',
                   		return Html::a('投标','http://182.92.4.87:8000/index.php?r=invest/bidit&loanid='.$model->loanid);
			},
                  ],
               	 /*'urlCreator' => function ($action, $model, $key, $index) {
				return Yii::$app->getUrlManager()->createUrl(['loan/list','id' => $model->status]);
	//return "www.baidu.com";
		 },*/            	
//		return Url::to(['loan/list']);},
		 'headerOptions' => ['width' => '80'],
                 ],
/*
                [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{download}',
                        //'header' => Yii::t('app', 'Download'),
                        'buttons' => [
                                'download' => function ($url, $model, $key) {
                                        $html = '<span class="glyphicon glyphicon-file"></span>';
                                        $html = Html::a($html, $url, ['title' => 'zdsd']);
                                        return $html;
                                }
                        ],
                        'urlCreator' => function ($action, $model, $key, $index) {
                             //Problem with this line
                             return Yii::$app->getUrlManager()->createUrl(['loan/list', 'id' => $model->status->['key']]);
                        }
                ],
*/

	  ],
]);
?>
<?php Pjax::end() ?>

