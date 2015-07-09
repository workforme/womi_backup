function searchType(sort){
	$("#order").val(sort);
	$("#currentPage").val(1);
	$("#tform").submit();
}

var appId;
var curr ;
var time ;
var json ;
// 应用详情，鼠标悬浮300毫秒后显示
function showDesc(id,c,d){
	appId = id ;
	curr = c ;
	json = null ;
	if(d == "data")
		json = data;
	else if( d == "newData")
		json = newData;
	else if( d == "choicenessData")
		json = choicenessData;
	else if( d == "typeData")
		json = typeData;
	time = setTimeout("desc()",300);
}

// 显示应用详情，渐显
function desc(){
	var op_flag = $("#op_flag").val();
	var flag = false;
	for(var i = 0 , len = json.length; i < len ;i ++){
		if(json[i]["appId"]==appId){
			var note = json[i]["note"];
			$("#desc_note").html(note.length>60?note.substring(0,60)+"...":note);
			$("#desc_typeName").html(json[i]["typeName"]);
			$("#desc_name").html(json[i]["name"]);
			$("#desc_downloadNum").html(json[i]["downloadNumStr"]);
			$("#desc_time").html(json[i]["timeDay"]);
			var a = json[i]["androidGrade"];
			var i = json[i]["iphoneGrade"];
			$("#desc_num").css("width",(op_flag == 1 ? ((i*20)+ "%") : ((a*20)+ "%")));
			flag = true;
			break;
		}
	}
	if(flag){
		var offset = $(curr).offset();
		var left = offset.left -15  ;
		var top = offset.top + 70 ;
		$("#desc").css("left",left);
		$("#desc").css("top",top);
		$("#desc").fadeIn(200);
		appId = null;
	}
}

// 隐藏应用详情
function hideDesc(){
	clearTimeout(time);
	$("#desc").hide();
	$("#desc_name").empty();
	$("#desc_num").css("width","0%");
	$("#desc_typeName").empty();
	$("#desc_note").empty();
}


var menu ;
var time1 ;
// 应用下载，鼠标悬浮300毫秒后显示
function showDownload(m){
	menu = m ;
	time1 = setTimeout("download_()",300);
}

// 应用下载菜单，渐显
function download_(){
	$(menu).children(".app_download_btn").slideDown("slow");
}

// 隐藏应用下载菜单
function download_h(){
	clearTimeout(time1);
	$(menu).children(".app_download_btn").slideUp("slow");
}

// 删除应用
function delApp(sid){
	$.zxxbox.ask('确定要删除此应用吗？', function(){
		 location.href="/software_delete.action?id="+sid;
    }, null,{
        title: "温馨提示"	
    });		
}

// 下架应用
function downApp(sid){
	$.zxxbox.ask('确定要下架此应用吗？', function(){
		 location.href="/software_down.action?id="+sid;
    }, null,{
        title: "温馨提示"	
    });		
}

// 申请上架
function upApp(sid,uid,flag){
	controlSelect(false);
	var msg = flag ? "确定申请版本更新？" : "确定要为此应用申请上架？";
	$.zxxbox.ask(msg, function(){
		 location.href="/software_apply.action?sid="+sid+"&uid="+uid+(flag?"&version=2":"");
		 controlSelect(true);
    }, function(){
    	 controlSelect(true);
    },{
        title: "温馨提示"	
    });	
}

// 申请上架
function push_upApp(sid,uid){
	controlSelect(false);
	var msg = "上架应用方可使用消息推送功能，现在上架？";
	$.zxxbox.ask(msg, function(){
		 location.href="/software_apply.action?sid="+sid+"&uid="+uid;
		 controlSelect(true);
    }, function(){
    	 controlSelect(true);
    },{
        title: "温馨提示"	
    });	
}

// 申请上架
function vip_copyright(){
	var msg = "VIP应用方可使用版权修改功能，查看详情并升级？";
	$.zxxbox.ask(msg, function(){
		hideAlert(true);
		window.open("/vip.jsp");
    }, function(){
    	controlSelect(true);
    },{
        title: "温馨提示"	
    });	
}

function supportApp(appId){
	if($("#y") && $("#y").val() == "1"){
		$("#op_msg").html("抱歉！不能推荐自己的应用");
		$("#op_msg").parent().addClass('error');
		$("#tip_box").zxxbox( {bar: false , delay : 1000});
		return;
	}
	
	$("#support_content").addClass("disabled");
	var num = $("#support").html();
	if(num)
		num = parseInt(num) + 1;
	$("#support").html(num);
	$("#support_content").attr("title","您已推荐过");
	$("#support_content").removeAttr("onclick");
	$.ajax({
		type:"GET",
		url : "/software_support.action",
		data: {"appId":appId,"time":new Date().getTime()},
		dataType:"json",
		success:function(result){
			//$("#op_msg").html("推荐成功");
			//$("#op_msg").parent().addClass('ok');
			$(".alert_box").zxxbox( {bar: false});
		}
	});
}

function loadSupport(appId){
	$.ajax({
		type:"GET",
		url : "/software_support_num.action",
		data: {"appId":appId,"time":new Date().getTime()},
		dataType:"json",
		success:function(result){
			if(result["isSupport"]){
				$("#support_content").addClass("disabled");
				$("#support_content").attr("title","您已推荐过");
				$("#support_content").removeAttr("onclick");
			}
		}
	});
}

// 评分
function score(s){
	$("#s_isScore").val(1);
	$("#s_score").val(s);
	showTip("score_",true,"");
}

// 评论
function comment(){
	if($("#s_score").val()==""){
		showTip("score_",false,"请给该应用评分");
		return;
	}
	if($("#s_comment").val()==""){
		showTip("s_comment_",false,"请输入评论内容");
		$("#s_comment").focus();
		return false;
	}
	if($("#s_comment").val().length > 140 ){
		showTip("s_comment_",false,"评论内容不能超过140个字");
		$("#s_comment").focus();
		return false;
	}
	$("#sendForm").submit();
}

// 加载用户对某应用的评分
function loadAppScore(){
	var appId = $("#s_appId").val();
	$.get("/software_score_num.action",{"appId":appId,"time:":new Date().getTime()},function (data){
		var score = data["isScore"];
		if(score==0){
			$("#s_isScore").val(0);
			$("#s_score").val("");
			var sid = $("#s_sid").val();
			$("#reply").click(function(){$(".reply_box").zxxbox( {bar: false});showBind(0,sid);});
			if($("#x").val()=="1"){
				$(".reply_box").zxxbox( {bar: false});
				showBind(0,sid);
			}
		}else{
			$("#s_isScore").val(1);
			$("#s_score").val(score);
			$("#reply").html("您已评价过");
			confirm_score();
		}
	},"json");
}

var is_convert_click = false;
// 显示下一张图片
function showNextImage(i,width){
	if(is_convert_click)
		return;
	is_convert_click = true;
	var num = width ? 3 : 4 ;
	width = width ? width : 256 ;
	var left = parseInt($("#images").css("left"));
	var count = $("#images").find("img").size();
	var flag = false;
	if(count<num){
		flag = true;
	}
	if(count == num && left != 0){
		flag = true;
	}
	if(count == 5 && left < -width){
		flag = true;
	}
	if(count >= num ){
		$(".prev").attr("title","上一张");
	}
	if(flag){
		is_convert_click = false;
		$(i).attr("title","已经是最后一张");
		return;
	}
	$(i).attr("title","下一张");
	left = (left-width)+"px" ;
	$("#images").animate({
		left:left
	},300);
	setTimeout(function(){
		is_convert_click = false;
	},300);
}

// 显示上一张图片
function showPrevImage(i,width){
	if(is_convert_click)
		return;
	is_convert_click = true;
	var num = width ? 3 : 4 ;
	width = width ? width : 256 ;
	var left = parseInt($("#images").css("left"));
	
	var count = $("#images").find("img").size();
	if(count >= num ){
		$(".next").attr("title","下一张");
	}
	
	if(left >= 0){
		is_convert_click = false;
		$(i).attr("title","已经是第一张");
		return;
	}
	$(i).attr("title","上一张");
	if(left+width > 0){
		return;
	}
	left = (left+width)+"px" ;
	$("#images").animate({
		left:left
	},300);
	setTimeout(function(){
		is_convert_click = false;
	},300);
}

var is_image_load = false;
// 加载图片
function loadImageList(codeTypeId){
	codeTypeId = codeTypeId ? codeTypeId : 0 ;
	if($("#imageIds").val() != ""){
		var ids = $("#imageIds").val().split(',');
		var l = ids.length;
		if(l >=5 ){
			alert('最多选择五张图片');
			return;
		}
	}
	controlSelect(false);
	$("#choiceImage").zxxbox({"title":"选择图片","btnclose":false});
	if(is_image_load){
		return ;
	}
	is_image_load = true;
	var appId = $("#appId").val();
	$.ajax({
		type : "GET" ,
		url : "/software_imageList.action",
		data : {"appId":appId,"codeType":codeTypeId,"time":new Date().getTime()},
		dataType : "json",
		success : function(result){
			$("#imageList").empty();
			var html = "";
			var url = $("#url").val();
			var len = result.length;
			var count = 0 ;
			var exists = false;
			for(var i = 0  ;i < len ;i ++){
				for(var j = 0  ;j < l ;j ++){
					if(result[i]["id"] == ids[j]){
						exists = true;
						break;
					}
				}
				if(!exists){
					html += "<li id=\"choice_image_"+result[i]["id"]+"\"><img onclick=\"choiceCurrImage("+i+")\" src=\""+url+result[i]["path"]+"\" width=\"240\" height=\"360\"/><p class=\"tac mt10\">" +
						"<input name=\"choice\" id=\"pic"+i+"\" type=\"checkbox\" value=\""+result[i]["id"]+"\" title=\""+url+result[i]["path"]+"\" /></p></li>";
					count ++ ;
				}
				exists = false;
			}
			if(html==""){
				html = "<li>暂无截图信息</li>"
			}
			$("#imageList").html(html);
			$("#imageList").css("width",((240*count)+((count-1)*20))+"px");
			
		},
		beforeSend  :function(){
			$("#imageList").html("<li>数据正在加载中,请稍候...</li>");
		}
	});
}

function choiceCurrImage(i){
	if($("#pic"+i).attr("checked")){
		$("#pic"+i).attr("checked",false);
	}else{
		$("#pic"+i).attr("checked",true);
	}
}

// 选图片
function choiceImage(){
	var count = $("input[name='choice']:checked").size();
	if(count > 0){
		var idArray = $("#imageIds").val()==""?[]:$("#imageIds").val().split(',');
		var divIds = "";
		var ids = "";
		if(idArray.length>0)
			ids = ",";
		var html = "";
		var count = 0 ;
		$("input[name='choice']:checked").each(function(){
			if($(this).parents("li").css('display') != "none"){
				if(ids != "" && ids != ",")
					ids += ",";
				ids += $(this).val();
				html += "<li id=\"image_"+$(this).val()+"\" ondblclick=\"removeImage("+$(this).val()+")\" class=\"drag_li\"><div id=\"image_"+$(this).val()+"_h\"><img src=\""+$(this).attr("title")+"\" width=\"144\" height=\"216\" /></div>" 
					 //+ "<span class=\"delete\" onclick=\"removeImage("+$(this).val()+")\"><a href=\"javascript:;\" title=\"删除\" class=\"r3\">x</a></span>";
					 + "</li>";
				count ++ ;
				
				if(divIds != "")
					divIds += ",";
				divIds += "#choice_image_" + $(this).val();
			}
		});
		if(ids == "" || ids == ","){
			alert("您未选择图片");
			return;
		}
		if(count > 5) {
			alert("最多选择五张图片");
			return;
		}
		if(idArray.length + count > 5){
			alert("您已上传或选择了"+idArray.length+"张图片，此处选择了"+count+"张图片，最多只能选择五张图片");
			return;
		}
		$(divIds).hide();
		$("#imageIds").val($("#imageIds").val()+ids);
		$("#images").append(html);
	}
	hideAlert(true);
	initImage(true);
	bind();
}

function bind(){
//	$(".overview_box .pic_list li").hover(function(){
//		$(this).find(".delete").fadeIn(0);
//	},function(){
//		$(this).find(".delete").fadeOut(0);
//	});
	$('#images').Sortable(
		{
			accept : 		'drag_li',
			helperclass : 	'sortHelper',
			activeclass : 	'sortableactive',
			hoverclass : 	'sortablehover',
			opacity: 		0.8,
			floats: 		true,
			revert:			true
		}
	);
	$(".drag_li").mouseover(function(){
		$(this).find(".delete").show();
	});
	$(".drag_li").mouseout(function(){
		$(this).find(".delete").hide();
	});
}

function uploadImage(path,i){
	if(getImages() >= 5)
		return ;
	var html = "<li id=\"image_"+i+"\" ondblclick=\"removeImage("+i+")\" class=\"drag_li\"><div id=\"image_"+i+"_h\"><img src=\""+path+"\" width=\"144\" height=\"216\" /></div>"
				// + "<span class=\"delete\" onclick=\"removeImage("+i+")\"><a href=\"javascript:;\" title=\"删除\" class=\"r3\">x</a></span>"
				+"</li>";
	$("#images").append(html);
	initImage(true);
	bind();
}

// 删除截图
function removeImage(id){
	$("#image_"+id).remove();
	$("#choice_image_"+id).show().find("input").removeAttr("checked");
	var idArray = $("#imageIds").val().split(',');
	var ids = "";
	for(var i = 0 , len = idArray.length ;i < len ;i ++){
		if(idArray[i] != id ){
			if(ids!="")
				ids += ",";
			ids += idArray[i];
		}
	}
	$("#imageIds").val(ids);
	$("#upload_").show();
	if($(".uploadify-queue"))
		$(".uploadify-queue").empty();
}


function showReplaceApp(flag){
	if(flag){
		$("#targetAppId").show();
		$("#a_type_").show();
	}else{
		$("#targetAppId").hide();
		$("#a_type_").hide();
	}
}

// 提交申请
function apply(){
	if($("#a_appVersion").val()==""){
		showTip("a_appVersion_",false,"请输入软件版本");
		return;
	}
	
	if($("#a_typeId").val()=="0"){
		showTip("a_typeId_",false,"请选择软件类型");
		return;
	}
	
	if($("#a_note").val() == ""){
		showTip("a_note_",false,"请输入软件简介");
		return;
	}
	
	if($("#a_note").val().length > 190){
		showTip("a_note_",false,"软件简介不能超过190个字,请删减");
		return;
	}
	
	if($(":radio:checked").val()=="2"){
		if($("#targetAppId").val()=="0"){
			showTip("a_type_",false,"请选择您要替换的应用");
			return;
		}
	}
	if($("#imageIds").val()==""){
		showTip("images_",false,"请上传或选择软件截图");
		return;
	}
	var idArray = $("#imageIds").val().split(',');
	if(idArray.length < 3){
		showTip("images_",false,"上传或选择3-5张软件截图");
		return;
	}
	initImage();
	$("#form").submit();
}

// 初始化图片
function initImage(flag){
	var count = 0 ; 
	var ids = "";
	$("#images li").each(function(){
		if(ids != "")
			ids += ",";
		var id = $(this).attr("id");
		ids += id.substring(6);
		count ++ ;
	});
	$("#imageIds").val(ids);
	if(flag && count >= 5){
		$("#upload_").hide();
	}
}

// 获取选取的图片张数
function getImages(){
	var count = 0 ; 
	var ids = "";
	$("#images li").each(function(){
		count ++ ;
	});
	return count ;
}

// 搜索
function search(t){
	if($("#keyword").val()==$("#keyword").attr("title") || $("#keyword").val()==""){
		$("#keyword").focus();
		return;
	}
	var title = encodeURIComponent(unescape(escape($("#keyword").val())));
	location.href="/software_search.action?key="+title+"&t="+t;
}

function user_search(t){
	var title = encodeURIComponent(unescape(escape($("#u_keyword").val())));
	location.href="/user_search.action?key="+title+"&t="+t;
}

function upload_image(){
	$("#upload").trigger("click");
}

// 解除绑定
function cancel_bind(tid){
	var msg = tid == 1 ? "新浪微博" : (tid == 2 ? "腾讯微博" : "人人网");
	$.zxxbox.ask("确定要"+msg+"绑定吗？", function(){
		 location.href="/user_cancel_bind.action?tid="+tid;
    }, null,{
        title: "温馨提示"	
    });		
}

// 绑定
function bind_third(tid,isBind,name){
	
	if(isBind){
		var msg = tid == 1 ? "<span class=\"share_sina\"></span>" 
		                     : ( tid == 2 ? "<span class=\"share_tencent\"></span>" 
		                                  : "<span class=\"share_renren\"></span>" ) ;
		$.zxxbox.ask("检测到您曾经绑定过："+msg+name+"，<br/>是否恢复绑定吗？", function(){
			 location.href="/user_do_bind.action?tid="+tid;
	    }, null,{
	        title: "恢复绑定"	
	    });
	}else{
		var msg = tid == 1 ? "新浪微博" : (tid == 2 ? "腾讯微博" : "人人网");
		$.zxxbox.ask("是否确认绑定"+msg+"吗？", function(){
			 location.href="/user_do_bind.action?tid="+tid;
	    }, null,{
	        title: "温馨提示"	
	    });
	}
}



