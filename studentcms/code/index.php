<?php
session_start();
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}
require 'resources.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="/img/Red_check.png">

  <title>Tidal CMS</title>

  <!-- Bootstrap core CSS -->
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <!-- Custom styles for this template -->
  <link href="css/jumbotron-narrow.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
</head>
<body>
	<div class="container">
		<div class="header clearfix">
			<nav>
				<ul class="nav nav-pills pull-right">
				<li role="presentation" class="active"><a href="/">My Details</a></li>
				<li role="presentation"><a href="/logout.php">Logout</a></li>
				</ul>
			</nav>
			<h3 class="text-muted">Tidal CMS <img src="/img/Red_check.svg" style="height:20pt" /></h3>
		</div>
<!--       <div class="container"> -->
        <div class="row marketing">
			<p><strong>Username:</strong><?php echo $_SESSION['username'] ?></p>
        </div>
        <div class="row marketing">
          <h1>My Flag</h1>
          <?php
          if($_SESSION['username'] === 'admin'){
			echo '<div class="alert alert-success">
              <p>Congratulations, you got into the admin account! Your flag is <strong>';
            echo $FLAG;
            echo'</strong></p>
            </div>';
          } else {
            echo '<div class="alert alert-info">
              <p>To earn the flag you must login to the "admin" account</p>
            </div>';
          }
          ?>
        </div>
		<footer class="footer">
			<p>&copy; HackTrinity '18. This is a fictional website.</p>
		</footer>
	</div> <!-- /container -->
</body>
</html>
