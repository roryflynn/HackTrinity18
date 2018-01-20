<?php
session_start();
if(isset($_COOKIE['auth'])) {
  header("Location: index.php");
  exit();
} else {

  if(isset($_POST['username'])) {
    if($_POST['username'] === "student1" && $_POST['password'] === "password1") {
      setcookie('auth','student1:password1:staff=false', time() + (1 * 24 * 60 * 60));
      $_SESSION['grade'] = 38;

      header("Location: index.php");
      exit();
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

  <title>Whiteboard</title>

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
              <li role="presentation" class="active"><a href="/">My Grades</a></li>
              <li role="presentation"><a href="/staff.php">Staff Area</a></li>
            </ul>
          </nav>
          <h3 class="text-muted">Whiteboard <img src="/img/Red_check.svg" style="height:20pt" /></h3>
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
          <p><strong>Username:</strong> student1</p>
          <p><strong>Password:</strong> password1</p>
          <br/>
          <form method="post" action="login.php">
<input type="text" class="form-control" name="username" placeholder="Username" required="" autofocus="" style="width:40%" />
  <br/>
      <input type="password" class="form-control" name="password" placeholder="Password" required="" style="width:40%"/>
      <br/>
            <button class="btn btn-md btn-primary" type="submit">Login</button>   
          </form>
        </div>
          <footer class="footer">
            <p>&copy; HackTrinity '17. This is a fictional website.</p>
          </footer>

        </div> <!-- /container -->
      </body>
      </html>
<?php
}
?>
