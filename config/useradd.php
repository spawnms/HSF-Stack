<?php
session_start();
require_once("config.php");
include("function.php");

$name = $_SESSION['userid'];

if(isset($_POST['benutzername']) != ""){
	$mdname = strip_tags($_POST['benutzername']);
	$mdpasswd = strip_tags($_POST['benutzerpasswd']);
	$mdpasswdrepeat = strip_tags($_POST['benutzerpasswd_w']);
	$mdemail = strip_tags($_POST['benutzeremail']);
	$mdrolle = strip_tags($_POST['rolle']);
}
if($mdpasswd === $mdpasswdrepeat){
$stmt = $pdo->prepare("INSERT INTO login (name, passwd, email, rolle) VALUES (?,?,?,?)");
$stmt->execute(array($mdname,hash('sha512',$mdpasswd.$salt),$mdemail,$mdrolle));
}

if(isset($_SESSION['userid'])){
	session_write_close();
    header("Location:../user/userverwaltung.php?benutzerid=".$name);
    exit();
}
?> 
