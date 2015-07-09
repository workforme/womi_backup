<?php

namespace common\models;

use yii;
use components\base\BaseActiveRecord;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\base\Model;
use yii\web\IdentityInterface;
use yii\helpers\VarDumper;



/**
 * Invest model
 *
 * @property integer $id
 * @property string $user_id
 * @property string $real_name
 * @property string $ident_card_id
 * @property string $phone
 * @property string $amount
 * @property string $invest_type
 */

class Invest extends BaseActiveRecord
{
    
    public function setUserId($userId)
    {
        $this->user_id = $userId;
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
        $this->real_name = $realName;
    }

    public function setIdentCardId($id)
    {
        $this->ident_card_id = $id;
    }

    public function setInvestType($type)
    {
        $this->invest_type = $type;
    }

    public static function tableName()
    {
        return 'invest';
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
                                                            'create_time'
                                                       ]
                                                    ]
                                 ]
               ];
    }

    public function attributeLabels()
    {
        return [
                   'user_id' => '用户ID',
                   'invest_type' => '理财类型',
                   'phone' => '电话',
                   'amount' => '金额',
                   'real_name' => '真实姓名',
                   'ident_card_id' => '身份验证号码',
               ];
    }


    public static function create($attributes)
    {
        $val=VarDumper::dumpAsString($attributes);
        Yii::info("input values:$val" ); 
       
        $invest = new static();
        $invest->setAttributes($attributes);

        //一定要通过set的方式对数据库字段赋值
        $invest->setUserId($attributes['user_id']);
        $invest->setRealName($attributes['real_name']);     
        $invest->setIdentCardId($attributes['ident_card_id']);
        $invest->setPhone($attributes['phone']);
        $invest->setAmount($attributes['amount']);
        $invest->setInvestType($attributes['invest_type']);
       
        if ($invest->save())
        {
	    VarDumper::dump($invest->getErrors());
            Yii::info("The investInfo is inserted of username: $invest->user_id");

            return $invest;
        }

	return null;
    }

    public function rules()
    {
        return [

		[['user_id', 'real_name', 'ident_card_id', 'phone', 'amount', 'invest_type'], 'required'],

		[['user_id', 'real_name', 'ident_card_id', 'phone', 'amount', 'invest_type'], 'safe'],
		
		//[['user_id', 'real_name', 'ident_card_id', 'phone', 'amount'], 'string', 'max'=>10, 'min'=>3,],
        ];
    }
}
