<?php


return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
	'request'=>[
'cookieValidationKey' => '83r5HbITBiMfmiYPOZFdL-raVp4O1VV4',
    		'enableCsrfValidation'=>true,
		'enableCookieValidation' => false,
    	],
        //'Fcache' => [
	//	   'class' => 'yii\caching\FileCache',
	//],
	'cache'=>[
		   'class' => 'yii\caching\MemCache',
            	   'servers' => [
			[
                  		'host' => 'localhost',
                  		'port' => 11211,
		    	],
		    ],
        ],
	
	'mailer'=>[
		'class' => 'yii\swiftmailer\Mailer',
		'viewPath' => '@common/mail',
        	//'useFileTransport' => false,

		'transport' => [  
                            'class' => 'Swift_SmtpTransport',  
                            'host' => 'smtp.163.com',  
                            'username' => 'microriches',  
                            'password' => 'z*8933920',  
                            'port' => '25',
                            //'encryption' => 'ssl',
                            //'encryption' => 'tls',
			    //'logging'=>true, 
                           ],   
           	'messageConfig'=>[  
               		'charset'=>'UTF-8',  
               		'from'=>['microriches@163.com'=>'沃米贷']  
               	],  

	],

  	'assetManager' => [
		'basePath' => '@webroot/static/assets',
		'baseUrl'=>'@web/static/assets',
      		'bundles' => [
          	// you can override AssetBundle configs here
      		],
	],
      	//'linkAssets' => true,
      	'session'=>[
		'class'=>'yii\web\Session',
		'timeout'=>5,
		//'savepath'=>'@web/'
	],
  
    ],
];
