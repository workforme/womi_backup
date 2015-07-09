<?php

namespace frontend\models;

use common\models\Invest;
use common\models\User;
use yii\base\Model;
use Yii;


/**
 * Loan form
 */
class InvestForm extends Model
{
    public $user_id;
    public $real_name;
    public $ident_card_id;
    public $phone;
    public $amount;
    public $invest_type;   
 
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
                [['invest_type', 'real_name', 'ident_card_id', 'phone', 'amount'], 'required'],

                [['invest_type', 'real_name', 'ident_card_id', 'phone', 'amount'], 'safe'],

//                [['real_name', 'ident_card_id', 'phone', 'amount'], 'string', 'max'=>10, 'min'=>3,],
//            ['user_id', 'required'],
//            ['user_id', 'unique', 'targetClass' => '\common\models\Loan'],
            
//            ['real_name', 'required'],
//            ['real_name', 'unique', 'targetClass' => '\common\models\Loan'],

//            ['ident_card_id', 'required'],
//            ['ident_card_id', 'unique', 'targetClass' => '\common\models\Loan'],

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
            'user_id' => '',
            'invest_type' => '',
            'real_name' => '',
            'ident_card_id' => '',
            'phone' => '',
            'amount' => '',
        ];
    }

    public function setUserId($userId)
    {
        $this->user_id = $userId;
    }

    /**
     * Invest Model.
     *
     * @return Invest|null the saved model or null if saving fails
     */

    public function invest($userId)
    {
        if ($this->validate()) {
            $this->setUserId($userId);
            return Invest::create($this->attributes);
        }

        return null;
    }
}

                                           
