<?php

namespace common\models;

use yii;
use components\base\BaseActiveRecord;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\base\Model;
use yii\web\IdentityInterface;
use yii\helpers\VarDumper;

use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

/**
 * Loan model
 *
 * @property integer $id
 * @property string $username
 * @property string $realname
 * @property string $idcard
 * @property string $phone
 * @property string $amount
 * @property string $loan_type
 */

class Loan extends BaseActiveRecord
{
    
    public function setUserId($userId)
    {
        $this->username = $userId;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }
 
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    public function setRealName($realName)
    {
        $this->realname = $realName;
    }

    public function setIdentCardId($id)
    {
        $this->idcard = $id;
    }

    public function setLoanType($loan_type)
    {
        $this->loan_type = $loan_type;
    }

    public static function tableName()
    {
        return 'loan';
    }
    
    /**
     * @inheritdoc
    */
    public function behaviors()
    {
        return [
                  'timestamp' => [
                                    'class' => 'yii\behaviors\TimestampBehavior',
                                    'attributes' => [
                                                        ActiveRecord::EVENT_BEFORE_INSERT => [
                                                            'created_at','updated_at'
                                                        ],
							ActiveRecord::EVENT_BEFORE_UPDATE => [
                                                            'updated_at'
                                                        ]
                                                    ],
		//		     'value' => new Expression('NOW()'),
'value' => function($event) {
                    $format = "Y-m-d H:i:s"; // any format you wish
                    return date($format); 
                }
                                 ]
               ];
    }
/*
public function behaviors()
{
    return [
        [
            'class' => TimestampBehavior::className(),
            'createdAtAttribute' => 'ctime',
            'value' => new Expression('NOW()'),
        ],
    ];
}
*/
    public function attributeLabels()
    {
        return [
                   'username' => '用户ID',
                   'loan_type' => '贷款类型',
                   'phone' => '电话',
                   'amount' => '贷款金额',
                   'realname' => '真实姓名',
                   'idcard' => '身份证号',
               ];
    }


    public static function create($attributes)
    {
        $val=VarDumper::dumpAsString($attributes);
        Yii::info("input values:$val" ); 
       
        $loan = new static();
        $loan->setAttributes($attributes);

        //一定要通过set的方式对数据库字段赋值
        $loan->setUserId($attributes['username']);
        $loan->setRealName($attributes['realname']);     
        $loan->setIdentCardId($attributes['idcard']);
        $loan->setPhone($attributes['phone']);
        $loan->setAmount($attributes['amount']);
        $loan->setLoanType($attributes['loan_type']);
       
        if ($loan->save())
        {
	    VarDumper::dump($loan->getErrors());
            Yii::info("The loanInfo is inserted of username: $loan->username");

            return $loan;
        }

	return null;
    }

    public function rules()
    {
        return [

		[['username', 'realname', 'idcard', 'phone', 'amount', 'loan_type'], 'required'],

		[['username', 'realname', 'idcard', 'phone', 'amount', 'loan_type'], 'safe'],
		
		//[['username', 'realname', 'idcard', 'phone', 'amount'], 'string', 'max'=>10, 'min'=>3,],
        ];
    }
}
