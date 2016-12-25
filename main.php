<?php
    session_start();
   // include("config/function.php");
    error_reporting(E_ALL & ~E_NOTICE); // meldet alle Fehler ausser "Notice"
    if(!isset($_SESSION['userid'])){
      header("Location:index.php");
    }
    $name = $_SESSION['userid'];

    $shell = shell_exec("python py/list_project.py");
    $ausgabe = json_decode($shell);
    $ausnahmen = array('admin', 'services');


  session_write_close();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>HSF-Fulda Anmeldung</title>

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
            <li><a href="#">Dashboard</a></li>
            <li><a href="kurs.php">Kurs</a></li>
            <li><a href="projekt.php">Projekt</a></li>
            <li><a href="sicherheit.php">Sicherheit</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="user/userverwaltung.php"><span class="glyphicon glyphicon-wrench tool" aria-hidden=true></span> <?php echo $name ?></a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                  <li><a href="index.php">Logout </a></l>
              </ul>
            </li> 
          </ul>
        </div>
      </div>
    </nav>

    <div class="container">
    <div class="row">
       <div class="col-md-10">
    <div class="col-md-2 col-md-offset-2 titel">
  <button type="button" class="btn btn-success btn-block neu" data-toggle="modal" data-target="#modaluseradd" ><span class="glyphicon glyphicon-plus gl" aria-hidden="true"></span>NEU</button>
  </div>
      <div class="col-md-3 col-md-offset-1 titel">
      <button type="button" class="btn btn-block btn-primary"><span class="glyphicon glyphicon-wrench gl" aria-hidden="true"></span>BEARBEITEN</button>
      </div>
      <div class="col-md-2 col-md-offset-1 titel">
      <button type="button" class="btn btn-block btn-danger del" data-toggle="modal" data-target="#modaluserdelete"><span class="glyphicon glyphicon-minus gl" aria-hidden="true"></span>l&ouml;schen</button>
      </div>
      </div>
      </div>
      <div class="row">
        <div class="col-md-11">
          <table class="table table-hover">
            <head>
                <tr>
                    <th>Kursname</th>
                   <!-- <th>Gr&oumlsse</th> -->
                    <th>ist aktiv</th>
                    <th>Zugriffszeit</th>
                </tr>
            </head> 
            <body>
                <?php
              for($i = 0; $i < count($ausgabe);$i++){
                if(!(in_array($ausgabe[$i]->Name,$ausnahmen))){
                echo '<tr>
                      <td>'.$ausgabe[$i]->Name.'</td>';
                   if($ausgabe[$i]->Enabled == 'true'){
                echo '<td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>';
              } else {
                echo '<td><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>';
              }
                echo   '<td>
                    
                   </td>
                 </tr>';
              }
              }
                ?>
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