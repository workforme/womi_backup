<?php

namespace frontend\models;
use yii\helpers\VarDumper;
use common\models\Invest;
use common\models\User;
use yii\base\Model;
use Yii;


/**
 * Loan form
 */
class FillInvestForm extends Model
{
    public $amount;
    public $phone;
    public $loan_rate;
    //public $invest_fee;
    public $wmstat;   
 
    public $loanid;
    public $bidder;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
    ['loanid',
    'bidder',
    'amount',
    'phone',
    'loan_rate',
    'wmstat'],'required'  ];
    }

    public function attributeLabels()
    {
        return [
    'loanid'=>'',
    'bidder'=>'',
    'amount'=>'',
    'phone'=>'',
    'loan_rate'=>'',
    'wmstat'=>''];
    }

    public function makeInvest()
    {
	Yii::info("####".VarDumper::dumpAsString($this->attributes));
        if ($this->validate()) {
            return Invest::create($this->attributes);
        }

        return -1;
    }
}

                                           
