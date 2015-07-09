<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use frontend\models\LoanForm;
use common\models\Loan;
use yii\data\ActiveDataProvider;


class LoanController extends Controller
{
/*    public function actionList()
    {
        $query = Loan::find();

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        $loans = $query->orderBy('updated_at')
           ->offset($pagination->offset)
           ->limit($pagination->limit)
           ->all();

        return $this->render('index', [
             'loans' => $loans,
             'pagination' => $pagination,
        ]);
    }
*/
public function actionList()
{
     $model = new Loan();
     $dataProvider = new ActiveDataProvider([
        'query' => $model->find(),
        'pagination' => [
                	'pagesize' => '10',
         ],
     ]);

      return $this->render('list', ['model' => $model, 'dataProvider' => $dataProvider]);
}







}
