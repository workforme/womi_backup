<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use components\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use components\widgets\Alert;
use frontend\assets\ThemeAsset;
use yii\helpers\Url;
use common\includes\CommonUtility;

/**
 * @var \yii\web\View $this
 * @var string $content
 */

ThemeAsset::register($this);
//$this->registerJsFile(CommonUtility::getThemeUrl('js_2/about.js'),['yii\web\JqueryAsset']);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<meta charset="<?= Yii::$app->charset ?>"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>
</head>
<body>
	<?php $this->beginBody() ?>
	<div class="wrap">
		<div class="wowcontainer border" id="topbar">
			<div class="floatRight">
				<ul>
				<?php 
					if (Yii::$app->user->isGuest) {
					echo "<li>".Html::a('注册沃米',['/site/signup'])."</li>";
					echo "<li>".Html::a('立即登录',['/site/login'])."</li>";
					} else {
					echo "<li _t_uc='any' id='hasLoginUp'>".Html::a(Yii::$app->user->identity->username .'[退出]',['/site/logout'],['id'=>'alreadylogin'])."</li>";
					//echo "<li _t_uc='any' id='hasLoginDown' style='display:none;' >".Html::a('个人中心',['/site/center'])."</li>";
					}
					//echo "<li>".Html::a('客服中心',['#'])."</li>";
				//	echo "<li class="dropdown"><a class="dropdown-toggle" href="/index.php?r=upgrade" data-toggle="dropdown">xxxxxx<b class="caret"></b></a><ul id="w2" class="dropdown-menu"><li><a href="/index.php?r=site/about&amp;about_id=company" tabindex="-1">公司介绍</a></li><li><a href="/index.php?r=site/about&amp;about_id=team" tabindex="-1">团队成员</a></li></ul></li>";

				        echo "<li>".Html::a('为了快速良好的用户体验,建议您使用Google Chrome浏览器','http://rj.baidu.com/soft/detail/14744.html?ald')."</li>";
			?>
					<li style="margin-left:100px; position:absolute; font-size:16px; color:white;" >客服中心 021-61128771</li>
				</ul>
			</div>		
		</div>
	<div class="clear"></div>

	<div class="headcontainer navContainer" id="header">
        <?php
            NavBar::begin([
                'brandLabel' => '<img src="' .  CommonUtility::getThemeUrl() . 'images/wow-logo2.jpg" border="0" height="50px" width="350px"/>',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    //'class' => 'navbar-inverse navbar-fixed-top',
                    'class' => 'nav',
                ],
            ]);
            $menuItems = [
                ['label' => '首页', 'url' => ['/site/index']],
                ['label' => '我要贷款', 'url' => ['/site/borrow']],
                ['label' => '我要理财', 'url' => ['/site/finance']],
                ['label' => '新手指引', 'url' => ['/site/guide']],
            ];
       /*     if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => '注册', 'url' => ['/site/signup']];
                $menuItems[] = ['label' => '登录', 'url' => ['/site/login']];
            } else {
                $menuItems[] = [
                    'label' => '退出 (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }*/

            //$menuItems[] = [ 'label' => '测试关于','url'   => ['/site/about']];
            $menuItems[] = [ 'label' => '用户中心','url'   => ['/site/center']];
            $menuItems[] = [ 'label' => '关于我们','url'   => ['/upgrade/'],
                             'items' => [
                                                ['label' => '公司介绍', 'url' => '/index.php?r=site/about&about_id=company', 'active' => false],
                                                ['label' => '团队成员', 'url' => '/index.php?r=site/about&about_id=team', 'active' => false,'style'=>'width:30px'],
                                        ],
                           ];
            echo Nav::widget([
                //'options' => ['class' => 'navbar-nav navbar-right'],
                'options' => ['class' => 'navbar-nav'],
                'items' => $menuItems,
            ]);
            NavBar::end();
?>

</div>
		<div class="clear"></div>
		<div class="containerbody">
			<?= $content ?>
		</div>
	</div>
<!--	<div class="clear"></div>-->
	<footer class="footer" id="footer">
	    <div class="container">
		<p class="pull-left"><a href="/index.php?r=site/about&about_id=company">公司介绍</a></p>
		<p class=""><a href="/index.php?r=site/about&about_id=company">社会责任</a></p>
		 <p class=""><a href="/index.php?r=site/about&about_id=contact">联系我们</a></p>
		 <p class=""><a href="/index.php?r=site/about&about_id=join">招贤纳士</a></p>
	    </div>
	    <div class="info">
                <p class="line-r">&copy; 沃米贷 <?= date('Y') ?></p>
                <p class="line-r">上海沃街信息咨询有限公司</p>
                 <p class="">沪ICP备14040607号-2</p>
            </div>
	</footer>

	<?php echo CommonUtility::getCachedConfigValue('site_stats');?>
	<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
