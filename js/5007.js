$(function(){
	/* defined const */
	const INIT = 0;
	const IN_SEAT = 1;
	const CLOSE_CONN = 100;
	const FAIL_IN_SEAT = 404;
	const NEW_SEAT = 2;

	const seat_index = 31 ; /* row 1 ~ row 8 */
	var seat_map = new Array( seat_index );
	var method = new Object();
	var seat = $(".seat");
	var current_seat = -1 ;

	var conn = new WebSocket('ws://localhost:8080');
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
				$(".seat:eq(" + key + ")").attr( "src" , seat_map[key][1] );
			}
		}
	};

	/* data : {
	 *	index , profile pic url
	 * }
	 */
	method[IN_SEAT] = function( data ){
		if( current_seat >= 0 )
			$(".seat:eq(" + current_seat + ")").attr( "src" , "../img/default_seat.jpg" );	
		current_seat = data[0];
		$(".seat:eq(" + data[0] + ")").attr( "src" , GLOBAL_USER_PROFILE_PIC );
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
				$(".seat:eq(" + key + ")").attr( "src" , "../img/default_seat.jpg" );
			}
		}
		seat_map[ data[0] ][0] = data[1];
		$(".seat:eq(" + data[0] + ")").attr( "src" , GLOBAL_USER_PROFILE_PIC );
	 }
	

	seat.on("click" , function(){
		var index = seat.index( this );
		var msg = {
			type : IN_SEAT ,
			data : { 'index' : index } 
		}
		conn.send( JSON.stringify( msg ) );
	});

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


