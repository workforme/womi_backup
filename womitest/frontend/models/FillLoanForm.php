<?php

namespace frontend\models;
use yii\helpers\VarDumper;
use common\models\Loan;
use common\models\User;
use yii\base\Model;
use Yii;


/**
 * Loan form
 */
class FillLoanForm extends Model
{
    public $username;//全局identity获取
    public $realname;
    public $phone;
    public $loan_type;//贷款类型
    public $amount;
    public $loan_rate;
    public $fee;//自己计算,不在rule里要求传进
    public $fee_rate;
    public $bywho;//发起者类型,网站发起的都是散标
    public $desc;
    public $wmstat;
 
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
                [['loan_type', 'realname', 'phone', 'amount','loan_rate','fee_rate','desc'], 'required'],

                [['loan_type', 'realname', 'phone', 'amount','loan_rate','fee_rate','desc'], 'safe'],

       ];
    }

    public function attributeLabels()
    {
        return [
            'username' => '',
            'loan_type' => '',
            'realname' => '',
            'idcard' => '',
            'phone' => '',
            'amount' => '',
        ];
    }

    public function makeLoan()
    {
	$this->bywho='sanhu';//最好在验证前设置
	$this->fee=($this->amount)*($this->fee_rate);
	$this->username=Yii::$app->user->identity->username;
	$this->wmstat=0;
	//dump check ok
	//Yii::info("making loan: ".VarDumper::dumpAsString($this->attributes));
        $set=$this->attributes;
	if ($this->validate()) {
		unset($set['fee_rate']);//fee_rate是用户表的属性
            return Loan::create($this->attributes);
        }
        return -1;
    }


    public function getLoanInfoByUserId($userId)
    {
        $allLoanInfo = Loan::model()->findAll("username=:username", array(":username"=>$userId));
        return $allLoanInfo;
    }
}

