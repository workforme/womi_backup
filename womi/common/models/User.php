<?php

namespace common\models;

//use Yii;
use yii;
use yii\web\IdentityInterface;
use components\base\BaseActiveRecord;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;



/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $role
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends BaseActiveRecord implements IdentityInterface
{
	const STATUS_DELETED = 0;
	const STATUS_ACTIVE = 10;
	const ROLE_USER = 10;

	public static function tableName()
	{
		return 'user';
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
										'created_at',
										'updated_at' 
								],
								ActiveRecord::EVENT_BEFORE_UPDATE => [
										'updated_at' 
								],
						'value' => function($event) {
                    						$format = "Y/d/m"; // any format you wish
                    						return date($format); }
						 ] 
				] 
		];
	}

	public function attributeLabels()
	{
		return [
			'username' => '用户名',
			'password' => '密码',
		];
	}
	

	public static function create($attributes)
	{
		/**
		 *
		 * @var User $user
		 */
		$user = new static();
		unset($attributes['password2']);

		$user->setAttributes($attributes);
		$user->setPassword($attributes['password']);
		$user->generateAuthKey();
		if ($user->save())
		{ //Yii::info("You are in create User");
			return $user;
		}
		else
		{
			return null;
		}
	}
	
	/**
	 * @inheritdoc
	 */
	public static function findIdentity($id)
	{
		return static::findOne($id);
	}

	/**
	 * @inheritdoc
	 */
	public static function findIdentityByAccessToken($token, $type = NULL)
	{
		throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
	}

	/**
	 * Finds user by username
	 *
	 * @param string $username        	
	 * @return static null
	 */
	public static function findByUsername($username)
	{
		return static::findOne([
				'username' => $username,
				'status' => self::STATUS_ACTIVE 
		]);
	}

	/**
	 * Finds user by password reset token
	 *
	 * @param string $token
	 *        	password reset token
	 * @return static null
	 */
	public static function findByPasswordResetToken($token)
	{
		$expire = \Yii::$app->params['user.passwordResetTokenExpire'];
		$parts = explode('_', $token);
		$timestamp = ( int ) end($parts);
		
		Yii::info($token.$expire.$timestamp);
		if ($timestamp + $expire < time())
		{
			Yii::info("password token expire");
			// token expired
			return null;
		}
		
		return static::findOne([
				'password_reset_token' => $token,
				'status' => self::STATUS_ACTIVE 
		]);
	}

	/**
	 * @inheritdoc
	 */
	public function getId()
	{
		return $this->getPrimaryKey();
	}

	/**
	 * @inheritdoc
	 */
	public function getAuthKey()
	{
		return $this->auth_key;
	}

	/**
	 * @inheritdoc
	 */
	public function validateAuthKey($authKey)
	{
		return $this->getAuthKey() === $authKey;
	}

	/**
	 * Validates password
	 *
	 * @param string $password
	 *        	password to validate
	 * @return boolean if password provided is valid for current user
	 */
	public function validatePassword($password)
	{
		return Yii::$app->getSecurity()->validatePassword($password, $this->password_hash);
	}

	/**
	 * Generates password hash from password and sets it to the model
	 *
	 * @param string $password        	
	 */
	public function setPassword($password)
	{
		$this->password_hash = Yii::$app->getSecurity()->generatePasswordHash($password);
	}

	/**
	 * Generates "remember me" authentication key
	 */
	public function generateAuthKey()
	{
		$this->auth_key = Yii::$app->getSecurity()->generateRandomKey();
	}

	/**
	 * Generates new password reset token
	 */
	public function generatePasswordResetToken()
	{
		$this->password_reset_token = Yii::$app->getSecurity()->generateRandomKey() . '_' . time();
	}

	/**
	 * Removes password reset token
	 */
	public function removePasswordResetToken()
	{
		Yii::info("removePasswordResetToken");
		$this->password_reset_token = null;
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
				['intend','required'],
				[
						'status',
						'default',
						'value' => self::STATUS_ACTIVE 
				],
				[
						'status',
						'in',
						'range' => [
								self::STATUS_ACTIVE,
								self::STATUS_DELETED 
						] 
				],
				
				[
						'role',
						'default',
						'value' => self::ROLE_USER 
				],
				[
						'role',
						'in',
						'range' => [
								self::ROLE_USER 
						] 
				],
				
				[
						'username',
						'filter',
						'filter' => 'trim' 
				],
				[
						'username',
						'required' 
				],
				[
						'username',
						'unique' 
				],
				[
						'username',
						'string',
						'min' => 6,
						'max' => 20 
				],
				
				[
						'email',
						'filter',
						'filter' => 'trim' 
				],
				[
						'email',
						'required' 
				],
				[
						'email',
						'email' 
				],
				[
						'email',
						'unique' 
				] 
		];
	}
}
