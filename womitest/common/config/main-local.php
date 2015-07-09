<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
	    'emulatePrepare'=>true,
            'dsn' => 'mysql:host=rdsaimerbmjvezy.mysql.rds.aliyuncs.com;dbname=womi_test',
            'username' => 'womi_rw',
            'password' => 'womi_rw',
            'charset' => 'utf8',
		
        ],
       /* 'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],*/
    ],
];
