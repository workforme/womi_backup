<?php
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;
?>
<?php
/*
    $('#del_btn').click(function(){
        $.ajax({
                
        alert('xxxxxxxxxx');
               type:'GET',
               dataType:'text',
               url: 'http://182.92.4.87:8000/index.php?r=loan/delete&loanid='.$model->loanid,
               error: function (XMLHttpRequest, textStatus, errorThrown) {
                           alert(XMLHttpRequest.status + ':' + XMLHttpRequest.statusText); },
               success: function (page){
                           $('.ucRight').html(page);
               }
        });
        alert('xxxxxxxxxx');
    });*/
$this->registerJs(
   "$('document').ready(function(){ 
        
	$('#new_country').on('pjax:end', function() {
            $.pjax.reload({container:'#w0',timeout:10000});  //Reload GridView
        });
    });"
);
?>
<script>
$("#del_btn").click(function(){
     lid=$(this).attr("lid");
     stat=$(this).attr("stat");
     if(stat>>1&1){
	alert("已经撤销，不可再次删除");
	return;
     }
     if(stat&1){
        alert("已经通过审核，需联系客服删除");
        return;
     }
     $.ajax({
                     type: 'GET',
		     //async: false,
                     dataType: 'text',
                     url: 'http://182.92.4.87:8000/index.php?r=loan/delete&loanid='+lid,
                     error: function (XMLHttpRequest, textStatus, errorThrown) {
                                 alert(XMLHttpRequest.status + ':' + XMLHttpRequest.statusText); },
                     success: function (page){
                                 $('.ucRight').html(page);
                     }

     });
});
</script>

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
		 //['class' => 'yii\grid\SerialColumn'],
	         ['attribute' =>'loan_type','label'=>'借款类型','options' => ['width' => '80']],
                 ['attribute' =>'amount','label'=>'金额','options' => ['width' => '80']],
                 ['attribute' =>'loan_rate','label'=>'还款利率','options' => ['width' => '80']],
                 ['attribute' =>'fee','label'=>'手续费','options' => ['width' => '80']],  
		 ['attribute' =>'wmstat',
			'value' =>function($model){
					if(($model->wmstat>>1)&1){
						return '已流标';
					}else{
						return $model->wmstat&1 ? '已通过审核':'未审核/不通过';
					}
				},
			'label'=>'状态',
			'options' => ['width' => '100']
		 ],
		 ['attribute' =>'comment','label'=>'审核意见','options' => ['width' => '80']],
		 ['attribute' => 'created_at','value' =>function($model){return date('Y-m-d',strtotime($model->created_at));},'label'=>'申请时间','options' => ['width' => '150']],

// ['class' => 'yii\grid\ActionColumn','header' => '操作','template' => '{view} {update}','headerOptions' => ['width' => '80']],
                 [
                 'class' => 'yii\grid\ActionColumn',
                 'header' => '操作',
                 'template' => '{del}',
	        /*可以出发url删除但是无法判别为ajax请求 
		'buttons' => [
	             'del' => function ($url, $model) {
	                 return Html::a('<span class="glyphicon glyphicon-trash"></span>', 
	     				'/index.php?r=loan/delete&loanid='.$model->loanid, 
	     				[
	                     		 'title' =>'投标',
	                    		 'data-confirm' => '确定删除吗',
	                     		 //'data-method' => 'post',
	                     		 'data-pjax' => 'w0',
	                 		]);
	                 },
	         ],*/
                 'buttons' => [
                 	'del' => function ($url,$model) {
                   		 //return Html::a('<span id="xxxx" class="glyphicon glyphicon-user"></span>',$url,['title'=>'审核']);},
                   		 //return Html::button('删除', ['id' => 'del_btn','class' => 'teaser','xxxclick'=>'alert("aaaa");']);
				 //return "<button id='del_btn' onclick='alert(\"aaaaa\");'>删除</button>";
				 return "<button lid=\"$model->loanid\" stat=\"$model->wmstat\" id='del_btn' >删除</button>";
					/*Html::a('<span id="xxxx" class="glyphicon glyphicon-user"></span>','http://www.baidu.com',
					['title'=>'审核',
					 'id' => 'del_btn',
					 'onclick'=>"test();return false;"
/*alert('aaaaaa');alert('bbb');$.ajax({
				                    type: 'GET',
				                    dataType: 'text',
				                    url: 'http://182.92.4.87:8000/index.php?r=loan/delete&loanid='.$model->loanid,
				                    error: function (XMLHttpRequest, textStatus, errorThrown) {
								alert(XMLHttpRequest.status + ':' + XMLHttpRequest.statusText); },
				                    success: function (page){
				                    		$('.ucRight').html(page);
				                    }
				             });return false;"
					 ]);*/
				 },
                  ],
               	 /*'urlCreator' => function ($action, $model, $key, $index) {
				return Yii::$app->getUrlManager()->createUrl(['loan/list','id' => $model->status]);
	//return "www.baidu.com";
		 },*/            	
//		return Url::to(['loan/list']);},
		 'headerOptions' => ['width' => '80'],
                 ],/*
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
                ],*/

	  ],
]);
?>
<?php Pjax::end() ?>

