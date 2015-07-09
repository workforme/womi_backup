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
   <div class="borrow-h" >沃米贷理财产品介绍</div>
   <div class="index-basic">
        <div class="tr-row border ht1">
                <div class="tr-h1 color1"><span>米粒投</span></div>
                <div class="tr-content">
        
                        <ul style="list-style-type:circle;">
                                <li>1、根据自己的意愿和偏好自行投资，随时且直接的在线投给借款的每一个客户，让理财真正做到随时、随地，简单自由 </li>
                                <li>2、年化率14%-20%</li>
				<li>3、期限3-36个月自选</li>
                        </ul>
                </div>
                <div class="tr-button">
                        <a href="/index.php?r=site/invest"><input class="b-button" type="button" value="去申请" /></a>
                </div>
        </div>
        <div class="tr-row border ht1">
                <div class="tr-h1 color2">定盈投</div>
                <div class="tr-content">
                       
                        <ul style="list-style-type:circle;">
                                <li>1、根据沃米贷平台发出的计划和要求，理财用户申请加入后进行定向投资，确保资金安全，适用本金保障</li>
                                <li>2、年化率8%-12%</li>
                                <li>3、收益稳定</li>
                        </ul>
                </div>
                <div class="tr-button">
                       <a href="/index.php?r=site/invest"><input class="b-button" type="button" value="去申请" /></a>
                </div>
        </div>
   </div>
</div>
