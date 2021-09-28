<div class="login-page">
  <div class="form">
    <form class="register-form" action = "index.php?uc=gestionCompte&action=ValiderLignes_afficheLignes" method = "POST">
      <h1>Valider une/des ligne(s) de frais</h1>
      <p>Chosir le demandeur</p>
      <select name = "demandeurChoisi">
      <?php
      $compteur = 1;
        foreach($lesDemandeurs as $unDemandeur) 
        {
          $adresse_mail_demandeur = $unDemandeur['ADRESSE_MAIL'];
          $nom_demandeur = $unDemandeur['NOM'];
          $prenom_demandeur = $unDemandeur['PRENOM'];
          echo "<option value = '".$adresse_mail_demandeur."'".$compteur."'>".$nom_demandeur." ".$prenom_demandeur." ".$adresse_mail_demandeur."</option>";
          $compteur++;
        }
      ?>
      </select>
      <button>Valider</button>
    </form>
    </div>
</div>