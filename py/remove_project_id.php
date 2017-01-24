<?php
session_start();
require_once ("../config/config.php");
//session_id($_POST['sid']);
$routername = array();

$tenant = strip_tags($_POST['id']);
$sid = strip_tags($_POST["sid"]);
$string="";

$router = $pdo->prepare("SELECT projekt FROM kurse where projekt_ID = ?");
$router->execute(array($tenant));
$routername = $router->fetchALL(PDO::FETCH_ASSOC);

for($i=0;$i<count($routername);$i++){
      $string .= $routername[$i]['projekt']." ";
  }

	shell_exec("python remove_router.py $string");
	shell_exec("python remove_network.py $string");
	shell_exec("python remove_project_id.py $tenant"); //$storage muss dann noch eingefügt werden
	$stmt = $pdo->prepare("DELETE FROM kurse WHERE projekt_ID = ?");
	$stmt->execute(array($tenant));

	header("Location:../kurs.php");
	
	session_write_close();
?>