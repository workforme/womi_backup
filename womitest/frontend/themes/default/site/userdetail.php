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
                <p><label>姓名</label><div class="inp"><?= $form->field($model,'realname')->inline()->label(false)?></div></p>
                <p><label>学历</label><div class="inp"><?= $form->field($model,'education')->inline()->label(false)?></div></p>
	  	<div class="cls"></div>                        
                <p><label>身份证号</label><div class="inp"><?= $form->field($model,'idcard_num')->inline()->label(false)?></div></p>
                <p><label>电    话</label><div class="inp"><?= $form->field($model,'phone')->inline()->label(false)?></div></p>
		
	<div class="cls"></div><br/>      
               
            <h3>工作信息&nbsp&nbsp<em></em></h3>
            <p><label>工作年限</label><div class="inp"><?= $form->field($model,'work_year')->inline()->label(false)?></div></p>
            <p><label>工作行业</label><div class="inp"><?= $form->field($model,'industry')->inline()->label(false)?></div></p>
			<div class="cls"></div>                       
            <p><label>公司名称</label><div class="inp"><?= $form->field($model,'com_name')->inline()->label(false)?></div></p>
            <p><label>公司地址</label><div class="inp"><?= $form->field($model,'com_addr')->inline()->label(false)?></div></p>
		 	<div class="cls"></div>                        
            <p><label>公司电话</label><div class="inp"><?= $form->field($model,'com_phone')->inline()->label(false)?></div></p>
             <p><label>公司邮箱</label><div class="inp"><?= $form->field($model,'com_mail')->inline()->label(false)?></div></p>
			<div class="cls"></div>
                        <div class="btn_nav">
                            <input type="button" class="next right" value="下一步&raquo;" />
                        </div>
                    </div>
			
<div class="page">
                       <h3>家庭情况&nbsp&nbsp<em></em></h3>
                       <p><label>婚姻状况</label><?=$form->field($model,'marry',['inlineRadioListTemplate'=>'<div class="myradio">{label}{beginWrapper}{input}{error}{endWrapper}{hint}</div>'])->inline()->radioList(['0'=>'已婚','1'=>'未婚','2'=>'离异','3'=>'丧偶'])->label(false) ?></p>
<div class="cls"></div>                        
                        <p><label>有无子女</label><?=$form->field($model,'children',['inlineRadioListTemplate'=>'<div class="myradio">{label}{beginWrapper}{input}{error}{endWrapper}{hint}</div>'])->inline()->radioList(['0'=>'有','1'=>'无'])->label(false) ?></p>
<div class="cls"></div>
                   <p><label>家庭住址</label><div class="inp"><?=$form->field($model,'house_addr')->inline()->label(false)?></div></p>
<div class="cls"></div><br/>
                        <h3>直系亲属&nbsp&nbsp<em>任意一位直系亲属皆可</em></h3>
                        <p><label>姓名</label><div class="inp"><?= $form->field($model,'bka_name')->inline()->label(false)?></div></p>
                       <p><label>手机</label><div class="inp"><?= $form->field($model,'bka_phone')->inline()->label(false)?></div></p>
<br/>
                    <p><label>关系</label><div class="inp"><?= $form->field($model,'bka_relation')->inline()->label(false)?></div></p>

<div class="cls"></div><br/>
                        <h3>其他联系人&nbsp&nbsp<em>朋友同学或者其他亲人</em></h
                        <p><label>姓名</label><div class="inp"><?= $form->field($model,'bkb_name')->inline()->label(false)?></div></p>
                       <p><label>手机</label><div class="inp"><?= $form->field($model,'bkb_phone')->inline()->label(false)?></div></p>
                    <p><label>关系</label><div class="inp"><?= $form->field($model,'bkb_relation')->inline()->label(false)?></div></p>


<div class="cls"></div>
                        <div class="btn_nav">
                           <input type="button" class="prev" style="float:left" value="&laquo;上一步" />
                           <input type="button" class="next right" value="下一步&raquo;" />
                        </div>
	                </div>
<div class="page">
                   <h3>房产信息&nbsp&nbsp<em></em></h3>
                   <p><label>有无房产</label><?=$form->field($model,'has_house',['inlineRadioListTemplate'=>'<div class="myradio">{label}{beginWrapper}{input}{error}{endWrapper}{hint}</div>'])->inline()->radioList(['0'=>'有','1'=>'无'])->label(false) ?></p>
<div class="cls"></div>                        

<div class="cls"></div>
                        <p><label>有无房贷</label><?=$form->field($model,'house_loan',['inlineRadioListTemplate'=>'<div class="myradio">{label}{beginWrapper}{input}{error}{endWrapper}{hint}</div>'])->inline()->radioList(['0'=>'有','1'=>'无'])->label(false) ?></p>
<div class="cls"></div>
<div class="cls"></div><br/>
                        <h3>车产信息&nbsp&nbsp<em></em></h3>
                        <p><label>是否有车</label><?=$form->field($model,'has_car',['inlineRadioListTemplate'=>'<div class="myradio">{label}{beginWrapper}{input}{error}{endWrapper}{hint}</div>'])->inline()->radioList(['0'=>'有','1'=>'无'])->label(false) ?></p>
<div class="cls"></div>
                        <p><label>有无车贷</label><?=$form->field($model,'car_loan',['inlineRadioListTemplate'=>'<div class="myradio">{label}{beginWrapper}{input}{error}{endWrapper}{hint}</div>'])->inline()->radioList(['0'=>'有','1'=>'无'])->label(false) ?></p>
<div class="cls"></div>
                        <p><label>车品牌</label><div class="inp"><?= $form->field($model,'car_name')->inline()->label(false)?></div></p>
                   <p><label>购车时间</label><div class="inp"><?= $form->field($model,'car_buytime')->inline()->label(false)?></div></p>

<div class="cls"></div>

                        <div class="btn_nav">
                           <input type="button" class="prev" style="float:left" value="&laquo;上一步" />
                           <input type="button" class="next right" value="下一步&raquo;" />
                        </div>
</div>

<div class="page">
                        <h3>必须资料&nbsp&nbsp<em>会覆盖原图，已上传结果可在个人中心/认证信息界面查看</em></h3>
                        <p><label>身份证正面照</label><div class="myfield"><?= $form->field($model,'idcard_front')->fileInput()?></div></p>
                        <p><label>身份证反面照</label><div class="myfield"><?= $form->field($model, 'idcard_back')->fileInput()->inline()->label(false)?></div></p>
<div class="cls"></div>
                        <p><label>本人持身份证正面照</label><div class="myfield"><?= $form->field($model, 'idcard_self')->fileInput()->inline()->label(false) ?></div></p>
			<div class="cls"></div>                        
                        <p><label>营业执照正本</label><div class="myfield"><?= $form->field($model, 'zhizhao')->fileInput()->inline()->label(false) ?></div></p>
                        <p><label>营业执照副本</label><div class="myfield"><?= $form->field($model, 'zhizhao_copy')->fileInput()->inline()->label(false) ?></div></p>
			<div class="cls"></div>                        
                        <p><label>经营场地租赁合同</label><div class="myfield"><?= $form->field($model, 'hetong')->fileInput()->inline()->label(false) ?></div></p>
                        <p><label>三月内水电费发票</label><div class="myfield"><?= $form->field($model, 'shuidian')->fileInput()->inline()->label(false) ?></div></p>
			<div class="cls"></div>                        
                        <p><label>半年内公对私流水</label><div class="myfield"><?= $form->field($model, 'liushui')->fileInput()->inline()->label(false) ?></div></p>
                        <p><label>15日内征信报告</label><div class="myfield"><?= $form->field($model, 'zhengxin')->fileInput()->inline()->label(false) ?></div></p>
			<div class="cls"></div>     <br/>                   
                        <h3>补充资料&nbsp&nbsp<em>非必须，有助于提高贷款速度和额度</em></h3>
                        <p><label>行驶证</label><div class="myfield"><?= $form->field($model, 'xingshi')->fileInput()->inline()->label(false)?></div></p>
			<div class="cls"></div>                        
                        <p><label>房产证</label><div class="myfield"><?= $form->field($model, 'fangchan')->fileInput()->inline()->label(false)?></div></p>
			<div class="cls"></div>                        
                        <p><label>职称证明</label><div class="myfield"><?= $form->field($model, 'zhicheng')->fileInput()->inline()->label(false)?></div></p>
			<div class="cls"></div>                        
               <div class="btn_nav">
                  <input type="button" class="prev" style="float:left" value="&laquo;上一步" />
                  <input type="submit" class="next right" id="sub" value="完成提交" />
<?//= Html::submitButton('完成提交', ['class' => 'sbtn btn btn-primary']) ?>
               </div>
</div>
		</div>
	</div>
<?php ActiveForm::end(); ?>
<br />
<br />
<br />

</div>

