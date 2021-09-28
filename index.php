<?php
//Controleur Principal du site Fredi
session_start();
require_once("util/fonctions.php");
require_once("util/class.pdoFredi.php");
include("vues/v_entete.php");
include("vues/v_accueil.php");

if(!isset($_REQUEST['uc']))
     $uc = 'presentation';
else
	$uc = $_REQUEST['uc'];

/* Création d'une instance d'accès à la base de données */
$pdo = PdoFredi::getPdoFredi();
switch($uc)
{
	case 'presentation':
	{
		include("vues/v_presentation.php");
		break;
	}
	case 'gestionUser':
	{
		include("controleur/c_gestionUser.php");
		break;
	}
	case 'gestionCompte':
	{
		include("controleur/c_gestionCompte.php");
		break;
	}
}
?>

