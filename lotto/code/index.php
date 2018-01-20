<?php
session_start();
require 'resources.php';

if(isset($_POST["g-recaptcha-response"])) {
  $captcha = $_POST["g-recaptcha-response"];

  $url = 'https://www.google.com/recaptcha/api/siteverify';
  $data = array('secret' => '6LcZ20AUAAAAAI5DGdW2NP0SArrCXttqIGDR_V2T', 'response' => $captcha);

  // use key 'http' even if you send the request to https://...
  $options = array(
      'http' => array(
          'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
          'method'  => 'POST',
          'content' => http_build_query($data)
      )
  );
  $context  = stream_context_create($options);
  $json = file_get_contents($url, false, $context);

  $json = json_decode($json);

  if ($json->{'success'} === true) {
    $nums = generate_numbers();
    $_SESSION["RANDOM_NUMS"] = $nums;
    $_SESSION["DAY"] = 0;
  }
}

if (!isset($_SESSION["RANDOM_NUMS"])) {
  $show_captcha = true;
} else {
  $nums = $_SESSION["RANDOM_NUMS"];
  $num_to_guess = $nums[$_SESSION["DAY"]+1];
  if(isset($_POST["guess"])) {
    if($_POST["guess"] === $num_to_guess) {
      $guessed_correct = true;
      $_SESSION["RANDOM_NUMS"] = null;
    } else {
      $guessed_correct = false;
      $_SESSION["DAY"] = $_SESSION["DAY"] + 1;

      if ($_SESSION["DAY"] > 1) {
        $_SESSION["RANDOM_NUMS"] = null;
        $failed = true;
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
  <link rel="icon" href="/img/lotto-ball-22.png">

  <title>Trinity Lotto (TM)</title>

  <!-- Bootstrap core CSS -->
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <!-- Custom styles for this template -->
  <link href="css/jumbotron-narrow.css" rel="stylesheet">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

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
              <li role="presentation" class="active"><a href="#howitworks" data-toggle="modal" data-target="#howitworks">How the draw works</a></li>
            </ul>
          </nav>
          <h3 class="text-muted"><a href="/" style="text-decoration: none;">TrinityLotto</a><img src="/img/lotto-ball-22.svg" style="height:40pt" /></h3>
        </div>

<!--       <div class="container"> -->
        <div class="row marketing">
          <h1>Estimated Jackpot: <b>$1,000,000</b></h1>
        </div>

        <?php if ($show_captcha) { ?>

        <div class="row marketing">
          <form action="." method="post">
            <p>Solve captcha to play</p>
            <div class="g-recaptcha" data-sitekey="6LcZ20AUAAAAAK_2YasnP1CVU0SMtdgdvLZS9UFq"></div>
            <button type="submit">Play!</button>
          </form>

        </div>

        <?php } else { ?>


        <div class="row marketing">
          <?php if($guessed_correct === true) { ?>
            <h2>Well done, you've won one meeeeliionnn dollars!</h2>
            <img src="https://media.giphy.com/media/13B1WmJg7HwjGU/giphy.gif"/>
            <h2><?php echo $FLAG; ?></h2>

          <?php } else { ?>

          <h2>Guess the next number to win!</h2>
            <?php 
            for($i=0; $i<=$_SESSION["DAY"]; $i++) {
              echo '<h2>Number ' . ($i+1) . ' is <b>' . $nums[$i] . '</b></h2>'; 
            }
            ?>
          
          <br/>
          <?php if($_SESSION["DAY"] < 2) { ?>
          <h3>Enter your guess for number <?php echo $_SESSION["DAY"] + 2; ?>:</h3>
          <form action="." method="post">
            <input name="guess"/>
            <button type="submit">Submit Guess</button>

          </form>
          <?php } else { ?>
          <h3>Hard luck! Keep trying!</h3>
          <form action="." method="post">
            <button type="submit">Play again</button>
          </form>
          <?php } ?>
          <?php } ?>
        </div>

        <?php } ?>
<!-- 
        <div class="row marketing">
          <h1>My Flag</h1>
        </div> -->

        <!-- Modal -->
<div class="modal fade" id="howitworks" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">How the draw works</h4>
      </div>
      <div class="modal-body">
        <p>We draw the numbers as 32-bit signed integers using a Java program below</p>
        <pre>
import java.util.Random;

public class GenerateLottoNumbers {
  /* Output 1st, 2nd and 3rd Lotto numbers to stdout.*/
  public static void main(String[] args) {
    Random r = new Random();
    System.out.println(r.nextInt());
    System.out.println(r.nextInt());
    System.out.println(r.nextInt());
  }
}
</pre>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


          <footer class="footer">
            <p>&copy; HackTrinity '18. This is a fictional website.</p>
          </footer>

        </div> <!-- /container -->
      </body>

      </html>
