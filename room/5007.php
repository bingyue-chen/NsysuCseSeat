<?php
	session_start();
	$_SESSION['uri'] = "/room/5007.php";
	if( isset( $_SESSION['FBID'] ) )
		$_SESSION['PIC'] =  "https://graph.facebook.com/" . $_SESSION['FBID'] . "/picture";
	else
		$_SESSION['PIC'] = "../img/in_seat.jpg";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>5007</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/jquery.mCustomScrollbar.min.css">
	<link rel="stylesheet" href="../css/5007.css">
	<link rel="stylesheet" href="../css/font-awesome.min.css">
	<script>
		var GLOBAL_USER_PROFILE_PIC = <?php echo "\"" . $_SESSION['PIC'] . "\"" ; ?> ;
	</script>
</head>
<body>

		<sectoin class="header">
	    <!-- Static navbar -->
		<nav class="navbar navbar-inverse navbar-static-top">
	      	<div class="container">
		        <div class="navbar-header">
		          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
		            <span class="sr-only">Toggle navigation</span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		          </button>
		          <a class="navbar-brand" href="/">NsysuCseSeat</a>
		        </div>
		        <div id="navbar" class="navbar-collapse collapse">
		          <ul class="nav navbar-nav">
		          	 <li class="dropdown">
		              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Room <span class="caret"></span></a>
		              <ul class="dropdown-menu roomselect" role="menu">
		                <!--li class="dropdown-header">工EC</li-->
		                <li class="active"><a href="/NsysuCseSeat/room/5007.php">5007</a></li>
		                <li><a href="#">5012</a></li>
		              </ul>
		            </li>
		            <li><a href="#about">About us</a></li>
		            <li><a href="#contact">Contact us</a></li>
		          </ul>
		          <ul class="nav navbar-nav navbar-right">
					<?php if( isset( $_SESSION['FBID'] ) ): ?>
		          		<li class="prof-img"><img class="img-circle img-responsive" src="https://graph.facebook.com/<?php echo $_SESSION['FBID']; ?>/picture"></li>
						<li class="nav-header"><a href="<?php echo $_SESSION['LINK']; ?> "><?php echo $_SESSION['FULLNAME']; ?></a></li>
						<li><a href="../fbconn/logout.php"><i class="fa fa-facebook-square"></i> Sign out</a></li>
					<?php else : ?>
						<li><a href="../fbconn/fbconfig.php"><i class="fa fa-facebook-square"></i> Sign in</a></li>
					<?php endif ?>
		          </ul>
		        </div><!--/.nav-collapse -->
      		</div>
    	</nav>
    </sectoin>

	<section class="content">

		<h2 class="roomname">
			<span class="glyphicon glyphicon-map-marker glyphicon_mr10"></span>5007
		</h2>

		<hr>

		<ul class="nav nav-pills nav-justified" id="selectroom" >
  			<li role="presentation" data="seatmap" class="active"><a href="#Seatmap">Seatmap</a></li>
  			<li role="presentation" data="chatroom"><a href="#Chat room">Chat room</a></li>
  			<li role="presentation" data="qroom"><a href="#Question room">Question room</a></li>
		</ul>
		
		<div class="seatmap" >
			<img src="../img/5007.png" id="table">
			<div class="row row1">
				<img src="../img/default_seat.jpg" class="seat seat-img img-circle img-responsive" onerror="this.src='../img/in_seat.jpg'" user-name="空位" >
				<img src="../img/default_seat.jpg" class="seat seat-img img-circle img-responsive" onerror="this.src='../img/in_seat.jpg'" user-name="空位" >
				<img src="../img/default_seat.jpg" class="seat seat-img img-circle img-responsive" onerror="this.src='../img/in_seat.jpg'" user-name="空位" >
			</div>
			<div class="row row2">
				<img src="../img/default_seat.jpg" class="seat seat-img img-circle img-responsive" onerror="this.src='../img/in_seat.jpg'" user-name="空位" >
				<img src="../img/default_seat.jpg" class="seat seat-img img-circle img-responsive" onerror="this.src='../img/in_seat.jpg'" user-name="空位" >
				<img src="../img/default_seat.jpg" class="seat seat-img img-circle img-responsive" onerror="this.src='../img/in_seat.jpg'" user-name="空位" >
				<img src="../img/default_seat.jpg" class="seat seat-img img-circle img-responsive" onerror="this.src='../img/in_seat.jpg'" user-name="空位" >
				<img src="../img/default_seat.jpg" class="seat seat-img img-circle img-responsive" onerror="this.src='../img/in_seat.jpg'" user-name="空位" >
				<img src="../img/default_seat.jpg" class="seat seat-img img-circle img-responsive" onerror="this.src='../img/in_seat.jpg'" user-name="空位" >
			</div>
			<div class="row row3">
				<img src="../img/default_seat.jpg" class="seat seat-img img-circle img-responsive" onerror="this.src='../img/in_seat.jpg'" user-name="空位" >
				<img src="../img/default_seat.jpg" class="seat seat-img img-circle img-responsive" onerror="this.src='../img/in_seat.jpg'" user-name="空位" >
				<img src="../img/default_seat.jpg" class="seat seat-img img-circle img-responsive" onerror="this.src='../img/in_seat.jpg'" user-name="空位" >
				<img src="../img/default_seat.jpg" class="seat seat-img img-circle img-responsive" onerror="this.src='../img/in_seat.jpg'" user-name="空位" >
				<img src="../img/default_seat.jpg" class="seat seat-img img-circle img-responsive" onerror="this.src='../img/in_seat.jpg'" user-name="空位" >
				<img src="../img/default_seat.jpg" class="seat seat-img img-circle img-responsive" onerror="this.src='../img/in_seat.jpg'" user-name="空位" >
			</div>
			<div class="row row4">
				<img src="../img/default_seat.jpg" class="seat seat-img img-circle img-responsive" onerror="this.src='../img/in_seat.jpg'" user-name="空位" >
				<img src="../img/default_seat.jpg" class="seat seat-img img-circle img-responsive" onerror="this.src='../img/in_seat.jpg'" user-name="空位" >
				<img src="../img/default_seat.jpg" class="seat seat-img img-circle img-responsive" onerror="this.src='../img/in_seat.jpg'" user-name="空位" >
				<img src="../img/default_seat.jpg" class="seat seat-img img-circle img-responsive" onerror="this.src='../img/in_seat.jpg'" user-name="空位" >
				<img src="../img/default_seat.jpg" class="seat seat-img img-circle img-responsive" onerror="this.src='../img/in_seat.jpg'" user-name="空位" >
			</div>
			<div class="row row5">
				<img src="../img/default_seat.jpg" class="seat seat-img img-circle img-responsive" onerror="this.src='../img/in_seat.jpg'" user-name="空位" >
				<img src="../img/default_seat.jpg" class="seat seat-img img-circle img-responsive" onerror="this.src='../img/in_seat.jpg'" user-name="空位" >
				<img src="../img/default_seat.jpg" class="seat seat-img img-circle img-responsive" onerror="this.src='../img/in_seat.jpg'" user-name="空位" >
				<img src="../img/default_seat.jpg" class="seat seat-img img-circle img-responsive" onerror="this.src='../img/in_seat.jpg'" user-name="空位" >
				<img src="../img/default_seat.jpg" class="seat seat-img img-circle img-responsive" onerror="this.src='../img/in_seat.jpg'" user-name="空位" >
			</div>
			<div class="row row6">
				<img src="../img/default_seat.jpg" class="seat seat-img img-circle img-responsive" onerror="this.src='../img/in_seat.jpg'" user-name="空位" >
				<img src="../img/default_seat.jpg" class="seat seat-img img-circle img-responsive" onerror="this.src='../img/in_seat.jpg'" user-name="空位" >
			</div>
			<div class="row row7">
				<img src="../img/default_seat.jpg" class="seat seat-img img-circle img-responsive" onerror="this.src='../img/in_seat.jpg'" user-name="空位" >
				<img src="../img/default_seat.jpg" class="seat seat-img img-circle img-responsive" onerror="this.src='../img/in_seat.jpg'" user-name="空位" >
			</div>
			<div class="row row8">
				<img src="../img/default_seat.jpg" class="seat seat-img img-circle img-responsive" onerror="this.src='../img/in_seat.jpg'" user-name="空位" >
				<img src="../img/default_seat.jpg" class="seat seat-img img-circle img-responsive" onerror="this.src='../img/in_seat.jpg'" user-name="空位" >
			</div>
		</div><!-- seatmap -->

		<div class="chatroom">

			<div class="displaymsg">
				<p>feugiat nunc sit quisque</p>
				<p>vestibulum sit amet turpis</p>
				<p>magnis interdum pharetra eleifend pulvinar ante lobortis et vel quis</p>
				<p>feugiat nunc sit quisque</p>
				<p>vestibulum sit amet turpis</p>
				<p>magnis interdum pharetra eleifend pulvinar ante lobortis et vel quis</p>
				<p>feugiat nunc sit quisque</p>
				<p>vestibulum sit amet turpis</p>
				<p>magnis interdum pharetra eleifend pulvinar ante lobortis et vel quis</p>
				<p>feugiat nunc sit quisque</p>
				<p>vestibulum sit amet turpis</p>
				<p>magnis interdum pharetra eleifend pulvinar ante lobortis et vel quis</p>
			</div>

			<div class="sendmsg">
				<div class="input-group">
				    <input type="text" class="form-control" placeholder="message">
				    <span class="input-group-btn">
				    	<button class="btn btn-primary" type="button">Send</button>
				    </span>
				</div><!-- /input-group -->
			</div>

		</div><!-- chat room -->

		<div class="qroom">
			
			<div class="displaymsg">
				<p>feugiat nunc sit quisque</p>
				<p>vestibulum sit amet turpis</p>
				<p>magnis interdum pharetra eleifend pulvinar ante lobortis et vel quis</p>
				<p>feugiat nunc sit quisque</p>
				<p>vestibulum sit amet turpis</p>
				<p>magnis interdum pharetra eleifend pulvinar ante lobortis et vel quis</p>
				<p>feugiat nunc sit quisque</p>
				<p>vestibulum sit amet turpis</p>
				<p>magnis interdum pharetra eleifend pulvinar ante lobortis et vel quis</p>
				<p>feugiat nunc sit quisque</p>
				<p>vestibulum sit amet turpis</p>
				<p>magnis interdum pharetra eleifend pulvinar ante lobortis et vel quis</p>
			</div>

			<div class="sendmsg">
				<div class="input-group">
				    <input type="text" class="form-control" placeholder="message">
				    <span class="input-group-btn">
				    	<button class="btn btn-primary" type="button">Send</button>
				    </span>
				</div><!-- /input-group -->
			</div>
			
		</div><!-- qroom -->

	</section>

	<section class="footer">
		NsysuCseSeat 2015
	</section>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="../js/5007.js"></script>

</body>
</html>
