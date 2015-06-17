<?php
	session_start();
	$_SESSION['uri'] = "/";
	if( isset( $_SESSION['FBID'] ) )
		$_SESSION['PIC'] =  "https://graph.facebook.com/" . $_SESSION['FBID'] . "/picture";
	else
		$_SESSION['PIC'] = "../img/in_seat.jpg";
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>NCS | Classroom </title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/index.css">
		<link rel="stylesheet" href="css/font-awesome.min.css">
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
		          <a class="navbar-brand" href="/NsysuCseSeat/">NsysuCseSeat</a>
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
		          		<li class="prof-img"><img class=" img-circle img-responsive" src="https://graph.facebook.com/<?php echo $_SESSION['FBID']; ?>/picture"></li>
						<li class="nav-header"><a href="https://www.facebook.com/profile.php?id=<?php echo $_SESSION['FBID']; ?> "><?php echo $_SESSION['FULLNAME']; ?></a></li>
						<li><a href="fbconn/logout.php"><i class="fa fa-facebook-square"></i> Sign out</a></li>
					<?php else : ?>
						<li><a href="fbconn/fbconfig.php"><i class="fa fa-facebook-square"></i> Sign in</a></li>
					<?php endif ?>
		          </ul>
		        </div><!--/.nav-collapse -->
      		</div>
    	</nav>
    </sectoin>


    <div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h1>NsysuCseSeat</h1>
        <p>Question , Meet and Chat ! </p>        
        <p>How to use : </p>
        <ol>
        	<li>Select a classroom</li>
        	<li>Choose a seat</li>
        	<li>Start chatting , asking question or find the girl'FB who sat in front of you</li>
        </ol>
      </div>

      <div class="row">
      	<div class="col-md-4 classroom">
      		<h3>5007</h3>
      		<p>Student : </p>
      		<p>Remaining seat : </p>
      		<p>Now teaching : </p>
      		<p><a class="btn btn-primary" href="room/5007.php" role="button">Go to clasroom</a></p>
      	</div>
      </div>

    </div> <!-- /container -->
	</body>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</html>
