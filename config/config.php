<?php

$dbserver	=	"localhost";
$dbuser		=	"";
$dbpasswd	=	"";
$dbname		=	"";

$salt		=	'';

try{

	$pdo = new PDO('mysql:host='.$dbserver.';dbname='.$dbname.';charset=UTF8',$dbuser,$dbpasswd);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

} catch (PDOExceptio $e){
	print "Anmeldung an Datenbank ist gescheitert. ".$e->getMessage()."<br/>";
	die();
}
?>
