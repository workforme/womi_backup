<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\LoanForm; //kang
use yii\data\Pagination;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var common\models\Loan $model
 */
    Yii::info("yesyesyo");
    if(! \Yii::$app->user->isGuest)
    {  Yii::info("nnnno");
        Yii::info("he is logged");
        //用户已登录

        $model = new LoanForm();
        if($model->load(Yii::$app->request->post())) {
            $var = Yii::$app->user->identity->username;
            $loanInfo = $model->getLoanInfoByUserId($var);

            $pagination = new Pagination([
                'defaultPageSize' => 5,
                'totalCount' => $loanInfo->count(),
            ]);

            $loanList = $loanInfo->orderBy('phone')
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();


            if($loanList)
            {
                echo 'success';
                return $this->render('myLoan', [
                    'loanList' => $loanList,
                    'pagination' => $pagination,
                ]);
            }else{
                echo 'failed';
            }
                    
        }else{
            echo 'noload';
        }

    }else{
        echo 'nologin';
    }
/*
    Yii::$app->user->setReturnUrl('/index.php?r=site/loan');
    Yii::info("he is a quest ,to login");
    return $this->redirect("/index.php?r=site/login");

    if(Yii::$app->request->isPost){

        $mail=$_POST['mail'];
        $rand=Yii::$app->getSecurity()->generateRandomKey(8);

        if(Yii::$app->cache->set($mail,$rand,70) && Yii::$app->mailer->compose()->setTo($mail)->setSubject('欢迎注册沃米贷')
           ->setTextBody("尊敬的用户，\r  欢迎注册沃米贷，这是您的注册码 ".$rand.".\r  请在2分钟内使用,注册码不要泄露给他人.")
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
*/

?>


