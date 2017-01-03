<?php
    session_start();
   // include("config/function.php");
    require_once ("../config/config.php");
    include ("../config/function.php");
    error_reporting(E_ALL & ~E_NOTICE); // meldet alle Fehler ausser "Notice"
    // if(!isset($_SESSION['userid'])){
    //   header("Location:../index.php");
    // }
    $name = $_SESSION['userid'];

    $stmt = $pdo->query("SELECT id, name, email, llogin, rolle FROM login");
    $userdaten = $stmt->fetchALL(PDO::FETCH_ASSOC);

    $dbrolle = $pdo->prepare("SELECT rolle FROM login WHERE name = ?");
    $dbrolle->execute(array($name));
    $rolle = $dbrolle->fetch(PDO::FETCH_ASSOC);

    // if(isset($_POST['benutzerid'])){
    //   echo $_POST['benutzerid'];
    // }

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
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/meine.css" rel="stylesheet">
    <script src="../js/jquery-3.1.1.js"></script>

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
          <a class="navbar-brand" href="../main.php">HSF-Stack Userverwaltung</a>
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
            <li><a href="../kurs.php">Kurs</a></li>
            <li><a href="../projekt.php">Projekt</a></li>
            <li><a href="../sicherheit.php">Sicherheit</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="userverwaltung.php"><span class="glyphicon glyphicon-wrench tool" aria-hidden=true></span> <?php echo $name ?></a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="../index.php">Logout <?php setcookie("", time()-3600); session_destroy(); ?></a></li>
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
     <!-- <div class="col-md-2 col-md-offset-2 titel" data-toggle="modal" data-target="#modaluseradd">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> <strong>NEU</strong>
      </div>-->
        <!-- Modal NEU -->
            <div class="modal fade" id="modaluseradd" role="dialog" aria-labelledby="rasterSystemModalLabel">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Schließen"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="rasterSystemModalLabel">Benutzer anlegen</h4>
                  </div>
                  <div class="modal-body">
                    <div class="container-fluid">
                      <div class="row">
                          <div class="col-md-8 col-sm-8 afteruseradd">
                        <form class="formuseradd" method="post" action="../config/useradd.php">
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
                            <div class="form-group">
                            <label for="Rolle waehlen">Rolle w&auml;hlen</label>
                            <select class="form-control" name="rolle">
                                <option>Admin</option>
                                <option>Benutzer</option>
                            </select>
                            </div>
                        </form>
                      </div>
                     </div>
                    </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
                    <button type="submit" id="submit" name="submit" class="btn btn-primary">Änderungen speichern</button>
                  </div>
                    </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        <!-- Modal Neu Ende -->
        <script type="text/javascript">
          $(document).ready(function(){
            var count = 0;
             $(".neu").click(function(){
                var id = $('.formuserdelete').attr('id');
                console.log(id);
                if(id == 'Benutzer' && count == 0){
                  count += 1;
                  $(".formuseradd").remove();
                  $("#submit").remove();
                  $(".afteruseradd").after('<div class="col-md-6 col-md-offset-3"><div class="alert alert-danger" role="alert"><span class="sr-only">Fehler:</span>Sie sind nicht als Administrator angemeldet.<br/>Nur Administratoren dürfen Benutzer anlegen.</div></div>');
                }
             });
          $("#submit").click(function(){
          var name = $("#benutzername").val();
          var passwd = $("#benutzerpasswd").val();
          var passwdrepeat = $("#benutzerpasswd_w").val();
          var email = $("#benutzeremail").val();
          var role = $("#rolle :selected").text();
          var dataString = 'benutzername' + name + 'benutzerpasswd' + passwd + 'benutzerpasswd_w' + passwdrepeat + 'benutzeremail' + email + 'rolle' + role; 
          $.ajax({
            type: "POST",
            url: "../config/useradd.php",
            data: $("form.formuseradd").serialize(),
            success: function(msg){
              location.reload();
              $("#modaluseradd").modal('hide');
            },
            error: function(){
              alert("Ein Fehler ist aufgetreten.");
            }
          });
          });
          });
        </script>
        
      <div class="col-md-3 col-md-offset-1 titel">
      <button type="button" class="btn btn-block btn-primary"><span class="glyphicon glyphicon-wrench gl" aria-hidden="true"></span>BEARBEITEN</button>
        
      </div>
      <div class="col-md-2 col-md-offset-1 titel">
      <button type="button" class="btn btn-block btn-danger del" data-toggle="modal" data-target="#modaluserdelete"><span class="glyphicon glyphicon-minus gl" aria-hidden="true"></span>L&Ouml;SCHEN</button>
      </div>
     <!-- <div class="col-md-2 col-md-offset-2 titel" data-toggle="modal" data-target="#modaluserdelete">
        <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> <strong>LÖSCHEN</strong>
      </div> -->
<!-- Modal NEU -->
            <div class="modal fade" id="modaluserdelete" role="dialog" aria-labelledby="rasterSystemModalLabel">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Schließen"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="rasterSystemModalLabel">Benutzer l&ouml;schen</h4>
                  </div>
                  <div class="modal-body">
                    <div class="container-fluid">
                      <div class="row">
                          <div class="col-md-8 col-sm-8 afterform">
                        <form class="formuserdelete" method="post" action="../config/userdel.php" id="<?php echo $rolle['rolle']; ?>">
                            <div class="form-group">
                                <lable for="zu l&ouml;schenden Benutzer w&auml;hlen">zu l&ouml;schenden Benutzer w&auml;hlen</lable>
                                <select class="form-control" name="benutzernamedelete">
                                <?php
                                        for($i = 0; $i < count($userdaten);$i++){
                                            if($userdaten[$i]['name'] != $name && $userdaten[$i]['name'] != 'admin'){
                                                echo "<option>".$userdaten[$i]['name']."</option>";
                                        }
                                    }
                                ?>
                            </select>
                            </div>
                            <div class="form-group">
                                <label for="Admin_Passwort">mit Admin Passwort bestätigen</label>
                                <input type="password" name="adminpasswddelete" class="form-control" id="adminpasswddelete" placeholder="Passwort">
                            </div>
                        </form>
                      </div>
                     </div>
                    </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
                    <button type="submit" id="submitdelete" name="submitdelete" class="btn btn-primary">Änderungen speichern</button>
                  </div>
                    </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
<!-- Modal Neu Ende -->
        <script type="text/javascript">
          $(document).ready(function(){
            var count = 0;
             $(".del").click(function(){
                var id = $('.formuserdelete').attr('id');
                if(id == 'Benutzer' && count == 0){
                  count += 1;
                  $(".formuserdelete").remove();
                  $("#submitdelete").remove();
                  $(".afterform").after('<div class="col-md-6 col-md-offset-3"><div class="alert alert-danger" role="alert"><span class="sr-only">Fehler:</span>Sie sind nicht als Administrator angemeldet.<br/>Nur Administratoren dürfen Benutzer löschen.</div></div>');
                }
             });
          $("#submitdelete").click(function(){
          $.ajax({
            type: "POST",
            url: "../config/userdel.php",
            data: $("form.formuserdelete").serialize(),
            success: function(msg){
              $("#modaluserdelete").modal('hide');
            },
            error: function(){
              alert("Fehler");
            }
          });
          });
          });
        </script>
      </div>
      </div>
      <div class="row">
        <div class="col-md-11">
          <table class="table table-hover table-striped tableabstand">
            <head>
                <tr>
                    <th>Benutzer</th>
                    <th>E-Mail</th>
                    <th>zuletzt angemeldet</th>
                    <th>Rolle</th>
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

    
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
