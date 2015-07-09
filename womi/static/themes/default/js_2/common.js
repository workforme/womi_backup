$(document).ready(function(){
	$('a,input[type="button"],input[type="submit"]').bind("focus", function(){
	   	 	$(this).blur();
	});
	if($("#backTop"))
		backTop();
	
	
	
});

function stopParentClickEvent(e){
	if (e.stopPropagation){ e.stopPropagation();}  
    else {e.cancelBubble = true;}  
}

function showTip(id,flag,msg){
	$("#"+id).show();
	if(msg != undefined){
		$("#"+id).html(msg);
		if(flag != undefined){
			$("#"+id).removeClass("ok");
			$("#"+id).removeClass("error")
			if(flag){
				$("#"+id).addClass("ok");
			}else{
				$("#"+id).addClass("error");
			}
		}
	}
}

function hideTip(id){
	$("#"+id).hide();
}

function hideAlert(flag){
	controlSelect(true);
	if(flag)
		$.zxxbox.hide_();
	else
		$.zxxbox.hide();
}

function hideAlertRefresh(){
	controlSelect(true);
	$.zxxbox.hide();
	location.href="software_list.action";
}

// 更新验证码
function refreshValidCode(img){
	img.src="/code.c?time="+(new Date().getTime());
}

function controlTip(id,flag){
	var value = $("#"+id).val();
	if(value==""){
		if(flag)
			$("#"+id+"_").show();
		else
			$("#"+id+"_").hide();
	}else if(value != ""){
		if(!flag){
			if(document.getElementById(id+"_").className.indexOf('error')<0){
				$("#"+id+"_").hide();
			}
		}
	}
}

function changeTop(targetId,h,i){
	var target = $("#"+targetId);
	clearCurr(targetId+"_",i);
	
	switch(i){
		case 1:
			$("#"+targetId).animate({
				marginTop:'0px'
			},1000);
			break;
		case 2:
			$("#"+targetId).animate({
				marginTop:'-'+h+'px'
			},1000);
			break;
		case 3:
			$("#"+targetId).animate({
				marginTop:'-'+(h*2)+'px'
			},1000);
			break;
	}
}

function changeLeft(targetId,w,i){
	var target = $("#"+targetId);
	clearCurr(targetId+"_",i);
	switch(i){
		case 1:
			$(target).animate({
				marginLeft:'0px'
			},1000);
			break;
		case 2:
			$(target).animate({
				marginLeft:'-'+w+'px'
			},1000);
			break;
		case 3:
			$(target).animate({
				marginLeft:'-'+(w*2)+'px'
			},1000);
			break;
	}
}

var scrollData ;
// 写应用商城自动滚动JS插件
function autoScroll(d){
	scrollData = d ;
	for(var i = 0 , len = scrollData.length ;i < len ;i ++){
		scrollSoftware(i,1);
		// 获取需要滚动区域的左边距，必需在此处记录
		scrollData[i]['left'] = $("#"+scrollData[i]['id']).offset().left;
		
		// 绑定分页点击事件
		$("#"+scrollData[i]['id']+"_ a").click(function(){
			var id = $(this).parent().attr("id");
			id = id.substring(0,id.length-1);
			for(var j = 0 , l = scrollData.length ;j < l ; j ++){
				if(scrollData[j]['id']==id){
					clearTimeout(scrollData[j]['time'+id]);
					scrollSoftware(j,$(this).index()+1);
					break;
				}
			}
		});
		// 当鼠标移至滚动区域时，停止滚动
		$("#"+scrollData[i]['id']).mouseover(function(){
			var id = $(this).attr("id");
			for(var j = 0 , l = scrollData.length ;j < l ; j ++){
				if(scrollData[j]['id']==id){
					clearTimeout(scrollData[j]['time'+id]);
					break;
				}
			}
		});
		// 当鼠标移开滚动区域时，定时滚动开启
		$("#"+scrollData[i]['id']).mouseout(function(event){
			// 当前滚动区域的上边距
			var top = $(this).offset().top;
			// 当产滚动区域的高度
			var height =$(this).height();
			// 鼠标当前的X坐标
			var x = event.clientX;
			// 鼠标当前的Y坐标，此处还需要加上页面滚动的距离
			var y = event.clientY + $(document).scrollTop();
			// 当前滚动区域的ID
			var id = $(this).attr("id");
			for(var j = 0 , l = scrollData.length ;j < l ; j ++){
				if(scrollData[j]['id']==id){
					var left = scrollData[j]['left'];
					// 如果鼠标不在滚动区域内，则开启定时滚动
					if(x <= left || x >= left+scrollData[j]['width'] || y <= top || y >= top + height){
						scrollData[j]['time'+id] = setTimeout("scrollSoftware('"+j+"','"+scrollData[j]['show'+id]+"')",scrollData[j]['sec']);
					}
					break;
				}
			}
		});
	}
}

// 滚动
function scrollSoftware(index,i){
	i = parseInt(i);
	var id = scrollData[index]['id'];
	var width = scrollData[index]['width'];
	var sec =  scrollData[index]['sec'];
	changeLeft(id,width,i);
	i = i+1>3?1:i+1 ;
	if(scrollData[index]['time'+id]){
		// 如果当前已绑定计时器，则先清除
		clearTimeout(scrollData[index]['time'+id]);
	}
	// 记录当前的滚动索引
	scrollData[index]['show'+id] = i ;
	// 保存当前滚动区域的计时器
	scrollData[index]['time'+id] = setTimeout("scrollSoftware('"+index+"','"+i+"')",sec);
}

// 清除
function clearCurr(target,index){
	$("#"+target+" a").each(function(){
		$(this).removeClass("curr");
		if($(this).index()+1 == index)
			$(this).addClass("curr");
	});
}

// 收缩文字
function disposeLongWord(id){
	var html = $("#"+id).val();
	if(html != "" && html.length > 70){
		var h = html.substring(0,70)+"......<a href=\"javascript:;\" onclick=\"disposeShortWord('"+id+"')\">展开</a>";
		$("#"+id+"_").html(h);
	}else{
		html = html == "" ? "&nbsp;" : html;
		$("#"+id+"_").html(html);
	}
}

// 展开文字
function disposeShortWord(id){
	$("#"+id+"_").html($("#"+id).val()+"<a href=\"javascript:;\" onclick=\"disposeLongWord('"+id+"')\">收起</a>");
}

function changeTypeImage(i){
	var image = $("#type_image_"+i);
	var icon = $(image).attr("src");
	$(image).attr("src",$(image).attr("data-title"));
	$(image).attr("data-title",icon);
}

/**
 * 开始制作客户端
 */
function startMakeCustom(flag,f){
	if(flag==0){
		 location.href="/login.jsp?url=build";
	}else{
		location.href="/user_go.action?v=2.0";
		//window.open("/version_guide.html");
	}
}
// 初始化文本
function initText(data){
	for(var i = 0 ;i < data.length ;i ++){
		var id = data[i]['id'] ;
		if(!$("#"+id))
			continue;
		var txt = $("#"+id).attr("title");
		if($("#"+id).val()==""){
			$("#"+id).val(txt);
			$("#"+id).addClass("gcc");
		}
		$("#"+id).focus(function(){
			
			if($(this).val()==$(this).attr("title")){
				$(this).val('');
				$(this).removeClass("gcc");
			}
		});
		$("#"+id).blur(function(){
			if($(this).val()==""){
				$(this).val($(this).attr("title"));
				$(this).addClass("gcc");
			}
		});
		$("#"+id).focus();
	}
}

// 置顶
function backTop(){
	var width = $(window).width();
	var right = ( width - 960 ) / 2 - 57;
	$("#backTop").css("right",right+"px");
	var backToTopEle = $("#backTop").click( function() {
		$("html, body").animate({
			scrollTop: "0px"
		}, 500, null, function(){
			// 获取当前页面的地址
			var h = location.href;
			// 这里需要单独为应用申请上架页面写JS处理，因为此处的JS代码与应用申请上架页面引入的JS插件有冲突，不能正常使用置顶。
			if(h.indexOf('apply') > -1)
				window.location.hash = "top";
		});
		backToTopEle.data("isClick",true);
		$("#backTop").removeClass("fade_in");
		$("#backTop").addClass("fade_out");
	});
	var showEle = function(){
		if(backToTopEle.data("isClick")){
		}else{
			$(backToTopEle).removeClass("fade_out");
			$(backToTopEle).addClass("fade_in");
		}
	};
	var timeDelay = null;
	var backToTopFun = function() {	
		var docScrollTop = $(document).scrollTop();
		var winowHeight = $(window).height();
		
		if(docScrollTop > 0){
			showEle() ;
		}else{
			backToTopEle.data("isClick",false);
			$("#backTop").removeClass("fade_in");
			$("#backTop").addClass("fade_out");
		}
		
		//IE6下的定位
		if ($.browser.msie && $.browser.version == "6.0") {
			backToTopEle.hide();
			clearTimeout(timeDelay);
			timeDelay = setTimeout(function(){
				backToTopEle.show();
				clearTimeout(timeDelay);
			},1000);
			backToTopEle.css("top", docScrollTop + winowHeight - 125);
		}
	};
	$(window).bind("scroll", backToTopFun);
}

// 已读消息
function read_mesasge(flag){
	if(flag != undefined){
		$.get("/user_read_message.action",{"time":new Date().getTime(),"system":flag},function(data){
			if(data > 0){
				$("#show_new").append("<span class=\"new\"></span>");
				if(flag==1)
					$("#show_new").find("a").attr("title","有新私信");
				else
					$("#show_new").find("a").attr("title","有新系统消息");
			}
		},"json");
	}
	$("#message_list").html($.smilies.format($("#message_list").html()));
}

// 控制下拉框 的显示隐藏，IE6下select元素会浮在任何元素之上，
// 所以当弹出框显示时，应当隐藏页面上的select元素，
// 弹出框隐藏时，则显示页面上的select元素
// 但如果弹出框中包括select元素，则应该排除在外，
// 目前如下方法已能满足需求，有上例情况，则需修改方法
function controlSelect(flag){
	if ($.browser.msie && $.browser.version == "6.0") {
		if(flag)
			$("select").show();
		else
			$("select").hide();
	}
}

// 获取积分对应的等级及描述
function get_score_grade(score) {
	var info = {};
	if (score > 150000) {
		info["grade"] = 9;
		info["desc"] = "登峰造极";
	} else if (score > 80000) {
		info["grade"] = 8;
		info["desc"] = "中级泰斗";
	} else if (score > 30000) {
		info["grade"] = 7;
		info["desc"] = "初级泰斗";
	} else if (score > 10000) {
		info["grade"] = 6;
		info["desc"] = "高级学士";
	} else if (score > 5000) {
		info["grade"] = 5;
		info["desc"] = "中级学士";
	} else if (score > 2000) {
		info["grade"] = 4;
		info["desc"] = "初级学士";
	} else if (score > 500) {
		info["grade"] = 3;
		info["desc"] = "高级学员";
	} else if (score > 100) {
		info["grade"] = 2;
		info["desc"] = "中级学员";
	} else if (score > 35) {
		info["grade"] = 1;
		info["desc"] = "初级学员";
	} else {
		info["grade"] = 0
		info["desc"] = "新手入门";
	}
	return info;
}

// 生成分页代码
function buildCutPageHTMLCode(codeId,currentPage,pageCount,loadDataMethod,params){
	if(pageCount < 2){
		$("#"+codeId).hide();
		return;
	}
	
	var html = "";
	var curr = " class = 'curr' ";
	if (currentPage != 1) {
		html += "<a href='javascript:;' onclick='"+loadDataMethod+"("+buildMethod(params,1)+")' class='sfs'>&lt;&lt;</a>";
		html += "<a href='javascript:;' onclick='"+loadDataMethod+"("+buildMethod(params,currentPage-1)+")' class='sfs'>&lt;</a>";
	}
	html += "<a href='javascript:;' onclick='"+loadDataMethod+"("+buildMethod(params,1)+")' "+ (currentPage == 1 ? curr : "") + ">1</a>";
	if (pageCount <= 5) {
		for (var i = 2; i <= pageCount; i++) {
			html += "<a href='javascript:;' onclick='"+loadDataMethod+"("+buildMethod(params,i)+")' "
					+ (currentPage == i ? curr : "") + ">" + i
					+ "</a>";
		}
	} else {
		if (currentPage > 3
				&& currentPage < pageCount - 3) {
			if(currentPage > 4)
				html += "...";
			for (var i = 1; i <= 5; i++) {	
				html += "<a href='javascript:;' onclick='"+loadDataMethod+"("+buildMethod(params,(currentPage-3+i))+")' "
								+ (currentPage == (currentPage - 3 + i) ? curr
										: "") + ">"
								+ (currentPage - 3 + i)
								+ "</a>";
			}
			html += "...";
			html += "<a href='javascript:;' onclick='"+loadDataMethod+"("+buildMethod(params,pageCount)+")' "
					+ (currentPage == pageCount ? curr
							: "") + ">" + pageCount + "</a>";

		} else if (currentPage > 3) {
			var temp = pageCount - 4;
			if(temp != 2)
				html += "...";
			for (var i = pageCount - 4; i <= pageCount; i++) {
				html += "<a href='javascript:;' onclick='"+loadDataMethod+"("+buildMethod(params,i)+")' " + (currentPage == i ? curr : "")+ ">" + i + "</a>";
			}
		} else {
			for (var i = 2; i < 5; i++) {
				html += "<a href='javascript:;' onclick='"+loadDataMethod+"("+buildMethod(params,i)+")' " + (currentPage == i ? curr : "") + ">" + i + "</a>";
			}
			html += "...";
			html += "<a href='javascript:;' onclick='"+loadDataMethod+"("+buildMethod(params,pageCount)+")' "
					+ (currentPage == pageCount ? curr
							: "") + ">" + pageCount + "</a>";
		}
	}
	if (currentPage < pageCount) {
		html += "<a href='javascript:;' onclick='"+loadDataMethod+"("+buildMethod(params,currentPage+1)+")' class='sfs'>&gt;</a>";
		html += "<a href='javascript:;' onclick='"+loadDataMethod+"("+buildMethod(params,pageCount)+")' class='sfs'>&gt;&gt;</a>";
	}
	html += "<input type='hidden' name='pageModel.currentPage' id='currentPage' value='"
					+ currentPage + "' />";
	$("#"+codeId).html(html);
}

// 生成分页调用的方法及参数
function buildMethod(params,pageIndex){
	if(!params)
		params = {} ;
	params["currentPage"] = pageIndex ;
	return JSON2.stringify(params);
}

// 绑定父元素悬浮事件，显示与隐藏子元素
function bindHoverBtn(parentEle, sonEle){
	$(parentEle).hover(function(){
		$(this).find(sonEle).show();
	},function(){
		$(this).find(sonEle).hide();
	});
}


