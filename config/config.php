<?php

$dbserver	=	"localhost";
$dbuser		=	"matthias";
$dbpasswd	=	"birkE.88";
$dbname		=	"HSF_Stack";

$salt		=	'"=+C^1Jk<^J1PnK}2Sj-iqu=Req(3*^FIC2IzrtuI"=:ok?*6r';

try{

	$pdo = new PDO('mysql:host='.$dbserver.';dbname='.$dbname.';charset=UTF8',$dbuser,$dbpasswd);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

} catch (PDOExceptio $e){
	print "Anmeldung an Datenbank ist gescheitert. ".$e->getMessage()."<br/>";
	die();
}
?>
