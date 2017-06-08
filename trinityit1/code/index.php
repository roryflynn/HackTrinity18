
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="../../favicon.ico">

  <title>Trinity IT Helpdesk</title>

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
          <h3 class="text-muted">Trinity IT Helpdesk</h3>
        </div>

        <div class="jumbotron">
          <h1>Welcome to Trinity IT Helpdesk.</h1>
          <p class="lead">Use the searchbox below to search the knowledge-base for relevant articles.</p>
          <form action="/" method="GET"> 
            <div class="row">
              <div class="col-xs-12">
                <div class="input-group">
                 <input type="text" class="form-control input-lg" placeholder="Search" name="search" <?php if(isset($_GET["search"])) { echo "value=\"" . $_GET["search"] . "\"";} ?> />
                 <div class="input-group-btn">
                  <button class="btn btn-success btn-lg" type="submit">
                    <span class="glyphicon glyphicon-search"></span>
                  </button>
                 </div>
              </div>
            </div>
          </div>
        </form>
      </div>

      <div class="row marketing">
        <div class="col-lg-12">
          <h3>Search results: </h5>
              <?php
                require 'resources.php';

                foreach($articles as $index => $article) {
                  if((isset($_GET['search']) && $_GET['search'] !== '') && ((strpos($article['title'], $_GET['search']) === false) && strpos($article['body'], $_GET['search']) === false)) {
                    //
                  } else {
                    echo "<h4><a href=\"article.php?id=" . $index . "\">" . $article["title"] . "</a> " . $article['label'] . "</h4>";
                    echo "<p>" . nl2br(substr($article["body"], 0, 129)) . "[...]</p>";
                  }
                }
              ?>
            </div>
          </div>

          <footer class="footer">
            <p>&copy; HackTrinity '17. This is a fictional website. IT Services are actually a sound bunch of lads and lassies</p>
          </footer>

        </div> <!-- /container -->
      </body>
      </html>
