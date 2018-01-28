<?php
session_start();
if(isset($_SESSION['username'])) {
	header("Location: index.php");
	exit();
} else {
	if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])){
		require "resources.php";
		$stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
		$stmt->execute([trim($_POST['username'])]);
		if($stmt->rowCount() > 0){
			$user = $stmt->fetch();
			if($user[0]>0){
				$user_exists = true;
			} else {
				$stmt = $conn->prepare("INSERT INTO users (username,email,password,resetcode) VALUES (?,?,?,NULL)");
				$stmt->execute([trim($_POST['username']),trim($_POST['email']),sha1(trim($_POST['password']))]);
				$user_created = true;
			}
		}
	} else {
		$not_all_fields = true;
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
		if(isset($not_all_fields)){
			echo '<div class="alert alert-danger">
			  <p><strong>All fields must be filled in!</strong></p>
			</div>';
		} else if(isset($user_exists)){
			echo '<div class="alert alert-danger">
			  <p>User '.htmlentities($_POST['username']).' already exists! Please try again.</p>
			</div>';
		} else if(isset($user_created)){
			echo '<div class="alert alert-success">
			  <p>User '.htmlentities($_POST['username']).' created! You can now <a href="login.php">login</a></p>
			</div>';
		}
		?>
		  <h1>Create Account</h1>
		  <br/>
		  <form method="post" action="register.php">
			  <input type="text" class="form-control" name="username" placeholder="Username" required="" autofocus="" style="width:40%" />
			  <br/>
			  <input type="text" class="form-control" name="email" placeholder="email" required="" autofocus="" style="width:40%" />
			  <br/>
			  <input type="password" class="form-control" name="password" placeholder="Password" required="" style="width:40%"/>
			  <br/>
			  <button class="btn btn-md btn-primary" type="submit">Register</button>
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
