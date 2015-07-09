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
class DetailFormTest extends Model
{

    public $real_name;
   public $idcard_front;

   public function rules()
    {
        return [

        ['real_name','required'],
        [['idcard_front'],'file'/*,'skipOnEmpty' => false*/],
        ];
    }

    public function setDetail()
    {

	
	$files=array(0=>'idcard_front',1=>'idcard_back',2=>'idcard_self',3=>'zhizhao',4=>'zhizhao_copy',
			5=>'hetong',6=>'shuidian',7=>'liushui',8=>'zhengxin',9=>'xingshi',10=>'fangchan',11=>'zhicheng');

	if($this->validate()){
		foreach($files as $file){
        	
			$this->$file = UploadedFile::getInstance($this,"$file");
			if($this->$file){
                		$this->$file->saveAs('/home/www/userdata/'.'/detail/'."$file".$this->$file->extension);
			}else{
	    			Yii::info("upload file $file is null");
			}
       		}
	}
	Yii::info("in setDetail ,validate fail");
      	return null;
    }
}
