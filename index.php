<?php
    session_start();
    
    error_reporting(E_ALL & ~E_NOTICE); // meldet alle Fehler ausser "Notice"
    require_once ("config/config.php");
    $ergebnis = array();
    $true = 1;



if(isset($_POST['submit'])){
  $name = $_POST['user'];
  $passwd = $_POST['password']; 

  $stmt = $pdo->query("SELECT * FROM login WHERE name = 'admin'");
  $temp = $stmt->execute(array('name' => $name));
  $ergebnis = $stmt->fetch(PDO::FETCH_ASSOC);
  print_r($ergebnis['passwd']."<br/>");
  echo hash('sha512', $passwd.$salt);
}


  if($_POST['user'] == $ergebnis['name'] && hash('sha512', $passwd.$salt) == $ergebnis['passwd']){
    $_SESSION['userid'] = $ergebnis['name'];
     
    die(header("Location:main.php"));

  } elseif(isset($_POST['submit']) && hash('sha512',$passwd.$salt) !== $ergebnis['passwd']){
    $true = 0;
  } elseif(isset($_POST['submit']) && $name !== $ergebnis['name']){
    $true = 2;
  }
  





    // try{

    //   $pdo = new PDO('sqlite:anmeldung.sqlite3');

    //   // set errormode to exception
    //   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //   if(!isset($_SESSION['userid'])){
    //     $name = $_POST['user'];
    //     $passwd = $_POST['password'];

    //     $stmt = $pdo->query("SELECT * FROM login where name='".$name."'");
    //     $ergebnis = $stmt->fetch(PDO::FETCH_ASSOC);
    //   }

    //   if($ergebnis !== false && $ergebnis['passwd'] == $passwd){
    //       $_SESSION['userid'] = $ergebnis['name'];
    //       die(header("Location:main.php"));
    //   } elseif ($ergebnis['passwd'] !== $passwd){
    //     $true = 0;
    //   }
    //   // if($user !== false && $passwd == $user['passwd']){
    //   //   $_SESSION['userid'] = $user['name'];
    //   //   die(header("Location:main.php"));
    //   // }


    // } catch(PDOException $e){
    //     echo "Anmeldung an Datenbank gescheitert. ".$e->getMessage();
    //     die();
    //   }

    

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
         <!--  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button> -->
          <a class="navbar-brand" href="#">HSF-Stack</a>
        </div>
      </div>
    </nav>

    <div class="container">
    <div class="row">
    <div class="col-md-4 col-xs-10 col-xs-offset-1 col-md-offset-4">
      <img src="images/HS-Fulda_logo_transparent.png" alt="FH-Fulda Logo" class="img-thumbnail"> 
    </div>
    </div>
    <?php
      if ($true == 0){
        echo '<div class="alert alert-danger col-md-4 col-xs-10 col-xs-offset-1 col-md-offset-4" role="alert">
              <span class="glyphicon glyphicon-info-sign" aria-hidden="true">
               Fehler! Das Passwort war falsch!</div>';
      }
      if ($true == 2){
        echo '<div class="alert alert-danger col-md-4 col-xs-10 col-xs-offset-1 col-md-offset-4" role="alert">
              <span class="glyphicon glyphicon-info-sign" aria-hidden="true">
               Fehler! Benutzername nicht gefunden!</div>';
      }
    ?>
      <div class="row">
        <div class="col-md-4 col-xs-10 col-xs col-md-offset-4">
      <form class="form-signin" action="" method="post">
        <h2 class="form-signin-heading schrift">Bitte Anmelden</h2>
        <label for="inputUser" class="sr-only">Benutzername</label>
        <input type="user" id="inputUser" class="form-control" placeholder="Benutzername" required="" autofocus="" name="user">
        <div class="platzhalter"></div>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="" name="password">
        <div class="platzhalter"></div>
        <!-- <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div> -->
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign in</button>
      </form>
      </div>
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-3.1.1.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>