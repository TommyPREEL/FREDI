<?php
/**
 * Classe d'accès aux données. 
 * Utilise les services de la classe PDO
 * pour l'application FREDI
 * Les attributs sont tous statiques,
 * les 4 premiers pour la connexion
 * $monPdo de type PDO 
 * $monPdoFredi qui contiendra l'unique instance de la classe
 *
 * @package default
 * @author Preel, Pinsolles
 * @version    1.0

 */

class PdoFredi
{   		
      	private static $monPdo;
		private static $monPdoFredi = null;
/**
 * Constructeur privé, crée l'instance de PDO qui sera sollicitée
 * pour toutes les méthodes de la classe
 */	
	private function __construct()
	{
    		PdoFredi::$monPdo = new PDO('mysql:host=127.0.0.1;dbname=fredi', 'root', 'root'); 
			PdoFredi::$monPdo->query("SET CHARACTER SET utf8");
	}

	public function __destruct(){
		PdoFredi::$monPdo = null;
	}

 	public  static function getPdoFredi()
	{
		if(PdoFredi::$monPdoFredi == null)
		{
			PdoFredi::$monPdoFredi= new PdoFredi();
		}
		return PdoFredi::$monPdoFredi;  
	}
/** Fonction pour tester si la combinaison mdp-mail est dans la table trésorier ou Demandeurs
* @param mail et mdp
* Retourne un booleen
*/
	public function testLogin($mail,$mdp)
	{
		$ok = false;
		$req = "select * from tresoriers where adresse_mail = '$mail' AND mot_de_passe = '$mdp'";
		$res = PdoFredi::$monPdo->query($req);
		$nbLignes = $res->rowCount();
		if($nbLignes == 1)
		{
			$ok = true;
		}
		else
		{
			$req = "select * from demandeurs where adresse_mail = '$mail' AND mot_de_passe = '$mdp'";
			$res = PdoFredi::$monPdo->query($req);
			$nbLignes = $res->rowCount();
			if($nbLignes == 1)
			{
				$ok = true;
			}
		}
		return $ok;
	}

/** Fonction pour savoir si l'utilisateur est un trésorier ou un demandeur
* @param mail et mdp
* Retourne un booleen
*/
	public function getStatut($mail,$mdp)
	{
		$statut = "";
		$req = "select * from tresoriers where adresse_mail = '$mail' AND mot_de_passe = '$mdp'";
		$res = PdoFredi::$monPdo->query($req);
		$nbLignes = $res->rowCount();
		if($nbLignes == 1)
		{
			$statut = "Tresorier";
		}
		else
		{
			$req = "select * from demandeurs where adresse_mail = '$mail' AND mot_de_passe = '$mdp'";
			$res = PdoFredi::$monPdo->query($req);
			$nbLignes = $res->rowCount();
			if($nbLignes == 1)
			{
				$statut = "Demandeur";
			}
		}
		return $statut;
	}

/** Fonction pour récupérer les informations de l'utilisateur dans un tableau
* @param $mail
* @param $mdp
* @param $statut
* @return $tabInfos
*/
	public function getInfosUser($mail,$mdp,$statut)
	{
		if($statut == "Demandeur")
		{
			$req = "select * from demandeurs where adresse_mail = '$mail' AND mot_de_passe = '$mdp'";
		}
		else
		{
			$req = "select * from tresoriers where adresse_mail = '$mail' AND mot_de_passe = '$mdp'";
		}
		$res = PdoFredi::$monPdo->query($req);
		$tabInfos = $res->fetch();
		return $tabInfos;
	}

/** Fonction pour inscrire l'utilisateur
* @param $mail
* @param $nom
* @param $prenom
* @param $cp
* @param $ville
* @param $telephone
* @param $mdp
*/
	public function inscription($mail, $nom, $prenom, $rue, $cp, $ville, $num, $mdp)
	{
		$req = "INSERT INTO demandeurs VALUES ('$mail','$nom','$prenom','$rue','$cp','$ville','$num','$mdp')";
		$res = PdoFredi::$monPdo->exec($req);
	}

/** Fonction pour recuperer le numero du dernier demandeur et creer le suivant
* @return $num
*/
	public function getDernierNumeroDemandeur()
	{
		$req = "select max(num_recu) from demandeurs";
		$res = PdoFredi::$monPdo->query($req);
		if($res->rowCount() != 0)
			$num = $res->fetchColumn();
		else
			$num = 0;
		return $num;
	}
/** Fonction pour récupérer les motifs de la bdd
* @return $lesMotifs
*/
	public function getLesMotifs()
	{
		$req = "select * from motifs";
		$res = PdoFredi::$monPdo->query($req);
		$lesMotifs = $res->fetchAll();
		return $lesMotifs;
	}
/** Fonction qui cree une ligne de frais
* @param $date
* @param $motif
* @param $trajet
* @param $km
* @param $peages
* @param $repas
* @param $hebergement
* @return $ok
*/
	public function creationLigneFrais($mail, $date, $motif, $trajet, $km, $peages, $repas, $hebergement)
	{
		$ok = false;
		$req = "INSERT INTO lignes_frais VALUES ('$mail','$date','$motif','$trajet',".$km.",".$peages.",".$repas.",".$hebergement.",0,0,0,0)";
		if($res = PdoFredi::$monPdo->exec($req))
		{
			$ok = true;
		}
		return $ok;
	}
/** Fonction pour récupérer les demandeurs de la bdd
* @return $lesDemandeurs
*/
	public function getLesDemandeurs()
	{
		$req = "select * from demandeurs";
		$res = PdoFredi::$monPdo->query($req);
		$lesDemandeurs = $res->fetchAll();
		return $lesDemandeurs;
	}

/** Fonction pour récupérer les lignes de frais d'un demandeur
* @param $mail
* @return $lesLignes
*/
	public function getLesLignes($mail)
	{
		$req = "select * from lignes_frais where ADRESSE_MAIL ='$mail'";
		$res = PdoFredi::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}

/** Fonction pour récupérer la ligne de frais d'un demandeur à une certaine date
* @param $mail
* @param $date
* @return $laLigne
*/
	public function getLaLigne($mail,$date)
	{
		$req = "select * from lignes_frais where ADRESSE_MAIL ='$mail' AND DATE_FRAIS = '$date'";
		$res = PdoFredi::$monPdo->query($req);
		$laLigne = $res->fetch();
		return $laLigne;
	}

/** Fonction pour valider les valeurs d'une ligne de frais
* @param $mail
* @param $date
* @param $km
* @param $peages
* @param $repas
* @param $hebergement
* @return $ok
*/
	public function validerLigne($mail,$date,$km,$peages,$repas,$hebergement)
	{
		$ok = false;
		$req = "update lignes_frais set KM_VALIDE = $km, PEAGE_VALIDE = $peages, REPAS_VALIDE = $repas, HEBERGEMENT_VALIDE = $hebergement where ADRESSE_MAIL ='$mail' AND DATE_FRAIS = '$date'";
		if($res = PdoFredi::$monPdo->exec($req))
		{
			$ok = true;
		}
		return $ok;
	}

/** Fonction pour récupérer les informations du demandeur
* @param $mail
* @return $tabInfos
*/
	public function getInfosDemandeur($mail)
	{
		$req = "select * from demandeurs where adresse_mail = '$mail'";
		$res = PdoFredi::$monPdo->query($req);
		$tabInfos = $res->fetch();
		return $tabInfos;
	}

/** Fonction pour récupérer le nom du club d'un demandeur
* @param $mail
* @return $nomClub
*/
	public function getNomClub($mail)
	{
		$req = "select NOM_CLUB from club,adherents,demandeurs,rel_1 where demandeurs.ADRESSE_MAIL = rel_1.ADRESSE_MAIL AND rel_1.NUMERO_LICENCE = adherents.NUMERO_LICENCE AND adherents.NUM_CLUB = club.NUM_CLUB AND demandeurs.ADRESSE_MAIL ='$mail' ";
		$res = PdoFredi::$monPdo->query($req);
		$lesLignes = $res->fetch();
		$nomClub = $lesLignes["NOM_CLUB"];
		return $nomClub;
	}

/** Fonction pour récupérer les lignes de frais validées d'un demandeur
* @param $mail
* @return $lesLignesValidees
*/
	public function getLesLignesValidees($mail)
	{
		$req = "select * from lignes_frais where ADRESSE_MAIL ='$mail' AND KM_VALIDE != 0";
		$res = PdoFredi::$monPdo->query($req);
		$lesLignesValidees = $res->fetchAll();
		return $lesLignesValidees;
	}

/** Fonction pour récupérer les lignes de frais d'un demandeur non validés
* @param $mail
* @return $lesLignesNonValidees
*/
	public function getLesLignesNonValidees($mail)
	{
		$req = "select * from lignes_frais where ADRESSE_MAIL ='$mail' AND KM_VALIDE = 0";
		$res = PdoFredi::$monPdo->query($req);
		$lesLignesNonValidees = $res->fetchAll();
		return $lesLignesNonValidees;
	}

/** Fonction pour récupérer les infos des ahdérents du demandeur passé en paramètre
* @param $mail
* @return $listeAdherents
*/
	public function getLesAdherentsDuDemandeur($mail)
	{
		$req = "select * from adherents,rel_1 where rel_1.NUMERO_LICENCE = adherents.NUMERO_LICENCE AND rel_1.ADRESSE_MAIL ='$mail' ";
		$res = PdoFredi::$monPdo->query($req);
		$listeAdherents = $res->fetchAll();
		return $listeAdherents;
	}

/** Fonction pour supprimer la ligne de frais d'un demandeur à une certaine date
* @param $mail
* @param $date
*/
	public function supprimerLigne($mail,$date)
	{
		$req = "delete from lignes_frais where ADRESSE_MAIL ='$mail' AND DATE_FRAIS = '$date'";
		$res = PdoFredi::$monPdo->exec($req);
	}

/** Fonction qui modifie une ligne de frais
* @param $date
* @param $motif
* @param $trajet
* @param $km
* @param $peages
* @param $repas
* @param $hebergement
* @return $ok
*/
	public function modifierLigne($mail, $date, $motif, $trajet, $km, $peages, $repas, $hebergement)
	{
		$ok = false;
		$req = "update lignes_frais set LIBELLE = '$motif', TRAJET = '$trajet', KM = $km, COUT_PEAGE = $peages, COUT_REPAS = $repas, COUT_HEBERGEMENT = $hebergement where ADRESSE_MAIL ='$mail' AND DATE_FRAIS = '$date'";
		if($res = PdoFredi::$monPdo->exec($req))
		{
			$ok = true;
		}
		return $ok;
	}

/** Fonction pour supprimer l'adherent relié au demandeur
* @param $demandeur
* @param $adherent
*/
	public function supprimerAdherentDuDemandeur($demandeur,$adherent)
	{
		$req = "delete from rel_1 where ADRESSE_MAIL ='$demandeur' AND NUMERO_LICENCE = $adherent";
		$res = PdoFredi::$monPdo->exec($req);
	}

/** Fonction pour ajouter l'adherent au demandeur
* @param $demandeur
* @param $adherent
* @return $ok
*/
	public function ajouterAdherentAuDemandeur($demandeur,$adherent)
	{
		$ok = "existePas";
		$req = "select NUMERO_LICENCE from adherents where NUMERO_LICENCE = $adherent";
		$res = PdoFredi::$monPdo->query($req);
		if($res->rowCount() != 0)
		{
			$req2 = "select NUMERO_LICENCE from rel_1 where ADRESSE_MAIL = '$demandeur' AND NUMERO_LICENCE = $adherent <> (select NUMERO_LICENCE from adherents where NUMERO_LICENCE = $adherent)";
			$res2 = PdoFredi::$monPdo->query($req2);
			if($res2->rowCount() == 0)
			{
				$req3 = "INSERT INTO rel_1 VALUES ('$demandeur',$adherent)";
				if($res3 = PdoFredi::$monPdo->exec($req3))
				{
					$ok = "ok";
				}
			}
			else
			{
				$ok = "dejaLie";
			}
		}
		return $ok;
	}
}
?>