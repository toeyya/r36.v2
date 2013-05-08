$(document).ready(function(){	
	$(".corner").corner();
	$(".corner-top").corner("top");
	$(".corner-bottom").corner("bottom");
	var t=setTimeout('$("#menu").height($(document).height())',500);
	$(".caution").click(function(){
		$(this).find(".comment").slideToggle();
	})
	$(".datepicker").each(function(){
		if($(this).val()=="0000-00-00")
		{
			$(this).val("");
		}
	})
	$(".lang").parent().hide();
	
	$('input[name=title],input[name=url]').css('width','99%');
});
  
  
  