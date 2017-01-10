<?php
    session_start();
    //error_reporting(E_ALL & ~E_NOTICE); // meldet alle Fehler ausser "Notice"
    require_once ("config/config.php");
     if(!isset($_SESSION['userid'])){
      header("Location:index.php");
    }
    
    $name = $_SESSION['userid'];

    $shell = shell_exec("python py/list_user.py");
    $ausgabe = json_decode($shell);

    $shell2 = shell_exec("python py/list_project.py");
    $ausgabe2 = json_decode($shell2);


    shell_exec('py/nova_bash.sh');
    $datei = file_get_contents('py/test.txt');
    $array = explode(",", $datei);
    for($i = 0;$i < count($array);$i++){
     if(!($i === 0) && !($i === count($array)-1)){
        $ergebnis[$i]['Server_ID'] = explode(":",$array[$i])[0];
        $ergebnis[$i]['Tenant_ID'] = explode(":",$array[$i])[1];
        $ergebnis[$i]['Status'] = explode(":",$array[$i])[2];
    }
    }

    $coursequery = $pdo->query("SELECT praefix FROM kurse group by praefix");
    $coursedata = $coursequery->fetchALL(PDO::FETCH_ASSOC);
  
    $kurse = array();

    session_write_close();
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
    <script src="js/jquery-3.1.1.js"></script>
     <script src="js/remove_project_id.js"></script>
     <script src="js/remove_user_id.js"></script>
     <script src="js/create_user_project.js"></script>
     <script src="js/remove_course.js"></script>
     <script src="js/courseset.js"></script>

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
          <a class="navbar-brand" href="main.php">HSF-Stack</a>
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
            <!-- <li><a href="main.php">Dashboard</a></li> -->
            <li><a href="#">Kurs</a></li>
            <!-- <li><a href="projekt.php">Projekt</a></li> -->
            <!-- <li><a href="sicherheit.php">Sicherheit</a></li> -->
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="user/userverwaltung.php"><span class="glyphicon glyphicon-wrench tool" aria-hidden=true></span> <?php echo $name ?></a></li>
                <!-- <li><a href="#">Another action</a></li> -->
               <!--  <li><a href="#">Something else here</a></li> -->
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="index.php">Logout <?php setcookie(session_id(), time()-3600); session_destroy(); ?></a></li>
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
  <button type="button" class="btn btn-success btn-block neu" data-toggle="modal" data-target="#createuser" ><span class="glyphicon glyphicon-plus gl" aria-hidden="true"></span>NEU</button>
  </div>
<!-- ##################################################################################################################################### -->
        <!-- Modal NEU -->
            <div class="modal fade" id="createuser" role="dialog" aria-labelledby="rasterSystemModalLabel">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Schließen"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="rasterSystemModalLabel">OpenStack Kurs/Benutzer anlegen</h4>
                  </div>
                  <div class="modal-body">
                    <div class="container-fluid">
                      <div class="row">
                          <div class="col-md-7 col-sm-7">
                        <form class="createuser" method="post" action="../py/createuser.php">
                        <div class="form-group auswahl">
                          <label for="Auswahl">Benutzer/Projekt anlegen</label>
                          <select class="form-control" name="auswahl" id="auswahl">
                          <option>Benutzer</option>
                          <option>Projekt</option>
                          </select>
                        </div>
                            <div class="form-group benutzername">
                                <label id="labela" for="Benutzname">Benutzername</label>
                                <input type="user" name="benutzername" class="form-control" id="benutzername" autofocus="true" placeholder="Benutzername">
                            </div>
                            <div class="form-group benutzerpasswd">
                                <label for="Benutzerpasswd">Passwort</label>
                                <input type="password" name="benutzerpasswd" class="form-control" id="benutzerpasswd" placeholder="Passwort">
                            </div>
                            <div class="form-group beschreibung">
                                <textarea class="form-control" rows"3" placeholder="Beschreibung" id="beschreibung"></textarea>
                            </div>
                            <div class="form-group projekt">
                                <label for="Anzahl">Projekt</label>
                               <select class="form-control" name="projekt" id="projekt">
                                 <?php
                                  for($i = 0; $i < count($ausgabe2);$i++)
                                  {
                                    /* $ausnahmen sind in der config.php gespeichert */
                                    if(!(in_array($ausgabe2[$i]->Name,$ausnahmen))) {
                                    echo "<option>".$ausgabe2[$i]->Name."</option>";
                                  }
                                  }
                                 ?>
                               </select>
                            </div>
                        </form>
                      </div>
                      <div id="bingo"></div>
                      
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

<!-- ##################################################################################################################################### -->
      <div class="col-md-3 col-md-offset-1 titel">
      <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#kursset"><span class="glyphicon glyphicon-wrench gl" aria-hidden="true"></span>BEARBEITEN</button>
      </div>
       <div class="modal fade" id="kursset" role="dialog" aria-labelledby="rasterSystemModalLabel">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Schließen"><span aria-hidden="true">&times</span></button>
                    <h4 class="modal-title" id="rasterSystemModalLabel">OpenStack Kurs starten / stoppen</h4>
                </div>
                <div class="modal-body">
                  <div class="container-fluid">
                    <div class="row">
                      <div class="col-md-8 col-sm-8">
                        <form class="deletecourse" method="post" action="#">
                         <div class="form-group kurset">
                                <label for="Projekt">Projekt</label>
                               <select class="form-control" name="strsto" id="strsto">
                                <?php 
                                  for ($i = 0;$i < count($coursedata);$i++){
                                    echo '<option>'.$coursedata[$i]['praefix'].'</option>';
                                  }
                                ?>
                               </select>
                            </div>
                        </form>
                      </div>
                      <div id="bingoset"></div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
                    <button type="submit" id="submitset" name="submit" class="btn btn-primary">Änderungen speichern</button>
                  </div>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->
<!-- ##################################################################################################################################### -->
      <div class="col-md-2 col-md-offset-1 titel">
      <button type="button" class="btn btn-block btn-danger del" data-toggle="modal" data-target="#userdelete"><span class="glyphicon glyphicon-minus gl" aria-hidden="true"></span>L&Ouml;SCHEN</button>
      </div>
          <div class="modal fade" id="userdelete" role="dialog" aria-labelledby="rasterSystemModalLabel">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Schließen"><span aria-hidden="true">&times</span></button>
                    <h4 class="modal-title" id="rasterSystemModalLabel">OpenStack Kurs l&ouml;schen</h4>
                </div>
                <div class="modal-body">
                  <div class="container-fluid">
                    <div class="row">
                      <div class="col-md-8 col-sm-8">
                      <div class="alert alert-danger alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Schließen"><span aria-hidden="true">×</span></button>
                        <h4>Achtung! Seien Sie vorsichtig!</h4>
                        <p>Wenn Sie einen Kurs ausgew&auml;hlt haben und auf "Kurs l&ouml;schen" klicken, erfolgt keine Warnung! Der Kurs wird unwiederruflich gelöscht!</p>
                      </div>
                        <form class="deletecourse" method="post" action="py/remove_project_id.php">
                         <div class="form-group projektdelete">
                                <label for="Projekt">Projekt</label>
                               <select class="form-control" name="projektloeschen" id="projektloeschen">
                                <?php 
                                  for ($i = 0;$i < count($coursedata);$i++){
                                    echo '<option>'.$coursedata[$i]['praefix'].'</option>';
                                  }
                                ?>
                               </select>
                            </div>
                        </form>
                      </div>
                      <div id="bingodelete"></div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
                    <button type="submit" id="submitloeschen" name="submit" class="btn btn-primary submitloeschen" data-toggle="tooltip" data-placement="top">Kurs l&ouml;schen</button>
                  </div>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->

<!-- ##################################################################################################################################### -->
      </div>
        <div class="modal fade bearbeiten-modal-lg" tabindex="-1" role="dialog" aria-labelledby="Kurs bearbeiten">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    ...
                </div>
            </div>
        </div>
        </div>
     <!--    
      <div class="row">
        <div class="col-md-5 kurstabelle">
          <table class="table table-hover">
            <head>
                <tr>
                    <th>Benutzer</th>
                    <th>ID</th>
                    <th></th>
                </tr>
            </head> 
            <body>
            <?php
              for($i = 0; $i < count($ausgabe);$i++) {
                if(!(in_array($ausgabe[$i]->Name,$ausnahmen))) {
                    echo '
                        <tr>
                           <td>'.$ausgabe[$i]->Name.'</td>
                           <td>'.$ausgabe[$i]->ID.'</td>
                           <td>
                               <button type="button" class="btn btn-default muelleimer user" id="'.$ausgabe[$i]->ID.'">
                                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                               </button>
                           </td>
                        </tr>';
              }
            }
            ?>
            </body>   
          </table>
        </div>
         <div class="col-md-5 kurstabelle">
          <table class="table table-hover">
            <head>
                <tr>
                    <th>Projekt</th>
                    <th>ID</th>
                    <th></th>
                </tr>
            </head> 
            <body>
            <?php
              for($i = 0; $i < count($ausgabe2);$i++){
                if(!(in_array($ausgabe2[$i]->Name,$ausnahmen))){
                echo '<tr>
                   <td>'.$ausgabe2[$i]->Name.'</td>
                   <td>'.$ausgabe2[$i]->ID.'</td>
                   <td>
                    <button type="button" class="btn btn-default muelleimer project" id="'.$ausgabe2[$i]->ID.'">
                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                   </td>
                 </tr>';
              }
            }
                ?>
            </body>   
          </table>
        </div>
      </div>
      -->

      <div class="row kurs_projektuebersicht">
      <div class="col-md-11">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
          <?php
            for($i = 0; $i < count($ausgabe2);$i++){
              if(!(in_array($ausgabe2[$i]->Name,$ausnahmen))){
                if(!(in_array(strstr($ausgabe2[$i]->Name, "_",true), $kurse)))
                  $kurse[] = strstr($ausgabe2[$i]->Name, "_",true);
                }
              }
            sort($kurse,SORT_STRING);
            for($j = 0; $j < count($kurse);$j++){
          // foreach ($kurse as $value) {
            echo '<div class="panel panel-default">';
              echo '<div class="panel-heading" role="tab" id="heading'.$kurse[$j].'">';
              // echo '<div class="panel-heading" role="tab" id="heading'.$value.'">';
                echo '<h4 class="panel-title">';
                  if($j == 0)
                    echo '<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$kurse[$j].'" aria-expanded="true" aria-controls="collapse'.$kurse[$j].'">';
                  else
                  echo '<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$kurse[$j].'" aria-expanded="false" aria-controls="collapse'.$kurse[$j].'">';
                  // echo '<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$value.'" aria-expanded="false" aria-controls="collapse'.$value.'">';
                  echo ''.$kurse[$j].'';
                  // echo ''.$value.'';
                  echo '</a>';
                echo '</h4>';
              echo '</div>';
              if($j == 0)
                echo '<div id="collapse'.$kurse[$j].'" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading'.$kurse[$j].'">';
              else
              echo '<div id="collapse'.$kurse[$j].'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading'.$kurse[$j].'">';
              // echo '<div id="collapse'.$value.'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading'.$value.'">';
                echo '<div class="panel-body">';
                  // echo '<div class="col-md-5 kurstabelle">';
                    echo '<table class="table table-hover">';
                      echo '<head>';
                        echo '<tr>';
                          echo '<th>Projekt</th>
                                <th>ID</th>
                                <th>l&ouml;schen</th>
                                <th></th>';
                          echo '</tr>';
                      echo '</head>'; 
                      echo '<body>';
                        for($i = 0; $i < count($ausgabe2);$i++){
                            /* $ausnahmen sind in der config.php gespeichert */
                          if(!(in_array($ausgabe2[$i]->Name,$ausnahmen))){
                            if(strcmp(strstr($ausgabe2[$i]->Name, "_",true), $kurse[$j]) == 0){
                              echo '<tr>';
                                echo '<td>'.$ausgabe2[$i]->Name.'</td>';
                                echo '<td>'.$ausgabe2[$i]->ID.'</td>';
                                echo '<td>';
                                echo '<button type="button" class="btn btn-default muelleimer project" id="'.$ausgabe2[$i]->ID.'">';
                                echo '<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>';
                                echo '</button>';
                                echo '</td>';
                              echo '</tr>';
                            }
                          }
                        }
                      echo '</body>';
                    echo '</table>';
                  // echo '</div>';
                echo '</div>';
              echo '</div>';
            echo '</div>';
        }
        ?>
      </div>
      </div>
    </div>






    </div>

      
      
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-3.1.1.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
