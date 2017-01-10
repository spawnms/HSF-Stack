<?php
session_start();
require_once ("../config/config.php");
session_id($_POST['sid']);
$id = array();

$tenant = strip_tags($_POST['id']);
$sid = strip_tags($_POST["sid"]);
$string="";

$router = $pdo->query("SELECT projekt FROM kurse");
$routername = $router->fetchALL(PDO::FETCH_ASSOC);

for($i=0;$i<count($id);$i++){
      $string .= $id[$i]['projekt']." ";
  }

	shell_exec("python remove_router.py $string");
	shell_exec("python remove_network.py $tenant");
	shell_exec("python remove_project_id.py $tenant"); //$storage muss dann noch eingefügt werden
	$stmt = $pdo->prepare("DELETE FROM kurse WHERE projekt_ID = ?");
	$stmt->execute(array($tenant));

	header("Location:../kurs.php");
	
	session_write_close();
?>