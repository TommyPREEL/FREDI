<?php
$action = $_REQUEST['action'];
switch($action)
{
	case 'afficheMenu':
	{
		if($_SESSION["statut_user"] == "Demandeur")
			include("vues/v_compte_demandeur.php");
		if($_SESSION["statut_user"] == "Tresorier")
			include("vues/v_compte_tresorier.php");
		break;
	}
	case 'creerLigne':
	{
		$lesMotifs = $pdo->getLesMotifs();
		include("vues/v_creerLigne.php");
		break;
	}
	case 'creationLigne':
	{
		$message="";
		$mail = $_SESSION['mail_user'];
		$date = $_POST["date"];
		$motif = $_POST["motifChoisi"];
		$trajet = $_POST["trajet"];
		$km = $_POST["km"];
		$peages = $_POST["peages"];
		$repas = $_POST["repas"];
		$hebergement = $_POST["hebergement"];
		if($pdo->creationLigneFrais($mail,$date,$motif,$trajet,$km,$peages,$repas,$hebergement))
		{
			$message = "Création de ligne effectuée !";
			include("vues/v_message.php");
			header("Refresh: 1; index.php?uc=gestionCompte&action=afficheMenu");
		}	
		else
		{
			$message = "Création de ligne impossible, erreur de saisie";
			include("vues/v_message.php");
			header("Refresh: 1; index.php?uc=gestionCompte&action=creerLigne");
		}
		break;
	}
	case 'ValiderLignes_listeDemandeurs':
	{
		$lesDemandeurs = $pdo->getLesDemandeurs();
		include("vues/v_validerLignes_listeDemandeurs.php");
		break;
	}
	case 'ValiderLignes_afficheLignes':
	{
		$mail = $_POST['demandeurChoisi'];
		$lesLignes = $pdo->getLesLignes($mail);
		include("vues/v_validerLignes_afficheLignes.php");
		break;
	}
	case 'ValiderLignes_afficheLaLigne':
	{
		$date = $_POST["ligneChoisi"];
		$mail = $_REQUEST["demandeur"];
		$laLigne = $pdo->getLaLigne($mail,$date);
		include("vues/v_validerLignes_afficheLaLigne.php");
		break;
	}
	case 'confirmationLigne':
	{
		$message = "";
		$km = $_POST["km"];
		$peages = $_POST["peages"];
		$repas = $_POST["repas"];
		$hebergement = $_POST["hebergement"];
		$mail = $_REQUEST["mail"];
		$date = $_REQUEST["date"];
		if($pdo->validerLigne($mail, $date, $km, $peages, $repas, $hebergement))
		{
			$message = "La ligne de frais a bien été validée !";
			include("vues/v_message.php");
		}
		else
		{
			$message = "La ligne de frais n'a pas été validée";
			include("vues/v_message.php");

		}
		header("Refresh: 1; index.php?uc=gestionCompte&action=afficheMenu");
		break;
	}
	case 'creerFiche_listeDemandeurs':
	{
		$lesDemandeurs = $pdo->getLesDemandeurs();
		include("vues/v_creerFiche_listeDemandeurs.php");
		break;
	}
	case 'creerFiche_afficheFiche':
	{
		$mail = $_POST['demandeurChoisi'];
		$infosDemandeur = $pdo->getInfosDemandeur($mail);
		$nomClub = $pdo->getNomClub($mail);
		$lesLignesValidees = $pdo->getLesLignesValidees($mail);
		$listeAdherentsDuDemandeur = $pdo->getLesAdherentsDuDemandeur($mail);
		include("vues/v_creerFiche_afficheFiche.php");
		break;
	}
	case 'modifierSupprimerLigne':
	{
		$lesLignesNonValidees = $pdo->getLesLignesNonValidees($_SESSION['mail_user']);
		include("vues/v_modifierSupprimer_afficheLignes.php");
		break;
	}
	case 'modifierLigne':
	{
		$lesMotifs = $pdo->getLesMotifs();
		$mail = $_REQUEST['demandeur'];
		$date = $_REQUEST['date'];
		$laLigne = $pdo->getLaLigne($mail,$date);
		include("vues/v_modifierLigne.php");
		break;
	}
	case 'supprimerLigne':
	{
		$mail = $_REQUEST['demandeur'];
		$date = $_REQUEST['date'];
		$pdo->supprimerLigne($mail,$date);
		header("Refresh: 1; index.php?uc=gestionCompte&action=modifierSupprimerLigne");
		break;
	}
	case 'modificationLigne':
	{
		$message = "";
		$km = $_POST["km"];
		$trajet = $_POST['trajet'];
		$motif = $_POST["motifChoisi"];
		$peages = $_POST["peages"];
		$repas = $_POST["repas"];
		$hebergement = $_POST["hebergement"];
		$mail = $_REQUEST["demandeur"];
		$date = $_REQUEST["date"];
		if($pdo->modifierLigne($mail, $date, $motif, $trajet, $km, $peages, $repas, $hebergement))
		{
			$message = "La ligne de frais a bien été modifiée !";
			include("vues/v_message.php");
		}
		else
		{
			$message = "La ligne de frais n'a pas été modifiée";
			include("vues/v_message.php");

		}
		header("Refresh: 1; index.php?uc=gestionCompte&action=modifierSupprimerLigne");
		break;
	}
	case 'afficheAdherents':
	{
		$lesAdherents = $pdo->getLesAdherentsDuDemandeur($_SESSION['mail_user']);
		include("vues/v_afficheAdherents.php");
		break;
	}
	case 'supprimerAdherent':
	{
		$adherent = $_REQUEST['adherent'];
		$pdo->supprimerAdherentDuDemandeur($_SESSION['mail_user'], $adherent);
		header("Refresh: 1; index.php?uc=gestionCompte&action=afficheAdherents");
		break;
	}
	case 'ajoutAdherent':
	{
		$numLicence = $_POST['numLicence'];
		/*
		if($req = $pdo->ajouterAdherentAuDemandeur($_SESSION['mail_user'], $numLicence))
		{
			$message = "Ajout effectué !";
			include("vues/v_message.php");
		}
		else
		{
			$message = "Vérifiez que le licencié ne soit pas déjà dans votre liste ou que le numéro de licence soit correcte !";
			include("vues/v_message.php");
		}
		//header("Refresh: 1; index.php?uc=gestionCompte&action=afficheAdherents");

		*/
		switch($pdo->ajouterAdherentAuDemandeur($_SESSION['mail_user'], $numLicence))
		{
		case 'existePas':
		{
			$message = "Le licencié n'existe pas !";
			include("vues/v_message.php");
			break;
		}
		case 'dejaLie':
		{
			$message = "Ce licencié vous est déjà lié !";
			include("vues/v_message.php");
			break;
		}
		case 'ok':
		{
			$message = "Ajout effectué !";
			include("vues/v_message.php");
			break;
		}
	}
		break;
	}
}
?>