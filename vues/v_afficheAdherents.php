<div class="login-page">
  <div class="form">
      <form method = "POST" action = "index.php?uc=gestionCompte&action=ajoutAdherent">
        <h1>Ajouter un licencié</h1>
      <p>Entrer un numéro de licence</p>
      <input type = "number" step="1" name = "numLicence"/>
      <button>Valider</button>
      </form>
<br/><br/><br/>
      <?php

      if(sizeof($lesAdherents) != 0)
      {
      ?>
      <h1>Liste de vos licenciés</h1>
      <?php
        foreach($lesAdherents as $unAdherent) 
        {
      ?>
          <input type="text" value="<?php echo $unAdherent['NOM']." ".$unAdherent['PRENOM']." licence n° ".$unAdherent['NUMERO_LICENCE'];?>"disabled/>
          <a href="index.php?uc=gestionCompte&action=supprimerAdherent&adherent=<?php echo $unAdherent['NUMERO_LICENCE']?>" onClick="return confirm ('Etes-vous sûr(e) de vouloir supprimer ce licencié de votre liste?')">Supprimer</a>
          <br/><br/><br/><br/>
      <?php
        }
  }
  else
  {
    ?>
    <p>Vous n'avez aucun licencié</p>
    <form class="register-form" action = "index.php?uc=gestionCompte&action=afficheMenu" method = "POST">
    <button>Retour</button>
    <?php
  }
    ?>
    </div>
</div>