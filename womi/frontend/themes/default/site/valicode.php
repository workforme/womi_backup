<?php

if(Yii::$app->request->isPost){
	
	$mail=$_POST['mail'];
	$rand=Yii::$app->getSecurity()->generateRandomKey(8);
	
	if(Yii::$app->cache->set($mail,$rand,70) && Yii::$app->mailer->compose()->setTo($mail)->setSubject('欢迎注册沃米贷')
	   ->setTextBody("尊敬的用户，\r  欢迎注册沃米贷，这是您的注册码 ".$rand."\r  请在2分钟内使用,注册码不要泄露给他人.")
           ->send())
	{
	    echo 'ok';
	}else{
	    echo 'error';
	}

}else{
	$mail=$_GET['mail'];
	$code=$_GET['code'];

	$val=Yii::$app->cache->get($mail);

	if($val!=NULL)
	{
	   if($val==$code){
		echo 'equal';
	   }else{
		echo 'unequal';
	   }
	}else{
		echo 'timeout';
	}

}
?>
