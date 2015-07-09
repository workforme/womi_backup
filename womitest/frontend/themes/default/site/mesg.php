<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\Session;
use common\includes\CommonUtility;

?>

<fieldset class="system-message">
<legend>
<?php echo $data['title']; 
$type=$data['type'];
$msg=$data['msg'];
$jumpurl=$data['jumpurl'];
$wait=$data['wait'];
?>
</legend>
    <div style="text-align:left;padding-left:10px;height:75px;width:490px;  ">
         
        <?php if($type==1):?>
        <p class="success">Welcome!<br/><?php echo($msg); ?></p>
        <?php else:?>
        <p class="error">Oops!</br><?php echo($msg); ?></p>
        <?php endif;?>
        <p class="detail"></p>
         
    </div>
    <p class="jump">
        页面自动 <a id="href" href="<?php echo($jumpurl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($wait); ?></b>
    </p>
</fieldset>

