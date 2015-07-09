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


$this->registerJsFile(CommonUtility::getThemeUrl('js/js.js'),['yii\web\JqueryAsset']);
$this->registerJsFile(CommonUtility::getThemeUrl('js_2/jquery-1.7.2.min.js'),['yii\web\JqueryAsset']);
$this->registerJsFile(CommonUtility::getThemeUrl('js_2/index.js'),['yii\web\JqueryAsset']);
$this->registerJsFile(CommonUtility::getThemeUrl('js_2/common.js'),['yii\web\JqueryAsset']);
$this->registerCssFile(CommonUtility::getThemeUrl('css_3/content.css'));
?>

<div class="pub_c">
   <div class="m_banner">
    <div class="banner b1" style="background-image:url(<?php echo CommonUtility::getThemeUrl()?>/images/datu2.jpg);height:310px;" id="banner1">
      <div class="main_c pr"> <a href="#"  title="lalalal" class="start_btn"></a> </div>
    </div>
    <div class="banner b5" style=" background-image:url(<?php echo CommonUtility::getThemeUrl()?>/images/datu1.jpg);height:310px;display:none;" id="banner5">
        <div class="main_c"> <a href="#" target="_blank" title="" class="l1"></a>
        <div class="countdown">
                <span class="num_1 fsm"></span>
            <span class="num_2 fsm"></span>
        </div>

         </div>
    </div>
    <div class="banner b2" style=" background-image:url(<?php echo CommonUtility::getThemeUrl()?>/images/datu4.jpg);display:none;" id="banner2"></div>
    <div class="banner b3" style=" background-image:url(<?php echo CommonUtility::getThemeUrl()?>/images/datu3.jpg);display:none;" id="banner3"> </div>
    <!--<div class="banner b4" style=" background-image:url(<?php echo CommonUtility::getThemeUrl()?>/iimages_2/banner_4.jpg);display:none;" id="banner4">
      <div class="main_c pr"> <a href="#" title="" class="start_btn">查看详情</a> </div>
    </div>
    -->
    <div class="banner_ctrl"> <a href="#" class="prev" title=""></a> <a href="javascript:;" class="next" title=""></a> </div>
  </div>

 <div class="clear"></div>
<!--
    <div class="container column1">
        <div class="Left">
            <div class="tbox border">
                
                <div class="middleTitle1" style="">
                    <h2>信用有价--申请借款</h2>
<!--               </div>
                <ul class="size">
                        <?php
				echo "手续简单，时效快，积累平台诚信";	 
                        ?>
                </ul>
            </div>
	</div>

        <div class="Middle">
            <div class="tbox border">
                
                <div class="middleTitle1">
                    <h2>理财有道--成功理财</h2>
<!--                </div>
                <ul class="size">
                        <?php
				echo "预期固定年收益8%-12%，产品自选，期限灵活";	 
                        ?>
                </ul>
            </div>
	</div>

        <div class="Right">
            <div class="tbox border">
                
                <div class="middleTitle1">
                    <h2>安全保障</h2>
<!--                </div>
                <ul class="size">
                        <?php
				echo "严格、科学、先进风控管理体系，风险保障金，真正做到投资零风险";	 
                        ?>
                </ul>
            </div>
	</div>
-->
   </div>
   <div class="index-basic">
	<div class="tr-row color1 ht1">
		<div class="tr-head"><img src="<?php echo CommonUtility::getThemeUrl()?>/images/logo03.jpg" style="height:90px; width:90px;margin-bottom:10px;"/></div>
		<div class="tr-h1"><span>申请借款</span></div>
		<div class="tr-content">
			<ul style="list-style-type:circle;"><li>手续简单</li><li>时效快</li><li>积累平台诚信</li></ul>
		</div>
	</div>
	<div class="tr-row color2 ht1">
                <div class="tr-head"><img src="<?php echo CommonUtility::getThemeUrl()?>/images/logo01.jpg" style="height:90px; width:90px;margin-bottom:10px;"/></div>
                <div class="tr-h1">投资理财</div>
                <div class="tr-content">
			<ul style="list-style-type:circle;"><li>预期固定年收益8%-12%</li><li>产品自选</li><li>期限灵活</li></ul>
			</div>
        </div>
	<div class="tr-row color3 ht1">
                <div class="tr-head"><img src="<?php echo CommonUtility::getThemeUrl()?>/images/logo02.jpg" style="height:90px; width:90px;margin-bottom:10px;"/></div>
                <div class="tr-h1">安全保障</div>
                <div class="tr-content">
			<ul style="list-style-type:circle;"><li>预期固定年收益8%-12%</li><li>产品自选</li><li>期限灵活</li><ul>
		</div>
        </div>
	
   </div>
   <div class="index-basic">
	<div class="tr-row ht2"><img src="<?php echo CommonUtility::getThemeUrl()?>/images/basic.jpg" style="height:160px; width:500px;margin-bottom:10px;" /></div>
	<div class="tr-row ht2"><div style="background-image:url(<?php echo CommonUtility::getThemeUrl()?>/images/xybutton.jpg);width:415px;height:130px;text-align:right;margin-left:50px;margin-top:20px;padding-top:106px; padding-right:50px;"><a href="/index.php?r=site/borrow" style="">查看详情</a></div></div>
   </div>
   <div class="clear"></div>
   <div class="index-basic">
	<div class="index-invest" style="background-image:url(<?php echo CommonUtility::getThemeUrl()?>/images/di1.jpg); height:200px;width:1200px;margin-left:-100px;">
		<div class="tr-h1 color1"><a href="/index.php?r=site/invest">米粒投</a></div>
		<div class="tr-content">根据自己的意愿和偏好自行投资，随时且直接的在线投给借款的每一个客户，让理财真正做到随时、随地，简单自由。<br> 年化率14%-20%，期限3-36个月自选</div>
		<div class="tr-h1 color1"><a href="/index.php?r=site/invest">定盈投</a></div>
		<div class="tr-content">根据沃米贷平台发出的计划和要求，理财用户申请加入后进行定向投资，确保资金安全，适用本金保障。<br> 年化率8%-12%，收益稳定</div>
	</div>
   </div>
























