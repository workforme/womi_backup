<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use frontend\models\LoanForm;
use common\models\Loan;
use common\models\User;
use frontend\models\FillInvestForm;
use yii\data\ActiveDataProvider;
use frontend\models\SignupForm;
use yii\helpers\VarDumper;

class InvestController extends Controller
{

public function actionList()
{
     $model = new Loan();
     $dataProvider = new ActiveDataProvider(
     [  //不限定发起者，但是要求是审核过且未完成的
        'query' => $model->findValid($_GET['type']), 
	'pagination' => ['pagesize'=>2,],
     ]);
      return $this->render('list', ['model' => $model, 'dataProvider' => $dataProvider]);
}

public function actionBidit(){
	if(!Yii::$app->user->isGuest)
        {
		$inv = new FillInvestForm();
		if($inv->load(Yii::$app->request->post())) {
        	Yii::info("xxxxxxxx".VarDumper::dumpAsString($inv->attributes));
			if($inv->makeInvest()){
                                Yii::wmsucc('发布失败，请重新选择类型并申请','/index.php?r=site/finance',2);
                        }else{
                                Yii::wmsucc('发布成功，请等待审核;您可以到个人中心跟踪申请状态','/index.php?r=site/center',2);
                        }
                }
        	Yii::info("yyyyy".VarDumper::dumpAsString($inv->attributes));
		$loan= Loan::findOne($_GET['loanid']);
        	Yii::info("zzzz".VarDumper::dumpAsString($inv->attributes));
		//return $this->render('bid',['loan' => $loan,'invest'=>$inv]);
		//return $this->render('bidit',['loan' => $loan,'invest'=>$inv]);
		$inv->bidder="aaaaaa";
		return $this->render('a',['model' => $inv]);
	}else{
             return $this->redirect("/index.php?r=site/login");
        }
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
                        'pagesize' => '1',
         ],
     ]);

      return $this->renderPartial('pj', ['model' => $model,'model2' => $model2, 'dataProvider' => $dataProvider]);
}

}
