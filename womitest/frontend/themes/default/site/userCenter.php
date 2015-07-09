<?php
use common\includes\CommonUtility;

//$this->registerJsFile(CommonUtility::getThemeUrl('js_2/jquery-1.8.2.min.js'),['yii\web\JqueryAsset']);
//$this->registerJsFile(CommonUtility::getThemeUrl('js_2/ucenter.js'),['yii\web\JqueryAsset']);
?>
<script  type="text/javascript">
      function detail(dst){
             $.ajax({
                    type: 'GET',
                    dataType: 'text',
                    url: 'http://182.92.4.87:8000/index.php?r='+dst,
                    error: function (XMLHttpRequest, textStatus, errorThrown) {alert(XMLHttpRequest.status + ':' + XMLHttpRequest.statusText); },
                    success: function (page)
                    {
                        $('.ucRight').html(page);
                    }
             });
             return false;        
}
       
</script>

<div class="ucLeft">
 <div id="firstpane" class="menu_list">

    <p id="default-menu" class="menu_head ">我的账户</p>
    <div style="display:none" class=menu_body >
      <a id='default-page' href="#" onclick="detail('uc/showdetail&id=jiben')">基本资料</a>
      <a href="#" onclick="detail('uc/showdetail&id=renzheng')">认证资料</a>
      <!--a href="#" onclick="detail('uc/showdetail&id=anquan')">账户安全</a-->
      <a href="#">账户安全</a>
    </div>

    <p class="menu_head">贷款管理</p>
    <div style="display:none" class=menu_body >
      <ul>
        <li id="loan"><a href="#" id="myloan" onclick="detail('loan/list')">我的贷款</a></li>
      </ul>
    </div>
    <p class="menu_head">理财管理</p>
    <div style="display:none" class=menu_body >
      <ul>
        <li id="invest"><a href="#" onclick="detail('invest/list')">我的理财</a></li>
      </ul>
    </div>
    <p class="menu_head ">资金管理</p>
    <div style="display:none" class=menu_body >
      <a href="#">充值</a>
      <a href="#">提现</a>
    </div>


 </div>
</div>

<div class="ucRight">


<p>欢迎来到用户中心</p>


</div>
<div class="clear"></div>


