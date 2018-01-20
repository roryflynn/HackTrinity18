<?php
session_start();
require 'resources.php';
$priv = require_login();
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
              <li role="presentation"><a href="/logout.php">Logout</a></li>
            </ul>
          </nav>
          <h3 class="text-muted">Whiteboard <img src="/img/Red_check.svg" style="height:20pt" /></h3>
        </div>

<!--       <div class="container"> -->
        <div class="row marketing">
          <p><strong>Your name:</strong> Evelyn Cardoso</p>
          <p><strong>Your year:</strong> Junior Fresh</p>

          <h1>My Grades</h1>
          <table class="table table-condensed table-bordered">
            <thead>
              <tr>
                <th>Module Code</th>
                <th>Module Name</th>
                <th>Grade</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>MA2C04</td>
                <td>Discrete Mathematics</td>
                <td class="success"><b>88%</b> - PASS</td>
              </tr>
              <tr>
                <td>CS2011</td>
                <td>Ethical Hacking 101</td>
                <td class="<?php if ($_SESSION['grade'] < 40) { echo 'danger';} else { echo 'success';} ?>"><b><?php echo $_SESSION['grade'];?>%</b> - <?php if ($_SESSION['grade'] < 40) { echo 'FAIL';} else { echo 'PASS';} ?></td>
              </tr>

            </tbody>
          </table>
        </div>

        <div class="row marketing">
          <h1>My Flag</h1>
          <?php
          if($_SESSION['grade'] < 40) {
            echo '<div class="alert alert-info">
              <p>Sorry, <strong>you have not passed all modules!</strong> To earn the flag you must pass all modules (get over 40%!)</p>
            </div>';            
          } else {
            echo '<div class="alert alert-success">
              <p>Congratulations, you passed all modules! Your flag is <strong>';
            echo $FLAG;
            echo'</strong></p>
            </div>';              
          }


          ?>
        </div>


          <footer class="footer">
            <p>&copy; HackTrinity '17. This is a fictional website.</p>
          </footer>

        </div> <!-- /container -->
      </body>
      </html>
