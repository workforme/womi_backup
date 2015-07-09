<?php
namespace frontend\models;

use common\models\User;
use yii\base\Model;
use Yii;
use yii\helpers\VarDumper;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $mailcode;
    public $password;
   // public $password2;
    public $intend;//=2;
    public $agree;//=false;

    /**
     * @inheritdoc
     */
    public function rules()
    {
	//用户名和邮箱都要求唯一
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User'],
            ['username', 'string', 'min' => 6, 'max' => 20],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\common\models\User'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6,'max' => 10],
            
//	    ['password2', 'required'],
  //          ['password2', 'string', 'min' => 6,'max' => 10],
//	    ['password2','compare','compareAttribute'=>'password'],

            ['intend','required'],
            ['intend','in','range'=>['0','1']],

            //['agree','boolean'],
//            ['agree','required','requiredValue'=>true],
	];
    }

    public function attributeLabels()
    {
        return [
            'email' => '',
            'username' => '',
            'password' => '',
            'password2' => '',
	    'mailcode'=>'',
            'intend' => '',
            'agree' => '同意',
        ];
    }
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */

    public function signup()
    {

        if ($this->validate()) {
	    //$this->agree ?Yii::info("agree is true"):Yii::info("agree is false");
	    Yii::info("got validate err");
	    VarDumper::dump($this->attributes);
            return User::create($this->attributes);
        }

        return null;
    }
}
