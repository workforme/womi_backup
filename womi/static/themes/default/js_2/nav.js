var delay_time ;
var obj_ ;

function nav_over(nav){
	if(delay_time){
		clearTimeout(delay_time);
		delay_time = null ;
	}
	$(nav).children(".s_nav").addClass("fade_in");
}

function nav_out(nav){
	obj_ = nav;
	delay_time = setTimeout("delayHide()",200);
}

function scope_over(){
	if(delay_time){
		clearTimeout(delay_time);
		delay_time = null;
	}
	$(".has_sub").children(".s_nav").addClass("fade_in");
}

function delayHide(){
	if(delay_time){
		$(obj_).children(".s_nav").removeClass("fade_in");
		if(delay_time)
			clearTimeout(delay_time);
		delay_time = null;
		obj_ = null;
	}
}