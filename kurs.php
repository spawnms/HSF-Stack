<?php
    session_start();
    error_reporting(E_ALL & ~E_NOTICE); // meldet alle Fehler ausser "Notice"
    $name = $_SESSION['userid'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>HSF-Fulda Kurse</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/meine.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">HSF-Stack</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <!-- <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li> -->
            <!-- <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li> 
          </ul> -->
          <ul class="nav navbar-nav navbar-right">
            <li><a href="main.php">Dashboard</a></li>
            <li><a href="#">Kurs</a></li>
            <li><a href="projekt.php">Projekt</a></li>
            <li><a href="sicherheit.php">Sicherheit</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#"> <?php echo $name ?> <span class="glyphicon glyphicon-wrench tool" aria-hidden=true></span></a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="index.php">Logout <?php setcookie("", time()-3600); session_destroy(); ?></a></li>
              </ul>
            </li> 
          </ul>
        </div>
      </div>
    </nav>

    <div class="container">
    <div class="row">
      <div class="col-md-2 col-md-offset-2 titel">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> <strong>NEU</strong>
      </div>
      <div class="col-md-2 col-md-offset-2 titel" data-toggle="modal" data-target=".bearbeiten-modal-lg">
        <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> <strong>BEARBEITEN</strong>
      </div>
      <div class="col-md-2 col-md-offset-2 titel">
        <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> <strong>LÖSCHEN</strong>
      </div>
      </div>
        <div class="modal fade bearbeiten-modal-lg" tabindex="-1" role="dialog" aria-labelledby="Kurs bearbeiten">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    ...
                </div>
            </div>
        </div>
      <div class="row">
        <div class="col-md-11">
          <table class="table table-hover">
            <head>
                <tr>
                    <td>Kursname</td>
                    <td>Gr&oumlsse</td>
                    <td>Weitere Angaben</td>
                    <td>Zugriffszeit</td>
                </tr>
            </head> 
            <body>
                <tr>
                  <td>Kurs 1</td>
                  <td>45</td>
                  <td>Angabe 1</td>
                  <td>08:00 - 20:00</td>
                </tr>
                <tr>
                  <td>Kurs 2</td>
                  <td>46</td>
                  <td>Angabe 2</td>
                  <td>12:00 - 13:00</td>
                </tr>
                <tr>
                  <td>Kurs 3</td>
                  <td>47</td>
                  <td>Angabe 3</td>
                  <td>21:30 - 06:45</td>
                </tr>
            </body>   
          </table>
        </div>
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-3.1.1.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>