<?php
session_start();
require_once("config.php");

if(isset($_POST['benutzernamedelete']) != ""){
	$mdname = strip_tags($_POST['benutzernamedelete']);
	$mdpasswd = strip_tags($_POST['adminpasswddelete']);


	$apw = $pdo->prepare("SELECT rolle FROM login where passwd = ?");
	$apw->execute(array(hash('sha512',$mdpasswd.$salt)));
	$auth = $apw->fetch(PDO::FETCH_ASSOC);
}
	print_r($auth);
                      
    if($auth[rolle] == "Admin"){
        $stmt = $pdo->prepare("DELETE FROM login WHERE name = ?");
        $stmt->execute(array($mdname));
        header("Location:../user/userverwaltung.php");
    }

?>