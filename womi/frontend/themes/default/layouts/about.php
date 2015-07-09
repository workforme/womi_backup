<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\bootstrap\Collapse;
use yii\bootstrap\ButtonDropdown;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;
use yii\widgets\Menu;
/**
 * @var \yii\web\View $this
 * @var string $content
 */
AppAsset::register($this);
?>
<!-- 先引用main.php布局文件， -->
<?php $this->beginContent('@app/themes/default/layouts/main.php');?>

<div style="width:1000px; margin:0px auto;  min-height:420px; padding-top:20px; font-size:15px; text-align:left;">

<div style="float:left;width:200px;height:390px; font-size:15px; ">
<ul class="nav nav-pills nav-stacked">
   <li id="company"><a href="/index.php?r=site/about&about_id=company">公司介绍</a></li>
   <li id="team"><a href="/index.php?r=site/about&about_id=team">创业团队</a></li>
   <li id="partner"><a href="/index.php?r=site/about&about_id=partner">合作伙伴</a></li>
   <li id="recent"><a href="/index.php?r=site/about&about_id=recent">最新动态</a></li>
   <li id="join"><a href="/index.php?r=site/about&about_id=join">招贤纳士</a></li>
   <li id="contact"><a href="/index.php?r=site/about&about_id=contact">联系我们</a></li>
   <li id="contact"><a href="/index.php?r=site/about&about_id=protocol">合作协议</a></li>
</ul>
</div>

    <!--右侧详细页面这里展示-->
    <?= $content ?>
<div style="clear:both"></div>
<?php $this->endContent();?>



