<?php
    session_start();
    error_reporting(E_ALL & ~E_NOTICE); // meldet alle Fehler ausser "Notice"
    $name = $_SESSION['userid'];

    $shell = shell_exec("python py/list_user.py");
    $ausgabe = json_decode($shell);

    $shell2 = shell_exec("python py/list_project.py");
    $ausgabe2 = json_decode($shell2);

    $ausnahmen = array('admin', 'services', 'aodh','heat_admin','heat','swift','fuel_stats_user','cinder','ceilometer','murano','heat-cfn','neutron','nova','glance','glare');


    // echo "Count ausgabe2: ".count($ausgabe2);
    // echo "<br/>";
    // print_r($ausgabe2);

    // var_dump($ausgabe);
    // echo "<br/><br/>";
    // var_dump(key($ausgabe[0]));
    // echo "<br/><br/>";
    // echo $ausgabe[0]->ID;
    // echo "<br/><br/>";
    // echo $ausgabe[0]->Name;
    // echo "<br/><br/>";
    // echo "Count: ".count($ausgabe);
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
          <a class="navbar-brand" href="main.php">HSF-Stack Kursverwaltung</a>
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
                <li><a href="user/userverwaltung.php"><span class="glyphicon glyphicon-wrench tool" aria-hidden=true></span> <?php echo $name ?></a></li>
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
                        <div class="form-group">
                          <lable for="Auswahl">Benutzer/Projekt anlegen</lable>
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
      <button type="button" class="btn btn-block btn-primary"><span class="glyphicon glyphicon-wrench gl" aria-hidden="true"></span>BEARBEITEN</button>
      </div>

      <div class="col-md-2 col-md-offset-1 titel">
      <button type="button" class="btn btn-block btn-danger del" data-toggle="modal" data-target="#modaluserdelete"><span class="glyphicon glyphicon-minus gl" aria-hidden="true"></span>L&Ouml;SCHEN</button>
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
                        <form class="deletecourse" method="post" action="../py/deletecourse.php">
                          
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
      </div>
        <div class="modal fade bearbeiten-modal-lg" tabindex="-1" role="dialog" aria-labelledby="Kurs bearbeiten">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    ...
                </div>
            </div>
        </div>
        </div>
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
    </div>

      
      
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-3.1.1.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
