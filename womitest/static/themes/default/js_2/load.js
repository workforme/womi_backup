function loadSoftware(id,index,action,params,name){
	$.get("/"+action,params,function(d){
		var html = "";
		var targetUrl = $("#targetUrl").val();
		var op_flag;
		if($("#op_flag") && $("#op_flag").val())
			op_flag = $("#op_flag").val();
		else
			op_flag = params["t"];
		
		var flag_str = op_flag == 1 ? "iphone" : "android" ;
		
		for(var i = 0 , len = d ? d.length : 0 ;i < len ;i ++){
			var detail_url = "/software_detail.action?sid="+d[i]["id"]+"&t="+op_flag;
			
			if($("#isStatic") ){
				var isStatic = $("#isStatic").val();
				if(isStatic == "true"){
					detail_url = "/store/"+flag_str+"/"+d[i]["id"]+"_1.html";
				}
			}
			
			if(name == "data"){
		        html += "<li><div class=\"app_i\">"
		        	 + "<div class=\"app_icon\"><a href=\""+detail_url+"\"><img src=\""
		        	 + targetUrl+"/"+d[i]["iconUrl"]+"\" title=\""+d[i]["name"]+"\" alt=\""+d[i]["note"]+"\"  onmouseover=\"showDesc('"+d[i]["appId"]+"',this,'"+name+"')\""
		        	 + " onmouseout=\"hideDesc('"+d[i]["appId"]+"');\"  /></a></div>"
		        	 + "<h3 class=\"app_name ofh\"><a href=\""+detail_url+"\" title=\""+d[i]["name"]+"\">"+d[i]["name"]+"</a></h3>"
		        	 + "<p>"+d[i]["typeName"]+"</p>"
		        	 + "<p class=\"app_dl_btn\"><a href=\"/software_download.action?type="+op_flag+"&id="+d[i]["id"]+"&appId="+d[i]["appId"]+"\" title=\"\" class=\"app_dl_link\">下载</a></p></div></li>"
	        }else{	 
	        	 
		         html += "<li class=\"app_item\">"
		        	 + "<div class=\"app_icon\"><a href=\"software_detail.action?sid="+d[i]["id"]+"&t="+op_flag+"\"><img src=\""
		        	 + targetUrl+"/"+d[i]["iconUrl"]+"\" title=\""+d[i]["name"]+"\" alt=\""+d[i]["note"]+"\" onmouseover=\"showDesc('"+d[i]["appId"]+"',this,'"+name+"')\""
		        	 + " onmouseout=\"hideDesc('"+d[i]["appId"]+"');\"  /></a></div>"
		        	 + "<h4 class=\"app_name ofh\"><a href=\"software_detail.action?sid="+d[i]["id"]+"&t="+op_flag+"\" title=\""+d[i]["name"]+"\">"+d[i]["name"]+"</a></h4>"
		        	 + "<p class=\"app_category\">"+d[i]["typeName"]+"</p>"
		        	 + " <a href=\"software_download.action?type="+op_flag+"&id="+d[i]["id"]+"&appId="+d[i]["appId"]+"\" title=\"\" class=\"app_dl_link\">下载</a></li>"
	        }
		}
		if(html == ""){
			html = "暂无信息";
		}
		$("#"+id).empty();
		$("#"+id).html(html);
		
		$("#"+id+"_ a").each(function(){
			$(this).removeClass("curr");
			if($(this).index() == index)
				$(this).addClass("curr");
		});
		if(name == "data")
			data = d;
		if(name == "typeData"){
			typeData = d;
		}
	},"json");
}

var pageIndex = 1 ;
// 加载应用
function load_app(id,flag){
	if(pageIndex ==0 )
		return;
	pageIndex ++ ;
	
	var url = "/software_other.action";
	if(flag == 1)
		url = "/software_recommand.action" ;
	else if(flag == 2)
		url = "/software_recommand_other.action";
	$.get(url,
		{
			"ajax" : 1 ,
			"pageIndex":pageIndex,
			"id":id,
			"time":new Date().getTime()
		},
	function(d){
		var html = "";
		var targetUrl = $("#targetUrl").val();
		for(var i = 0 , len = d ? d.length : 0 ;i < len ;i ++){
			var detail_url_i = "/software_detail.action?sid="+d[i]["id"]+"&t=1";
			var detail_url_a = "/software_detail.action?sid="+d[i]["id"]+"&t=2";
			
			if($("#isStatic") ){
				var isStatic = $("#isStatic").val();
				if(isStatic == "true"){
					detail_url_i = "/store/iphone/"+d[i]["id"]+"_1.html";
					detail_url_a = "/store/android/"+d[i]["id"]+"_1.html";
				}
			}
			html += "<div class=\"app_item r3\">"
				+ (d[i]["flag"]!=null&&d[i]["flag"]!=0 ? "<span class=\"pick\"></span>" : "" )
				+ "<div class=\"app_item_t rt3 clearfix\"><div class=\"app_icon\">"
				+ "<img src=\""+targetUrl+"/"+d[i]["iconUrl"]+"\" /></div>"
	            + "<h4 class=\"app_name ofh\">"+d[i]["name"]+"</h4>"
	            + "<p class=\"mt5\">"+d[i]["typeName"]+"</p><p class=\"app_link mt5 clearfix\">"
	            + "<a target=\"_blank\" class=\"mr10\" href=\""+detail_url_a+"\"><i class=\"ico\"></i>Android</a>"
				+ "<a target=\"_blank\" href=\""+detail_url_i+"\"><i class=\"ico\"></i>iPhone</a></p></div>"
	          	+ "<div class=\"app_des rb3\"><p class=\"fs14 gc6 mb5\">应用简介：</p>"
	            + "<p class=\"t2\">"+d[i]["note"]+"</p></div>";
			if(flag){
            	html += "<div class=\"user_info clearfix\"><p class=\"fs14 gc6 mb5\">应用作者：</p>"
             	 	 + "<div class=\"avatar avatar_48 r3 mr10\"><a href=\"\" ><span class=\"default_avatar f r3\"></span>"
             	 	 + "<img src=\""+d[i]["pic"]+"\" title=\"\" class=\"r3\"></a></div>"
              		+ "<p><a href=\"\" class=\"fs14 mr10\">"+d[i]["userName"]+"</a><a href=\"\" class=\"level lv"+d[i]["score"]+" mr10\"></a>"
              		+ "<span class=\"gender "+(d[i]["userSex"]==0?"f":"m")+"\"></span></p><p>"+(d[i]["comment"]=="null"?"":d[i]["comment"])+"</p></div>";
			}
			html += "</div>";
		}
		if(html == ""){
			pageIndex = 0 ;
			return;
		}
		return html;
	},"json");
}
