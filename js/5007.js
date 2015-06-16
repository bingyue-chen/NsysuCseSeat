$(function(){

	$("body").mCustomScrollbar({
    	axis:"y", 
    	theme:"dark",
    	setTop: "-55px",
    	mouseWheel:{ scrollAmount: 500 },
    	contentTouchScroll: 500,
	});

	$('#selectroom li').bind("click", function () {
		$('#selectroom li').removeClass('active');
		$(this).addClass('active');
		var targetName = $(this).attr("data");
		$(".seatmap, .chatroom, .qroom").fadeOut();
		$("."+targetName).fadeIn();
	});

	for( var i = 0 ; i < 20 ; ++i ){
		
	}

	$(".displaymsg").mCustomScrollbar({
    	axis:"y", 
    	theme:"dark",
    	setWidth: "100%",
    	setHeight: 300,
    	autoHideScrollbar: true,
    	mouseWheel:{ scrollAmount: 250 },
    	contentTouchScroll: 250,
	});

	var hash = window.location.hash;
	if(hash == '#Seatmap'){
		$('#selectroom li:eq(0)').click();
	}
	else if(hash == '#Chat room'){
		$('#selectroom li:eq(1)').click();
	}
	else if(hash == '#Question room'){
		$('#selectroom li:eq(2)').click();
	}

});


