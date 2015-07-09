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
/*
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
*/
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
	//CHECK VALUES OK
        //Yii::info("input values:".VarDumper::dumpAsString($attributes)); 
        $loan = new static();
        $loan->setAttributes($attributes);
        if ($loan->save())
        {
	    //VarDumper::dump($loan->getErrors());
            //Yii::info("The loanInfo is inserted of username: $loan->username");
            return 0;
        }
	return -1;
    }

public function findByUsername($who)
{
        return static::find([
                        'username' => $who,
        ]);	
	
}

public function findValid($type=null)
{
	//查找有效可投标贷款，wmstat&1=1此贷款审核过，(wmstat>>1)&1=0未撤销
	if($type==null){
        	return static::findBySql("select * from loan where wmstat&1=1 and (wmstat>>1)&1=0");
        }else{
        	return static::findBySql("select * from loan where wmstat&1=1 and (wmstat>>1)&1=0 and bywho="."'".$type."'");
	}
}

    //safe是对应数据库属性的二次门槛
    public function rules()
    {
        return [

	[['username', 'realname', 'phone', 'amount', 'loan_type','loan_rate','fee','bywho','desc','wmstat'], 'required'],
	[['username', 'realname', 'phone', 'amount', 'loan_type','loan_rate','fee','bywho','desc','wmstat'], 'safe'],
		
        ];
    }
}
