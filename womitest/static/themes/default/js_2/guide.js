$(document).ready(function(){

	//新手指引by yilong
	var clk=0;
	var $liCur = $(".gdnav ul li.cur");
	  curP = $liCur.position().left;
	  curW = $liCur.outerWidth(true);
	  $slider = $(".gdcur");
	  $navBox = $(".gdnav");
	 $targetEle = $(".gdnav ul li a");

	$slider.animate({
	  "left":curP,
	  "width":curW
	});

	$targetEle.mouseenter(function () {
	  var $_parent = $(this).parent(),
		_width = $_parent.outerWidth(true),
		posL = $_parent.position().left;
	  $slider.stop(true, true).animate({
		"left":posL,
		"width":_width
	  }, "fast");
	});

	$navBox.mouseleave(function (cur, wid) {
	if(clk==0){
	  cur = curP;
	  wid = curW;
	  $slider.stop(true, true).animate({
		"left":cur,
		"width":wid
	  }, "fast");}
	});

	$(".gdnav ul li").click(function(){
		clk=1;
		$(this).mouseenter();
		//你妹啊，不知道相对路径就写绝对路径吧
		$.get("/index.php?r=site/guide-"+$(this).attr('id'), function(data){$(".gdnavDown").html(data);});

	});
	//#loan前不能有空格
	$(".gdnav ul li#loan").click();

});
