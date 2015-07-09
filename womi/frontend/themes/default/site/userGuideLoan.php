<?php
use yii\helpers\Html;
?>
<div class="guide_bg">
	<div class="guide_hd">
		<div class="guide_hd_left"><h1>贷款申请简介</h1></div> 
		<div class="guide_hd_right">
			<?= Html::a('现在就申请', ['/site/loan'], ['class' => 'btn btn-primary','style'=>'width:100px;']) ?>	
		</div>
	</div>
	<div class="guide_left">
		<div class="guide_left_word">
		<p >
                        为了满足不同贷款用户的贷款需求，我们提供了三种低门槛、无抵押的贷款:
                        </br>
                        </br>
                       <p> 企业贷：适用企业经营的法人代表</p>
                        </br>
                       <p> 工薪贷：适用于工薪人士</p>
                        </br>
                      <p>  电商贷：适合经营网店的店主</p>
                        </br>
                        </br>
			</p>
<p>
                        具体的类型介绍和申请条件参见&nbsp;"我要贷款"&nbsp;内容页。<br>
                     </p><p>   发起贷款申请后，您可以登录账户，进入个人中心-贷款管理界面，跟踪申请状态或查看历史申请。
                        </br>
		</p>
		</div>
	</div>

	<div class="guide_right" style="margin-top:30px;">

		<img id="loan_img" src="/static/themes/default/images_2/loan-type.jpg"></img>
	</div>

	<div class="guide_hd">
	<div class="guide_hd_left"><h1>申请贷款流程</h1></div>
	</div>
	<div class="guide_flow">
		<img id="loan_img" src="/static/themes/default/images_2/loan-flow.jpg"></img>
	</div>
	
	<div style="clear:both"></div>
</div>



