<?php
use PHPMailer\PHPMailer\PHPMailer;
#use PHPMailer\PHPMailer\Exception;
#require 'path/to/PHPMailer/src/Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

session_start();
if(isset($_SESSION['username'])) {
	header("Location: index.php");
	exit();
} else {
	require "resources.php";
	if(isset($_POST['username'])){
		if(isset($_POST['resetcode'])){
			$stmt = $conn->prepare("SELECT resetcode FROM users WHERE username = ?");
			$stmt->execute([trim($_POST['username'])]);
			if($stmt->rowCount() > 0){
				$user = $stmt->fetch();
				if(($user['resetcode']!=NULL) && ($_POST['resetcode']===$user['resetcode'])){
					$stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
					$stmt->execute([sha1(trim($_POST['password'])),trim($_POST['username'])]);
					$pass_changed = true;
				}
			}
			else {
				$user_not_exist = true;
			}
		} else {
			$stmt = $conn->prepare("UPDATE users SET resetcode = ? WHERE username = ?");
			$resetcode = mt_rand(1000,9999);
			$stmt->execute([$resetcode,trim($_POST['username'])]);
			//TODO: email reset code to user
			$stmt = $conn->prepare("SELECT email FROM users WHERE username = ?");
			$stmt->execute([trim($_POST['username'])]);
			if($stmt->rowCount() > 0){
				$user = $stmt->fetch();
				// hacktrinity2018@gmail.com : BapBap_BAp_SkiidiDUPapPAp2

				$mail = new PHPMailer(); // create a new object
				$mail->IsSMTP(); // enable SMTP
				//$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
				$mail->SMTPAuth = true; // authentication enabled
				$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
				$mail->Host = "smtp.gmail.com";
				$mail->Port = 465; // or 587
				$mail->IsHTML(true);
				$mail->Username = "hacktrinity2018@gmail.com";
				$mail->Password = "BapBap_BAp_SkiidiDUPapPAp2";
				$mail->SetFrom("hacktrinity2018@gmail.com");
				$mail->Subject = "Password Reset Code";
				$mail->Body = "The reset code for your account is: ".$resetcode;
				$mail->AddAddress($user['email']);

				if(!$mail->Send()) {
					echo "Mailer Error: " . $mail->ErrorInfo;
				} else {
					$reset_code_sent = true;
				}
			}
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
		if(isset($user_not_exist)) {
			echo '<div class="alert alert-danger">
			  <p><strong>User doesn\'t exist!</strong> Please try again.</p>
			</div>';
		} elseif(isset($pass_changed)){
			echo '<div class="alert alert-success">
			  <p><strong>Password change successful!</p>
			</div>';
		} elseif(isset($reset_code_sent)){
			echo '<div class="alert alert-success">
			  <p><strong>Reset code emailed to '.htmlentities($_POST['username']).'</p>
			</div>';
		}
		?>
		<h1>Send Reset Code</h1>
		<br/>
		<form method="post" action="reset.php">
			<input type="text" class="form-control" name="username" placeholder="Username" required="" autofocus="" style="width:40%" />
			<br/>
			<button class="btn btn-md btn-primary" type="submit">Send Reset Code</button>
		</form>
		<h1>Change Password</h1>
		<br/>
		<form method="post" action="reset.php">
			<input type="text" class="form-control" name="username" placeholder="Username" required="" autofocus="" style="width:40%" />
			<input type="password" class="form-control" name="password" placeholder="Password" required="" style="width:40%"/>
			<input type="text" class="form-control" name="resetcode" placeholder="0000" required="" autofocus="" style="width:40%" />
			<br/>
			<button class="btn btn-md btn-primary" type="submit">Send Reset Code</button>
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
