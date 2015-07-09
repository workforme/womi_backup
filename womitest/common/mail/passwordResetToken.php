<?php
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\User $user
 */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>

尊敬的<?= Html::encode($user->username) ?>,
<p>请点击下面的连接重置您的 沃米贷 登录密码</p>

<p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>

邮件为系统所发，请勿回复。
