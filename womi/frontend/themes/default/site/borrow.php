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

/**
 * @var yii\web\View $this
 */

$this->registerCssFile(CommonUtility::getThemeUrl('css_3/borrow.css'));
?>
<div class="borrow-i">
   <div class="borrow-h" >沃米贷借贷产品介绍</div>
   <div class="index-basic">
        <div class="tr-row border ht1">
                <div class="tr-h1 color1"><span>企业贷</span></div>
                <div class="tr-content">
			适用于企业经营的法人代表<br>
                        <ul style="list-style-type:circle;">
				<li>1.申请人条件：具有第二代身份证的中国大陆居民；年龄25周岁-60周岁；企业营业执照注册年满一年的法人</li>
				<li>2、资料：申请人身份证正反面照片、对公对私流水、经营场所的租赁合同、水电费发票、申请人个人征信报告</li>
				<li>3、费用：服务费+月管理费+利息 </li>
				<li>4、借款期限：3-36个月</li>
				<li>5、还款方式：等额本息 </li>
				<li>6、申请额度：2-50万</li>
			</ul>
                </div>
		<div class="tr-button">
			<a href="/index.php?r=site/loan&type=qy"><input class="b-button" type="button" value="去申请" /></a>
		</div>
        </div>
        <div class="tr-row border ht1">
                <div class="tr-h1 color2">工薪贷</div>
                <div class="tr-content">
			适用于工薪人士<br>
                        <ul style="list-style-type:circle;">
				<li>1、申请人条件：具有第二代身份证的中国大陆居民；年龄24周岁-60周岁；在现单位工作持续工作年满半年</li>
				<li>2.资料：申请人身份证正反面照片、近半年打卡工资流水、工作收入证明、居住地水电费发票、居住地租赁合同；申请人个人征信报告</li>
				<li>3、费用：服务费+月管理费+利息 </li>
				<li>4、借款期限：3-36个月</li>
				<li>5、还款方式：等额本息  </li>
				<li>6、申请额度：2-30万</li>
			</ul>
                </div>
		<div class="tr-button">
                       <a href="/index.php?r=site/loan&type=gx"><input class="b-button" type="button" value="去申请" /></a>
                </div>
        </div>
        <div class="tr-row border ht1">
                <div class="tr-h1 color3">网商贷</div>
                <div class="tr-content">
			适合于网店、微店经营的店主<br>
                        <ul style="list-style-type:circle;">
				<li>1、申请人条件：具有第二代身份证的中国大陆居民；年龄24周岁-60周岁；网店或者微店经营年满一年</li>
				<li>2资料：申请人身份证正反面照片、近半年的网上交易证明件、居住地水电费发票、居住地租赁合同、申请人个人征信报告</li>
				<li>3、费用：服务费+月管理费+利息  </li>
				<li>4、借款期限：3-12个月</li>
				<li>5、还款方式：等额本息 </li>
				<li>6、申请额度：5-30万</li>
			<ul>
                </div>
		<div class="tr-button">
                        <a href="/index.php?r=site/loan&type=ws"><input class="b-button" type="button" value="去申请" /></a>
                </div>
        </div>

   </div>
</div>
