$(document).ready(function(){

	//个人中心 左侧菜单
	$("#firstpane p.menu_head").click(function(){
		$(this).addClass("current").next("div.menu_body").slideToggle(300).siblings("div.menu_body").slideUp("fast");
		$(this).siblings().removeClass("current");
	});



        //个人中心 理财管理&贷款管理
      $(".menu_body ul li").click(function() {
             alert("somebody"); 
             // $.get("/index.php?r=site/center-"+$(this).attr('id'), function(data){$(".ucRight").html(data);});

             $.ajax({
                    type: "POST", //用POST方式传输
                    dataType: "text",
                   // url: 'https://www.microriches.cn/index.php?r=site/userCenterLoan', //目标地址
                    url: 'http://182.92.191.194:8001/index.php?r=site/center-loan', //目标地址
                    
                    //data: "userId="+userName+"&_csrf="+$("#csrfcode").attr("value"),
                   // data: "_csrf="+$("#csrfcode").attr("value"),
                    error: function (XMLHttpRequest, textStatus, errorThrown) {alert(XMLHttpRequest.status + ":" + XMLHttpRequest.statusText); },
                    success: function (msg)
                    {
                        if(msg!='success')
                        {
                                alert(msg);
                        }else{
                                //$("#btnSendCode").val("已发至邮箱");
                               alert("good");
                        }
                    }
             });

            alert('nobody');
       });
 
	//登陆后用户名下的下拉菜单
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

	//新手指引
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
