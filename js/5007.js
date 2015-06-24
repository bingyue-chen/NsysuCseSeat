$(function(){
	/* defined const */
	const INIT         = 0;
	const IN_SEAT      = 1;
	const NEW_SEAT     = 2;
	const LEAVE_SEAT   = 3;
	const CHAT_MSG     = 4;
	const Q_MSG        = 5;
	const CLOSE_CONN   = 100;
	const FAIL_IN_SEAT = 404;
	

	const seat_index = 31 ; /* row 1 ~ row 8 */
	var seat_map = new Array( seat_index );
	var method = new Object();
	var seat = $(".seat");
	var current_seat = -1 ;

	var conn = new WebSocket('ws://seat.xgnid.me:8080');
	conn.onopen = function(e) {
	    console.log("Connection established!");
	};

	conn.onmessage = function(e) {
		/* msg type :
		* {
		*	'type' : int
		*	'data' : object
		* }
		*/
	    var msg = JSON.parse( e.data );
	    method[ msg.type ]( msg.data );
	};

	conn.onclose = function(e) {
		var msg = {
			type : CLOSE_CONN ,
			data : { 'close' : 'close'}
		};
	};

	/* data : {
	* 	array[8][6]
	* }
	*/
	method[INIT] = function( data ){
		seat_map = data;
		console.log( seat_map );
		for( var key in seat_map ){
			if( seat_map[key][0] != 0 ){
				var seat = $(".seat:eq(" + key + ")");
				seat.attr( "src" , seat_map[key][1] );
				seat.attr( "fb-link" , seat_map[key][2] );
			}
		}
	};

	/* data : {
	 *	index , profile pic url
	 * }
	 */
	method[IN_SEAT] = function( data ){
		if( current_seat >= 0 ){
			var seat = $(".seat:eq(" + current_seat + ")");
			seat.attr( "src" , "../img/default_seat.jpg" );	
			seat.attr( "fb-link" , "" );
		}
		current_seat = data[0];
		var seat = $(".seat:eq(" + data[0] + ")");
		seat.attr( "src" , GLOBAL_USER_PROFILE_PIC );
		console.log( GLOBAL_FB_LINK );
		seat.attr( "fb-link" , GLOBAL_FB_LINK );
	}

	/* data : {
	 *	index , the client id 
	 * }
	 */
	 method[NEW_SEAT] = function( data ){
		for( var key in seat_map ){
			console.log( "seat has id " + seat_map[key][0] + " , " + data[1] );
			if( seat_map[key][0] == data[1]  ){
				console.log( data[1] + " is seat at " + key );
				seat_map[key][0] = 0;
				var seat = $(".seat:eq(" + key + ")");
				seat.attr( "src" , "../img/default_seat.jpg" );
				seat.attr( "fb-link" , "" );
			 }
		}
		seat_map[ data[0] ][0] = data[1];
		var seat = $(".seat:eq(" + data[0] +  ")");
		seat.attr( "src" , data[2] );
		seat.attr( "fb-link" , data[3] );
	 }

	 /* data :
	  * [ $id ]
	  */
	method[LEAVE_SEAT] = function( data ){
		for( var key in seat_map ){
			if( seat_map[key][0] == data[0]  ){
				seat_map[key][0] = 0;
				var seat = $(".seat:eq(" + key +")");
				seat.attr( "src" , "../img/default_seat.jpg" );
				seat.attr( "fb-link" , "" );
			}
		}
	}

	/* data :
	 * [ msg ]
	  */
	method[CHAT_MSG] = function( data ){
		$('#mCSB_2_container').append('<p>'+data+'</p>');
		var top = 265 - $('#mCSB_2_container').height();
		$('#mCSB_2_container').css('top', top+'px');

		if( $('#selectroom .active').attr("data") !== "chatroom"){

			var target = $('#selectroom li:eq(1) a');
			var number = target.children('.number');
			if(number[0] == null){
				
				target.append('<div class="number">1</div>');
			}
			else{
				var value = parseInt(number.html(), 10) + 1;
				console.log(value);
				number.html(value);
			}
		}
	}

	/* data :
	 * [ msg ]
	  */
	method[Q_MSG] = function( data ){
		$('#mCSB_3_container').append('<p>'+data+'</p>');
		var top = 265 - $('#mCSB_3_container').height();
		$('#mCSB_3_container').css('top', top+'px');

		if( $('#selectroom .active').attr("data") !== "qroom"){

			var target = $('#selectroom li:eq(2) a');
			var number = target.children('.number');
			if(number[0] == null){
				
				target.append('<div class="number">1</div>');
			}
			else{
				var value = parseInt(number.html(), 10) + 1;
				console.log(value);
				number.html(value);
			}
		}
	}
	

	seat.on("click" , function(){
		var index = seat.index( this );
		var msg = {
			type : IN_SEAT ,
			data : { 'index' : index , 'img' : GLOBAL_USER_PROFILE_PIC , 'link' : GLOBAL_FB_LINK } 
		}
		conn.send( JSON.stringify( msg ) );

		var this_seat = $(this);
		if( this_seat.attr("fb-link") !== "" && this_seat.attr("fb-link") !== GLOBAL_FB_LINK  ){
			console.log( this_seat.attr("fb-link") );
			window.open( this_seat.attr("fb-link") , '_blank' );
		}
	});


	$("body").mCustomScrollbar({
    	axis:"y", 
    	theme:"dark",
    	setTop: "-55px",
    	mouseWheel:{ scrollAmount: 400 },
    	contentTouchScroll: 400,
	});

	$('#selectroom li').bind("click", function () {
		$('#selectroom li').removeClass('active');
		$(this).addClass('active');
		var targetName = $(this).attr("data");
		$(".seatmap, .chatroom, .qroom").fadeOut();
		$("."+targetName).fadeIn();
		$(this).children('a').children('.number').remove();
	});

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

	$('#chat_button').bind('click', function(){
		if($('#chat_msg').val() == '')
			return;
		var msg = {
			type : CHAT_MSG ,
			message : $('#chat_msg').val(),
			name : GLOBAL_FB_NAME
		}
		conn.send( JSON.stringify( msg ) );
		$('#chat_msg').val('');
	});

	$('#q_button').bind('click', function(){
		if($('#q_msg').val() == '')
			return;
		var msg = {
			type : Q_MSG ,
			message : $('#q_msg').val(),
			name : GLOBAL_FB_NAME
		}
		conn.send( JSON.stringify( msg ) );
		$('#q_msg').val('');
	});

	$('#chat_msg').keypress(function(event) { 
    	if (event.which == 13) {
        	$('#chat_button').click();
    	}  
	});

	$('#q_msg').keypress(function(event) { 
    	if (event.which == 13) {
        	$('#q_button').click();
    	}  
	});

});


