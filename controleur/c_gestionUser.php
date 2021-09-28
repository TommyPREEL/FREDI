<!-- Controleur pour gerer les comptes utilisateurs et les connexions -->
<?php
$action = $_REQUEST['action'];
switch($action)
{
	case 'formLogin':
	{
		include("vues/v_pageLogin.php");
		break;
	}
	case 'checkLogin':
	{
		$mail = $_POST['mail']; 
		$mdp = $_POST['mdp'];
		if($pdo->testLogin($mail, $mdp))
		{
			// Identifiants corrects
			$statut = $pdo->getStatut($mail, $mdp);
			$tabInfos = $pdo->getInfosUser($mail, $mdp, $statut);
			$nom = $tabInfos['NOM'];
			$prenom = $tabInfos['PRENOM'];
			$amil = $tabInfos['ADRESSE_MAIL'];
			affectUser($mail, $nom, $prenom, $statut);
			$message = $statut." connecté !";
			include("vues/v_message.php");
			header("Refresh: 1; index.php?uc=presentation");
		}
		else
		{
			// Identifiants incorrects
			$message = "Identifiants incorrects !";
			include("vues/v_message.php");
			header("Refresh: 1; index.php?uc=gestionUser&action=formLogin");
		}
		break;
	}
	case 'deconnexion':
	{
		deconnexion();
		$message = "Utilisateur déconnecté avec succès";
		include("vues/v_message.php");
		header("Refresh: 1;index.php");
		break;
	}
	case 'inscription':
	{
		$mail = $_POST['mail'];
		$nom = $_POST['nom'];
		$prenom = $_POST['prenom'];
		$rue = $_POST['rue'];
		$cp = $_POST['cp'];
		$ville = $_POST['ville'];
		$num = $pdo->getDernierNumeroDemandeur() + 1;
		$mdp = $_POST['mdp'];
		$pdo->inscription($mail, $nom, $prenom, $rue, $cp, $ville, $num, $mdp);
		$message = "Inscription effectuée !";

		//mail($mail,'Inscription M2L','Bienvenue sur notre site '.$prenom." ".$nom.". Voici un rappel de vos identifiants pour vous connecter à notre site :\nAdresse mail: ".$mail."\nMot de passe: ".$mdp, "M2L");

		include("vues/v_message.php");
		header("Refresh: 1; index.php?uc=gestionUser&action=formLogin");
		break;
	}
	case 'formRegister':
	{
		include("vues/v_pageRegister.php");
		break;
	}
}
?>
