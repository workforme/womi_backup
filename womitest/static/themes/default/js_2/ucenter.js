$(document).ready(function(){

//个人中心 左侧菜单
$("#firstpane p.menu_head").click(function(){
	$(this).addClass("current").next("div.menu_body").slideToggle(300).siblings("div.menu_body").slideUp("fast");
	$(this).siblings().removeClass("current");
});


//右上角:登陆后用户名下的下拉菜单by manna
var show;
$('[_t_uc]').hover(
	function(){
		clearTimeout(show);
		show = setTimeout(function(){
			$('#hasLoginDown').stop(true,true).slideDown(200);
		},150);
	},
	function(){
		clearTimeout(show);
		show = setTimeout(function(){
			$('#hasLoginDown').stop(true,true).slideUp(200);
		},150);
	}
);
$("#default-menu").click();
$("#default-page").click();
});
