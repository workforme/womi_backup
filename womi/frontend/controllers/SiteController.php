<?php

namespace frontend\controllers;

use Yii;


use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use common\models\LoginForm;
use frontend\models\ContactForm;
use common\models\User;
use yii\web\BadRequestHttpException;
use yii\base\InvalidParamException;//yilong
use yii\base\Security;//yilong
use yii\widgets\ActiveForm;
use components\LuLu;
use frontend\base\BaseFrontController;
use frontend\models\SignupForm;
use frontend\models\LoanForm; //kang
use frontend\models\InvestForm; //kang
use common\includes\CommonUtility;

class SiteController extends BaseFrontController
{

	public function actionShow(){
		//return $this->renderPartial('show2');
		return $this->render('show2');
	}
	public function actionClose($message = null)
	{
		$this->layout = false;
		$this->setSeo();
		return $this->render('close');
	}
	public function actionTest()
	{
		return $this->render('test');
	}
	public function actionIndex()
	{
		$this->setSeo();
		$params = [];
		return $this->render('index_', $params);
	}

	public function actionLogin()
	{
		if(! \Yii::$app->user->isGuest)
		{
			//已登录
			return $this->goHome();
		}
		
		$model = new LoginForm();
		if($model->load($_POST)  && $model->login())
		{
			Yii::info("LOGIN,POST");
			//Yii::success("欢迎回来",'/',3);
			return $this->goBack();
		}
		else
		{
			return $this->render('login', ['model' => $model]);
		}
	}

	public function actionLogout()
	{
		Yii::$app->user->logout();
		return $this->goHome();
	}

	public function actionContact()
	{
		$model = new ContactForm();
		if($model->load($_POST) && $model->contact(Yii::$app->params['adminEmail']))
		{
			Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
			return $this->refresh();
		}
		else
		{
			return $this->render('contact', ['model' => $model]);
		}
	}

	public function actionMylogin(){
		$this->layout = false;
		return Yii::$app->request->csrfToken;
		#return $this->render('mylogin');
	}
	public function actionValicode(){
		
		$this->layout = false;
		Yii::info("render valicode");
		return $this->render('valicode');
	}
	public function actionAbout()
	{
	   if(isset($_GET['about_id']))
	   {
		switch($_GET['about_id'])
		{
			case "team":
			     $torend='aboutTeam';
			     break;
			case "company":
			     $torend='aboutCompany';
			     break;
			case "partner":
			     $torend='aboutPartner';
			     break;
			case "recent":
			     $torend='aboutRecent';
			     break;
			case "join":
			     $torend='aboutJoin';
			     break;
			case "contact":
			     $torend='aboutContact';
			     break;
			case "protocol":
			     $torend='aboutProtocol';
			     break;
			default:
			     $torend='aboutCompany';
		}
           }else{
		$torend='aboutCompany';
	   }
		$this->layout='about';
		return $this->render($torend);
	}

	//新手指引界面	
	public function actionGuide(){
		return $this->render('userGuide');
	}

	public function actionGuideLoan(){
		$this->layout = false;
		return $this->render('userGuideLoan');
	}

	public function actionGuideInvest(){
		$this->layout = false;
		return $this->render('userGuideInvest');	
	}

	public function actionGuideSecure(){
		$this->layout = false;
		return $this->render('userGuideSecure');	
	}
	
	//贷款借款界面
        public function actionLoan(){

		Yii::info("some one is to apply aloan");
		if(! \Yii::$app->user->isGuest)
		{
		     Yii::info("he is logged");
		     //用户已登录
		     //$this->layout = false;
		    // return $this->render('Loan');;                //by kang
                     $model = new LoanForm();
		     if($model->load(Yii::$app->request->post())) {
                         $var = Yii::$app->user->identity->username;
                         $loanInfo = $model->loan($var);
                         Yii::info("The username is:$var");

                         if($loanInfo)
                         {
                             return $this->render('loanConfirm', ['model' => $model]);
                         }else{
                             return $this->render('Loan', ['model' => $model]);
                         }
                     }else{
                         return $this->render('Loan', ['model' => $model]);
                     }
		}
		
		Yii::$app->user->setReturnUrl('/index.php?r=site/loan');
		Yii::info("he is a quest ,to login");
		return $this->redirect("/index.php?r=site/login");
        }

	public function actionInvest(){
		Yii::info("some one is to apply ainvest");
		if(! \Yii::$app->user->isGuest)
		{
		     Yii::info("he is logged");
		     //用户已登录
		     //$this->layout = false;
		     //return $this->render('Invest');;
                     $model = new InvestForm();
                     if($model->load(Yii::$app->request->post())) {
                         $var = Yii::$app->user->identity->username;
                         $investInfo = $model->invest($var);
                         Yii::info("The username is:$var");

                         if($investInfo)
                         {
                             return $this->render('investConfirm', ['model' => $model]);
                         }else{
                             return $this->render('Invest', ['model' => $model]);
                         }
                     }else{
                         return $this->render('Invest', ['model' => $model]);
                     }
		}
		Yii::$app->user->setReturnUrl('/index.php?r=site/invest');
		Yii::info("he is a quest ,to login");
		return $this->redirect("/index.php?r=site/login");
        }

        //用户中心
	public function actionCenter()
	{
		if(! \Yii::$app->user->isGuest)
		{
		     //用户已登录
		     //$this->layout = false;
		     return $this->render('userCenter');
		}
		Yii::$app->user->setReturnUrl('/index.php?r=site/center');
		return $this->redirect("/index.php?r=site/login");
	}
	//借贷管理
        public function actionCenterLoan()
        {
		$this->layout = false;
		return $this->render('userCenterLoan');
        }
        
        public function actionCenterInvest()
        {
		$this->layout = false;
		return $this->render('userCenterInvest');
	}
        
	public function actionSignup()
	{
		$model = new SignupForm();

		//if (isset($_POST['ajax']) && $_POST['ajax'] === 'form-signup')
		//{
			/*Yii::info("ajax validate");
			//$model->scenario='sign-ajax';
			$model->validate($model,['username']);
			$this->layout=null;
			return $model->getErrors();

			if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
			
			Yii::info("ajax validate");
                        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                        return ActiveForm::validate($model,['username']);
                }
		//}
			*/
		if($model->load(Yii::$app->request->post()))
		{
			Yii::info("got post signup");
			$user = $model->signup();
			if($user)
			{
				if(Yii::$app->getUser()->login($user))
				{
					return $this->goHome();
				}
			}else{
				
			Yii::info("got no user");
			}
		}
			Yii::info("got render signup");
		return $this->render('signup', ['model' => $model]);
	}

	public function actionRequestPasswordReset()
	{
		$model=new PasswordResetRequestForm();
		if($model->load($_POST) && $model->validate())
		{
			if($model->sendEmail())
			{
				Yii::$app->getSession()->setFlash('reset-req-result', '密码重置邮件已发送到您的邮箱，请查收.如有多封邮件，请以最新的为准. ');
				return $this->refresh();
			}
			else
			{
				Yii::$app->getSession()->setFlash('reset-req-result', '发送重置邮件失败，请稍后重试.');
				return $this->refresh();
			}
		}
		return $this->render('requestPasswordResetToken', ['model' => $model]);
	}

	public function actionResetPassword($token)
	
	{
		/*
		$model = User::find()->where(['password_reset_token' => $token, 'status' => User::STATUS_ACTIVE])->one();
		
		if(! $model)
		{
			throw new BadRequestHttpException('Wrong password reset token.');
		}
		
		$model->scenario = 'resetPassword';
		if($model->load($_POST) && $model->save())
		{
			Yii::$app->getSession()->setFlash('success', 'New password was saved.');
			return $this->goHome();
		}
		
		return $this->render('resetPassword', ['model' => $model]);*/
		
		try
                {
                        $model = new ResetPasswordForm($token);
                }
                catch (InvalidParamException $e)
                {
                        throw new BadRequestHttpException($e->getMessage());
			//return $e->getMessage();
                }

                if ($model->load(Yii::$app->request->post()) && $model->validate() &&
                                 $model->resetPassword())
                {
                        Yii::$app->getSession()->setFlash('success',
                                        'New password was saved.');

                        return $this->goHome();
                }

                return $this->render('resetPassword',['model' => $model]);
	}

	private function sendPasswordResetEmail($email)
	{
		$user = User::find()->where(['status' => User::STATUS_ACTIVE, 'email' => $email])->one();
		//Yii::info(var_dump($user));
		//Yii::info("reset token username is ".$user->username);
		if(!$user)
		{
			return false;
		}

		Yii::info("reset token is ".Security::generateRandomKey());

		$user->password_reset_token = Security::generateRandomKey();
		if($user->save())
		{
			return \Yii::$app->mailer->compose('passwordResetToken', ['user' => $user])
					 ->setSubject('Password reset for ')
					 ->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->params['appname']])
					 ->setTo($email)
					 ->setSubject('登录密码重置')
					 ->send();
		}
		
		return false;
	}
	
	/*借贷理财引导页*/
	public function actionBorrow()
	{
		return $this->render('borrow');
	}
	public function actionFinance()
        {
                return $this->render('finance');
        }	

	private function setSeo()
	{
		$view = LuLu::getView();
		
		$title = CommonUtility::getCachedConfigValue('seo_title');
		if(empty($title))
		{
			$title = '首页——' . CommonUtility::getCachedConfigValue('seo_name');
		}
		$view->setTitle($title);
		$view->registerMetaTag(['name' => 'keywords', 'content' => CommonUtility::getCachedConfigValue('seo_keywords')]);
		$view->registerMetaTag(['name' => 'description', 'content' => CommonUtility::getCachedConfigValue('seo_description')]);
	}
	public function actionError()
	{
	    if (\Yii::$app->exception !== null) {
	        return $this->render('error', ['exception' => \Yii::$app->exception]);
	    }
	}
}
