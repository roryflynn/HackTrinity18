<?php
require_once 'resources.php';

if(isset($_POST['username']) || isset($_POST['password'])) {
  $res = $db->querySingle('SELECT COUNT(*) FROM "users" WHERE username="' . $_POST['username'] . '" AND password="' . $_POST['password'] . '";');
  if($res===1) {
    $success = true;
  } else {
    $success = false;
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
  <link rel="icon" href="/img/padlock.png">

  <title>VPN Login</title>

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

          </nav>
          <h3 class="text-muted">VPN Login <img src="/img/padlock.svg" style="height:20pt" /></h3>
        </div>

<!--       <div class="container"> -->
        <div class="row marketing">
          <h1>Login</h1>
          <?php

          if($success === true) {
            

            echo `<p>`. $FLAG .`</p>`;

          

        } else {

          if(isset($success)) {
          ?>

          <p>Incorrect username/password</p>
          <?php 
          } ?>
          <br/>
          <form method="post" action="index.php">
<input type="text" class="form-control" name="username" placeholder="Username" required="" autofocus="" style="width:40%" />
  <br/>
      <input type="password" class="form-control" name="password" placeholder="Password" required="" style="width:40%"/>
      <br/>
            <button class="btn btn-md btn-primary" type="submit">Login</button>   
          </form>

          <?php
        } ?>
        </div>
          <footer class="footer">
            <p>&copy; HackTrinity '18. This is a fictional website.</p>
          </footer>

        </div> <!-- /container -->
      </body>
      </html>
