<?php
    session_start();
   // include("config/function.php");
    require_once ("../config/config.php");
    include ("../config/function.php");
    error_reporting(E_ALL & ~E_NOTICE); // meldet alle Fehler ausser "Notice"
    if(!isset($_SESSION['userid'])){
      header("Location:../index.php");
    }
    $name = $_SESSION['userid'];

    $stmt = $pdo->query("SELECT id, name, email, llogin, rolle FROM login");
    $userdaten = $stmt->fetchALL(PDO::FETCH_ASSOC);

    if(isset($_POST['action']))
    {
        $benutzername = $_POST['benutzername'];
        if($_POST['benutzerpasswd'] === $_POST['benutzerpasswd_w']){
            $benutzerpasswd = hash('sha512', $_POST['benutzerpasswd'].$salt);
        }
        if(checkmail($_POST['benutzeremail'])){
            $benutzeremail = $_POST['benutzeremail'];
        }
        $rolle = $_POST['rolle'];
    
        echo "Name: ".$benutzername;
        echo "<br/>";
        echo "Passwort: ".$benutzerpasswd;
        echo "<br/>";
        echo "E-Mail: ".$benutzeremail;
        echo "<br/>";
        echo "Rolle: ".$rolle;
    }
  
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
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/meine.css" rel="stylesheet">

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
          <a class="navbar-brand" href="index.php">HSF-Stack Userverwaltung</a>
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
                <li><a href="#"><span class="glyphicon glyphicon-wrench tool" aria-hidden=true></span> <?php echo $name ?></a></li>
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
      <div class="col-md-2 col-md-offset-2 titel" data-toggle="modal" data-target=".neu-modal-lg">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> <strong>NEU</strong>
      </div>
        <!-- Modal NEU -->
            <div class="modal fade neu-modal-lg" role="dialog" aria-labelledby="rasterSystemModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Schließen"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="rasterSystemModalLabel">Benutzer anlegen</h4>
                  </div>
                  <div class="modal-body">
                    <div class="container-fluid">
                      <div class="row">
                          <div class="col-md-8 col-sm-8">
                        <form method="post" action="userverwaltung.php">
                            <div class="form-group">
                                <label for="Benutzname">Benutzername</label>
                                <input type="user" name="benutzername" class="form-control" id="benutzername" autofocus="true" placeholder="Benutzername">
                            </div>
                            <div class="form-group">
                                <label for="Benutzerpasswd">Passwort</label>
                                <input type="password" name="benutzerpasswd" class="form-control" id="benutzerpasswd" placeholder="Passwort">
                            </div>
                            <div class="form-group">
                                <label for="Benutzerpasswd_w">Passwort wiederholen</label>
                                <input type="password" name="benutzerpasswd_w" class="form-control" id="benutzerpasswd_w" placeholder="Passwort wiederholen">
                            </div>
                            <div class="form-group">
                                <label for="E-Mail">E-Mail</label>
                                <input type="email" name="benutzeremail" class="form-control" id="benutzeremail" placeholder="E-mail">
                            </div>
                            <select class="form-control" name="rolle">
                                <option>Admin</option>
                                <option>Benutzer</option>
                            </select>
                        </form>
                      </div>
                     </div>
                    </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
                    <button type="submit" name="speichern" class="btn btn-primary">Änderungen speichern</button>
                  </div>
                    </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        <!-- Modal Neu Ende -->
      <div class="col-md-2 col-md-offset-2 titel">
        <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> <strong>BEARBEITEN</strong>
      </div>
      <div class="col-md-2 col-md-offset-2 titel">
        <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> <strong>LÖSCHEN</strong>
      </div>
      </div>
      <div class="row">
        <div class="col-md-11">
          <table class="table table-hover table-striped">
            <head>
                <tr>
                    <td>Benutzer</td>
                    <td>E-Mail</td>
                    <td>zuletzt angemeldet</td>
                    <td>Rolle</td>
                </tr>
            </head> 
            <body>
                <?php
                for ($i = 0; $i < count($userdaten);$i++){
                echo "<tr>";
                  echo "<td>".$userdaten[$i]['name']."</td>";
                  echo "<td>".$userdaten[$i]['email']."</td>";
                  echo "<td>".$userdaten[$i]['llogin']."</td>";
                  echo "<td>".$userdaten[$i]['rolle']."</td>";
                echo "</tr>";
                }
                ?>
          </table>
        </div>
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../js/jquery-3.1.1.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>