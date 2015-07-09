<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use components\widgets\Alert;
use frontend\assets\ThemeAsset;

/**
 * @var \yii\web\View $this
 * @var string $content
 */
AppAsset::register($this);
ThemeAsset::register($this);

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
				'brandLabel' => 'LuLu CMS',
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
		<?= $content ?>
		</div>
	</div>
	<footer class="footer">
		<div class="container">
		<p class="pull-left">&copy; My Company <?= date('Y') ?></p>
		<p class="pull-right"><?= Yii::powered() ?></p>
		</div>
	</footer>

	<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
