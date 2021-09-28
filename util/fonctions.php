<?php
/**
 * Initialise l'utilisateur
 * Crée deux variables de type session dans le cas
 * où elles n'existent pas 
*/
function initUser()
{
	if(!isset($_SESSION['mail_user']))
	{
		$_SESSION['mail_user'] = "";
	}
	if(!isset($_SESSION['nom_user']))
	{
		$_SESSION['nom_user'] = "";
	}
	if(!isset($_SESSION['prenom_user']))
	{
		$_SESSION['prenom_user'] = "";
	}
	if(!isset($_SESSION['statut_user']))
	{
		$_SESSION['statut_user'] = "";
	}
	if(!isset($_SESSION['connecte']))
	{
		$_SESSION['connecte'] = false;
	}
}
/**
 * Supprime les variable de session liées à l'utilisateur connecté
*/
function deconnexion()
{
	unset($_SESSION['mail_user']);
	unset($_SESSION['nom_user']);
	unset($_SESSION['prenom_user']);
	unset($_SESSION['statut_user']);
	unset($_SESSION['connecte']);
}
/**
 * Affectation des variables de session lié à l'utilisateur
*/
function affectUser($mail, $nom, $prenom, $statut)
{
	$_SESSION['mail_user'] = $mail;
	$_SESSION['nom_user'] = $nom;
	$_SESSION['prenom_user'] = $prenom;
	$_SESSION['statut_user'] = $statut;
	$_SESSION['connecte'] = true;
}

function estUnCp($codePostal)
{
   return strlen($codePostal)== 5 && estEntier($codePostal);
}
?>
