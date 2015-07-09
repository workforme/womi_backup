//$(document).ready(function(){

$("#wizard").scrollable({
	onSeek: function(event,i){
		$("#status li").removeClass("active").eq(i).addClass("active");
	},
	onBeforeSeek:function(event,i){
/*		if(i==1){
			var user = $("#user").val();
			if(user==""){
				alert("不能空");
				return false;
			}
			var pass = $("#pass").val();
			var pass1 = $("#pass1").val();
			if(pass==""){
			    alert("密码不能空");
				return false;
			}
			if(pass1 != pass){
			    alert("密码不等");
				return false;
			}
		}*/
	}
});

$("#sub").click(function(){
	var data = $("form").serialize();
	//alert(data);
});

//});

