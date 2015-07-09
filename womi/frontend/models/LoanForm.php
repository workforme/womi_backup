<?php

namespace frontend\models;

use common\models\Loan;
use common\models\User;
use yii\base\Model;
use Yii;


/**
 * Loan form
 */
class LoanForm extends Model
{
    public $username;
    public $realname;
    public $idcard;
    public $phone;
    public $amount;
    public $loan_type;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
                [['loan_type', 'realname', 'idcard', 'phone', 'amount'], 'required'],

                [['loan_type', 'realname', 'idcard', 'phone', 'amount'], 'safe'],

//                [['realname', 'idcard', 'phone', 'amount'], 'string', 'max'=>10, 'min'=>3,],
//            ['username', 'required'],
//            ['username', 'unique', 'targetClass' => '\common\models\Loan'],
            
//            ['realname', 'required'],
//            ['realname', 'unique', 'targetClass' => '\common\models\Loan'],

//            ['idcard', 'required'],
//            ['idcard', 'unique', 'targetClass' => '\common\models\Loan'],

//            ['phone', 'required'],
//            ['phone', 'phone'],
//            ['phone', 'unique', 'targetClass' => '\common\models\Loan'],

//            ['amount', 'required'],
//            ['amount', 'amount'],
//            ['amount', 'unique',  'targetClass' => '\common\models\Loan'],
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


    public function setUserId($userId)
    {
        $this->username = $userId;
    }

    /**
     * User loan.
     *
     * @return Loan|null the saved model or null if saving fails
     */

    public function loan($userId)
    {
        if ($this->validate()) {
            $this->setUserId($userId);
            return Loan::create($this->attributes);
        }

        return null;
    }


    public function getLoanInfoByUserId($userId)
    {
        $allLoanInfo = Loan::model()->findAll("username=:username", array(":username"=>$userId));
        return $allLoanInfo;
    }
}

                                                               
