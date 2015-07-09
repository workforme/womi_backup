$(document).ready(function(){
$("#signupform-username").blur(function(){
	$("#form-signup").yiiActiveForm("validateAttribute", "signupform-username");
});

var InterValObj; //timer变量，控制时间
var count = 60; //间隔函数，1秒执行
var curCount;//当前剩余秒数
var valid;//验证码是否还有效：点击过且未超时
var mail;
var checkok=1;
var agree=0;
var intend=0;

function SetRemainTime() {
            if (curCount == 0) {                
                window.clearInterval(InterValObj);//停止计时器
                $("#btnSendCode").removeAttr("disabled");//启用按钮
                $("#btnSendCode").val("重新发送验证");
		valid=0;
            }
            else {
                curCount--;
                $("#btnSendCode").val("还有"+curCount + "秒失效");
            }
}

function sendMessage() {

  if($("#intend").attr("selected")==true)
  {
	$("#sign-intend").empty().append("请选择账户类型").css('visibility',"visible");	
  }

  if($("#agree").attr("checked")==true)
  {
	$("#sign-agree").empty().append("请您阅读并同意协议").css('visibility',"visible");	
  }

  valid=1;

  if($("input[id='signupform-email']").val()=="")
  {
	$("#sign-mail").empty().append("失败，请重试").css('visibility',"visible");
  }else{

    mail=$("input[id='signupform-email']").val();
    curCount = count;
    $("#codeinfo").empty();
    $("#btnSendCode").attr("disabled", "true");
    
    $.ajax({
    	type: "POST", //用POST方式传输
    	dataType: "text", 
    	//url: 'https://182.92.4.87:8000/index.php?r=site/valicode', //目标地址
    	url: 'http://182.92.4.87:8000/index.php?r=site/valicode', //目标地址
    	data: "mail="+mail+"&_csrf="+$("#csrfcode").attr("value"),
    	//data: "mail="+mail+"&YII_CSRF_TOKEN=2a321c58eb7543deda0dc1f62a9ebe4e1c409e7975f75c2cfd795138d88d0b5cs%3A32%3A%22WTNJc3FEX2FKbUpWRjFscEQ5SFhKNVp5%22%3B",
    	error: function (XMLHttpRequest, textStatus, errorThrown) {alert(XMLHttpRequest.status + ":::::" + XMLHttpRequest.statusText); },
    	success: function (msg)
		 { 
			if(msg!='ok')
			{
				//alert(msg);
				curCount=0;
				$("#sign-code").empty().append("失败，请重试").css('visibility',"visible");
			}else{
				$("#btnSendCode").val("已发至邮箱");
			}
		 }
    });
    InterValObj = window.setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次
  }
}

function checkCode(){

  code=$("input[id='signupform-mailcode']").val();
  mail=$("input[id='signupform-email']").val();

  if( valid && code != "")
  {
    param="&mail="+mail+"&code="+code;

    $.ajax({
        type: "GET", 
        dataType: "text",
        //url: 'https://182.92.4.87:8000/index.php?r=site/valicode'+param, 
        url: 'http://182.92.4.87:8000/index.php?r=site/valicode'+param, 
        error: function (XMLHttpRequest, textStatus, errorThrown) {alert(XMLHttpRequest.status + ":" + XMLHttpRequest.statusText); },
        success: function (msg)
		 { 
			if(msg=='equal'){
				curCount=0;
				$("#sign-code").empty().append("验证码有效").css('visibility',"visible");
				$(".signr button").removeAttr("disabled");//此时才可能提交表单
				checkok=1;
			}else{
				//可能的问题有memcache获取失败以及mail字段在验证前被清空
				curCount=0;
				$("#sign-code").empty().append("验证码无效，请重新发送").css('visibility',"visible");
			}
		 }
   });

  }else if(!valid &&checkok!=1){
    $("#sign-code").empty().append("未发送验证码或已超时").css('visibility',"visible");
  }else if(code==""){
    $("#sign-code").empty().append("不能为空哦").css('visibility',"visible");
  }

}

function checknull(){

  if($(this).val()==""){
    var hide=$(this).closest(".signr").prev().empty();
    //if(!$(hide).attr("disabled"))
    //{
	$(hide).append("不能为空哦").css('visibility',"visible");
    //}
    
    //var after=$(this).closest(".sign").nextAll();
    //注意find和children区别
    //$.each(after,function(index,obj){$(this).children(".signr").find("input").attr("disabled", "true");});

  }else{
    //var after=$(this).closest(".sign").nextAll();
    //注意find和children区别
    //$.each(after,function(index,obj){$(this).children(".signr").find("input").removeAttr("disabled");});
    $(this).closest(".signr").prev().empty();
  }
}
/*
function checkloannull(){

  if($(this).val()==""){
    var hide=$(this).closest(".loanr").prev().empty();
    //if(!$(hide).attr("disabled"))
    //{
        $(hide).append("不能为空哦").css('visibility',"visible");
    //}

    //var after=$(this).closest(".loan").nextAll();
    //注意find和children区别
    //$.each(after,function(index,obj){$(this).children(".loanr").find("input").attr("disabled", "true");});

  }else{
    //var after=$(this).closest(".loan").nextAll();
    //注意find和children区别
   // $.each(after,function(index,obj){$(this).children(".loanr").find("input").removeAttr("disabled");});
    $(this).closest(".loanr").prev().empty();
  }
}*/

function checkagree(){
	var old=$(this).prop("checked");
	if(old ==false){
		$("#sign-agree").empty().append("请同意协议").css('visibility',"visible");
	//	alert("aaaaaa");
	}else{
		$("#sign-agree").empty();
	}
}
$(".signr button").attr("disabled", "true");
$("#btnSendCode").click(sendMessage);
//$("#signupform-password").focus(checkCode);
//$(".signr input").blur(checknull);
$("#signupform-password").blur(checknull);
$("#signupform-password2").blur(function() {
	var pwd = $.trim($("#signupform-password").val());
	var pwd2 = $.trim($("#signupform-password2").val());
	var hide=$("#signupform-password2").closest(".signr").prev();
	hide.empty();
	if(pwd == '' && pwd2 == ''){
		$(hide).append("不能为空哦").css('visibility',"visible");
	}
	if (pwd != pwd2) {
		$(hide).append("密码不一致").css('visibility',"visible");
	}
})
$("#signupform-email").blur(checknull);
$("#signupform-username").blur(checknull);
$("#signupform-mailcode").blur(checkCode);
$("#agree input").click(checkagree);
//add by kang start
//$(".loanr button").attr("disabled", "true");
$(".loanr button").removeAttr("disabled");
//$(".loanr input").blur(checkloannull);
//add by kang end


});
