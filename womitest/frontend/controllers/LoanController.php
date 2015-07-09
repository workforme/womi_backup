<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use common\models\Loan;
use common\models\User;
use yii\data\ActiveDataProvider;
use frontend\models\SignupForm;
use frontend\models\FillLoanForm;

class LoanController extends Controller
{

        //贷款借款界面
        public function actionApply(){

                Yii::info("some one is to apply aloan");
                if(! \Yii::$app->user->isGuest)
                {

                     $who=Yii::$app->user->identity->username;
                     $user= User::findByUsername($who);
                     if(($user->wmstat>>1)&1!=1){
                        //资料未审核通过
                        return Yii::wmsucc('资料谁审核尚未通过，请耐心等待','index.php?r=site/userdetail"',3);
                     }

                     $model = new FillLoanForm();
                     if($model->load(Yii::$app->request->post())) {
			if($model->validate()){
                            if($model->makeLoan()){
                                Yii::wmsucc('发布失败，请重新选择类型并申请','/index.php?r=site/borrow',2);
                            }else{
                                Yii::wmsucc('发布成功，请等待审核;您可以到个人中心跟踪申请状态','/index.php?r=site/center',2);
                            }
                        }
		     }
                     return $this->render('filloan', ['model' => $model,'user'=>$user]);
                }else{
                        return $this->redirect("/index.php?r=site/login");
                }
        }


public function actionList()
{
     if(Yii::$app->user->isGuest){
	return $this->redirect("/index.php?r=site/login");
     }

     $model = new Loan();
     $who=Yii::$app->user->identity->username;;
     $dataProvider = new ActiveDataProvider([
        'query' => $model->find(['username' => $who]),
        'pagination' => [
                	'pagesize' => '10',
         ],
     ]);

      return $this->renderPartial('list', ['model' => $model, 'dataProvider' => $dataProvider]);
}

public function actionDelete(){

	$ln=Loan::findOne($_GET['loanid']);
	$ln->wmstat=($ln->wmstat|2);
	$ln->update();

	
//	if (Yii::$app->getRequest()->isAjax) {
	$model = new Loan();
	$who=Yii::$app->user->identity->username;
        $dataProvider = new ActiveDataProvider([
            'query' => $model->find(['username' => $who]),
        ]);
        return $this->renderPartial('list', ['model' => $model, 'dataProvider' => $dataProvider ]);
  //  }
	
}
public function actionPj()
{
	
     $model = new User();
     $model2 = new SignupForm();
    if($model2->load(Yii::$app->request->post()))
     {
                        Yii::info("got post signup");
                        $model2->signup();
     }

     $dataProvider = new ActiveDataProvider([
        'query' => $model->find(),
        'pagination' => [
                        'pagesize' => '10',
         ],
     ]);

      return $this->renderPartial('pj', ['model' => $model,'model2' => $model2, 'dataProvider' => $dataProvider]);
}

}
