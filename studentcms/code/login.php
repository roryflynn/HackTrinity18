<?php
session_start();
if(isset($_SESSION['username'])) {
	header("Location: index.php");
	exit();
} else {
	if(isset($_POST['username'])) {
		require "resources.php";
		$stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
		$stmt->execute([trim($_POST['username'])]);
		if($stmt->rowCount() > 0){
			$user = $stmt->fetch();
			if(sha1($_POST['password'])===$user['password']){
				$_SESSION['username'] = $_POST['username'];
				header("Location: index.php");
				exit();
			}
		}
		else {
			$wrong_pass = true;
		}
	}
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
					<li role="presentation" class="active"><a href="/">Home</a></li>
				</ul>
			</nav>
			<h3 class="text-muted">Tidal CMS <img src="/img/Red_check.svg" style="height:20pt" /></h3>
		</div>
<!--       <div class="container"> -->
		<div class="row marketing">
		  <?php

		  if(isset($wrong_pass)) {
			echo '<div class="alert alert-danger">
			  <p><strong>Incorrect username/password!</strong> Please try again.</p>
			</div>';
		  }
		  ?>
		  <h1>Login</h1>
		  <p><strong>Username:</strong> test</p>
		  <p><strong>Password:</strong> test</p>
		  <br/>
		  <form method="post" action="login.php">
			  <input type="text" class="form-control" name="username" placeholder="Username" autofocus="" style="width:40%" />
			  <br/>
			  <input type="password" class="form-control" name="password" placeholder="Password" style="width:40%"/>
			  <br/>
			  <button class="btn btn-md btn-primary" type="submit">Login</button>
			  <a href="reset.php"><button class="btn btn-md btn-danger" onclick="window.location='/reset.php'; return false;">Forgot password</button></a>
			  <a href="register.php"><button class="btn btn-md btn-success" onclick="window.location='/register.php'; return false;">Register</button></a>
		  </form>
		</div>
		<footer class="footer">
			<p>&copy; HackTrinity '18. This is a fictional website.</p>
		</footer>
	  </div> <!-- /container -->
</body>
</html>
<?php
}
?>
