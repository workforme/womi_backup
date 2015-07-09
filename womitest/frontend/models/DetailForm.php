<?php
namespace frontend\models;

use common\models\User;
use yii\base\Model;
use Yii;
use yii\helpers\VarDumper;
use yii\web\UploadedFile;
/**
 * Signup form
 */
class DetailForm extends Model
{
    /*public $id
    public $username
    public $auth_key
    public $password_hash
    public $password_reset_token
    public $intend
    public $email
    public $role
    public $status
    public $created_at
    public $updated_at
*/
    public $realname;
    public $education;
    public $phone;
    public $idcard_num;
    //public $work_city;
    public $com_name;
    public $industry;
    public $work_year;
    public $com_addr;
    public $com_phone;
    public $com_mail;
    public $marry;
    public $children;
    public $house_addr;
    public $bka_name;
    public $bka_phone;
    public $bka_relation;
    public $bkb_name;
    public $bkb_phone;
    public $bkb_relation;
    public $has_house;
    public $house_loan;
    public $has_car;
    public $car_loan;
    public $car_name;
    public $car_buytime;
   
 
    public $idcard_front;
    public $idcard_back;
    public $idcard_self;

    public $zhizhao;
    public $zhizhao_copy;

    public $hetong;
    public $shuidian;
    public $liushui;
    public $zhengxin;
    
    public $xingshi;
    public $fangchan;
    public $zhicheng;

   public function rules()
    {
        return [

        ['realname','required'],
        ['education','required'],
        ['phone','required'],
        ['idcard_num','required'],
       // ['work_city','required'],
        ['com_name','required'],
        ['industry','required'],
        ['work_year','required'],
        ['com_addr','required'],
        ['com_phone','required'],
        ['com_mail','required'],
        ['marry','required'],
        ['children','required'],
        ['house_addr','required'],
        ['bka_name','required'],
        ['bka_phone','required'],
        ['bka_relation','required'],
        ['bkb_name','required'],
        ['bkb_phone','required'],
        ['bkb_relation','required'],
        ['has_house','required'],
        ['house_loan','required'],
        ['has_car','required'],
        ['car_loan','required'],
        ['car_name','required'],
        ['car_buytime','required'],
        
        
        ['idcard_front','file',/*'skipOnEmpty' => false,*/'extensions' => 'gif,jpg,jpeg,bmp,png','wrongExtension'=>'只能上传{extensions}类型文件','maxSize'=>1024*50,'tooBig'=>'文件过大亲'],
         ['idcard_back','file','extensions' => 'gif,jpg,jpeg,bmp,png','maxSize'=>1024*5],
         ['idcard_self','file','extensions' => 'gif,jpg,jpeg,bmp,png','maxSize'=>1024*5],
        
             ['zhizhao','file','extensions' => 'gif,jpg,jpeg,bmp,png','maxSize'=>1024*5],
        ['zhizhao_copy','file','extensions' => 'gif,jpg,jpeg,bmp,png','maxSize'=>1024*5],
        
              ['hetong','file','extensions' => 'gif,jpg,jpeg,bmp,png','maxSize'=>1024*5],
           ['shuidian','file','extensions' => 'gif,jpg,jpeg,bmp,png','maxSize'=>1024*5],
            ['liushui','file','extensions' => 'gif,jpg,jpeg,bmp,png','maxSize'=>1024*5],
           ['zhengxin','file','extensions' => 'gif,jpg,jpeg,bmp,png','maxSize'=>1024*5],
       //剩余的。行驶证房产证和职称证明不是必须 
        ];
    }

    public function scenarios()
    {
        return [
//更新时不在检查图片资料，如果有就覆盖，没有就略过
            //'update' => ['realname','education','phone','idcard_num','com_name','industry','work_year','com_addr','com_phone','com_mail','marry','children','house_addr','bka_name','bka_phone','bka_relation','bkb_name','bkb_phone','bkb_relation','has_house','house_loan','has_car','car_loan','car_name','car_buytime'],
            'update' => ['realname','education','phone','idcard_num','com_name','industry','work_year','com_addr','com_phone','com_mail','marry','children','house_addr','bka_name','bka_phone','bka_relation','bkb_name','bkb_phone','bkb_relation','has_house','house_loan','has_car','car_loan','car_name','car_buytime','idcard_front','idcard_back','idcard_self','zhizhao','zhizhao_copy','hetong','shuidian'],
//创建时必须要求有必须的图片文件
            'create' => ['realname','education','phone','idcard_num','com_name','industry','work_year','com_addr','com_phone','com_mail','marry','children','house_addr','bka_name','bka_phone','bka_relation','bkb_name','bkb_phone','bkb_relation','has_house','house_loan','has_car','car_loan','car_name','car_buytime','idcard_front','idcard_back','idcard_self','zhizhao','zhizhao_copy','hetong','shuidian'],
        ];
    }
    /*public function attributeLabels()
    {
        return [
        ];
    }*/

    public function cloneUser($user){
		$files=['idcard_front','idcard_back','idcard_self','zhizhao','zhizhao_copy','hetong',
			'shuidian','liushui','zhengxin','xingshi','fangchan','zhicheng'];
		$set=$this->attributes;
                foreach($files as $file){
                       unset($set[$file]);
                }
		foreach($set as $attr=>$val){
                        $this->$attr=$user->$attr;
                }
    }
    public function setDetail($sc)
    {
	if($sc=='update'){
		$this->scenario='update';
		Yii::info("wwwqqq");
	}
	if($sc=='create'){
		$this->scenario='create';
	}	
	if($this->validate()){
		//Yii::info("DEBUG".$this->idcard_front);//此时属性尚空
		$who=Yii::$app->user->identity->username;
		$usr= User::findByUsername($who);
		$files=array(0=>'idcard_front',1=>'idcard_back',2=>'idcard_self',3=>'zhizhao',4=>'zhizhao_copy',5=>'hetong',
			6=>'shuidian',7=>'liushui',8=>'zhengxin',9=>'xingshi',10=>'fangchan',11=>'zhicheng');
	
		$set=$this->attributes;
	        foreach($files as $file){
	               unset($set[$file]);
	        }
		//Yii::info(VarDumper::dumpAsString());
	
		foreach($set as $attr=>$val){
			//Yii::info("setting attr: ".$attr);
			$usr->$attr=$this->$attr;
		}

		$usr->wmstat=$usr->wmstat|1;//设置wmstat最后一位：刚注册默认该是0,提交资料后是1
		$usr->fee_rate=0.05;//设置wmstat最后一位：刚注册默认该是0,提交资料后是1

		if($usr->update()){
			Yii::info("update".$who."'s detail succ");
		}else{
			Yii::info("update".$who."'s detail fail");
			return -1;
		};
		
		foreach($files as $file){
        	
			$this->$file = UploadedFile::getInstance($this,"$file");
			if($this->$file){//file空时不存图
				$dir=Yii::getAlias('@webroot').'/userdata/'.$who.'/detail/';
				if(!is_dir($dir)){
    					mkdir($dir, 0777,true);
				}
				//saveAs: If target file $file exists,overwrite
                		$this->$file->saveAs($dir.$file.".".$this->$file->extension);
	    			Yii::info("upload file".$file."is succ");
			}else{
	    			Yii::info("upload file".$file."is null");
			}
       		}

		return 0;
	}else{
		Yii::info("in setDetail ,validate fail");
      		return -1;
	}
    }
}
