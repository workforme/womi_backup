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

class Invest extends BaseActiveRecord
{
    public static function tableName()
    {
        return 'invest';
    }
    
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
    public function attributeLabels()
    {
        return [];
    }

*/

    public static function create($attributes)
    {
        $val=VarDumper::dumpAsString($attributes);
        Yii::info("input values:$val" ); 
       
        $loan = new static();
        $loan->setAttributes($attributes);
       
        if ($loan->save())
        {
	    //VarDumper::dump($loan->getErrors());

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


    public function rules()
    {
        return [
/*
		[['biduser',  'phone', 'amount' ], 'required'],

		[['biduser',  'phone', 'amount'], 'safe'],
*/		
        ];
    }
}
