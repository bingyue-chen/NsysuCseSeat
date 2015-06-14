$(function(){

	$("body").mCustomScrollbar({
    	axis:"y", 
    	theme:"dark",
    	setTop: "-55px",
	});

	$('#selectroom li').bind("click", function () {
	
		$('#selectroom li').removeClass('active');
		$(this).addClass('active');
		var targetName = $(this).attr("data");
		$(".seatmap, .chatroom, .qroom").fadeOut();
		$("."+targetName).fadeIn();
	});

	$(".displaymsg").mCustomScrollbar({
    	axis:"y", 
    	theme:"dark",
    	setWidth: "100%",
    	setHeight: 300,
    	autoHideScrollbar: true,
	});
	
});


