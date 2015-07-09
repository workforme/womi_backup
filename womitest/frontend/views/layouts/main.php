<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use components\widgets\Alert;

/**
 * @var \yii\web\View $this
 * @var string $content
 */
AppAsset::register($this);
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
		<?php
			NavBar::begin([
				'brandLabel' => '微睿首页',
				'brandUrl' => Yii::$app->homeUrl,
				'options' => [
					'class' => 'navbar-inverse navbar-fixed-top',
				],
			]);
			$menuItems = [
				['label' => '首页', 'url' => ['/site/index']],
				['label' => '关于', 'url' => ['/site/about']],
				['label' => '联系', 'url' => ['/site/contact']],
			];
			if (Yii::$app->user->isGuest) {
				$menuItems[] = ['label' => '注册', 'url' => ['/site/signup']];
				$menuItems[] = ['label' => '登录', 'url' => ['/site/login']];
			} else {
				$menuItems[] = ['label' => '退出 (' . Yii::$app->user->identity->username .')' , 'url' => ['/site/logout']];
			}
			echo Nav::widget([
				'options' => ['class' => 'navbar-nav navbar-right'],
				'items' => $menuItems,
			]);
			NavBar::end();
		?>
		<!-- Channels -->
		<div class="container">
			<div class="mainchannel">
				<ul>
					<li><a href="index.php">首页</a></li>
					<?php 
					//rootChannelList
					//channelTree
					
						foreach ($this->params['rootChannelList'] as $channel)
						{
							if($channel['is_leaf'])
							{
								echo '<li><a href="index.php?r=content/list&chnid='.$channel['id'].'"><font color="red">'.$channel['name'].'</font></a></li>';
							}
							else
							{
								echo '<li><a href="index.php?r=content/channel&chnid='.$channel['id'].'">'.$channel['name'].'</a></li>';
							}
						}
					?>
				</ul>
			</div>
		</div>
		<div class="clear"></div>
		<div class="container">
		<?= Breadcrumbs::widget([
			'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
		]) ?>
		<?= Alert::widget() ?>
		<?= $content ?>
		</div>
	</div>

	<footer class="footer">
	<!--?php echo "aaaaaaaaaaaaaaaaaaaa"?-->
	</footer>

	<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
