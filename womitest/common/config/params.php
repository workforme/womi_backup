<?php
$params = [
    'appname' => '沃米贷',
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'microriches@163.com',
    'user.passwordResetTokenExpire' => 3600,
];
$params = array_merge(
		$params,
		require(__DIR__ . '/../../data/cache/cachedData.php')
);

return $params;
