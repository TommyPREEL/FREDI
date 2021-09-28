<div class="login-page">
  <div class="form">
    <h1>Modifier/Supprimer une ligne de frais</h1>
    <?php
      if(sizeof($lesLignesNonValidees) != 0)
      {
      ?>
    <form class="register-form" action = "index.php?uc=gestionCompte&action=afficheMenu" method = "POST">
      
      <p>Choisir la ligne de frais à modifier/supprimer</p>

      <?php
        foreach($lesLignesNonValidees as $uneLigne) 
        {
      ?>
          <table border = 1 class="table-fill2">
            <tr>
              <td>Date</td>
              <td>Motif</td>
              <td>Trajet</td>
              <td>Nombre de kms</td>
              <td>Cout des péages</td>
              <td>Cout des repas</td>
              <td>Cout de l'hébergement</td>
            </tr>
            <tr>
              <td><?php echo $uneLigne['DATE_FRAIS'];?></td>
              <td><?php echo $uneLigne['LIBELLE'];?></td>
              <td><?php echo $uneLigne['TRAJET'];?></td>
              <td><?php echo $uneLigne['KM'];?></td>
              <td><?php echo $uneLigne['COUT_PEAGE'];?></td>
              <td><?php echo $uneLigne['COUT_REPAS'];?></td>
              <td><?php echo $uneLigne['COUT_HEBERGEMENT'];?></td>
            </tr>
          </table>
            <a href="index.php?uc=gestionCompte&action=modifierLigne&demandeur=<?php echo $uneLigne['ADRESSE_MAIL']?>&date=<?php echo $uneLigne['DATE_FRAIS']?>"><p>Modifier</p></a>

            <a href="index.php?uc=gestionCompte&action=supprimerLigne&demandeur=<?php echo $uneLigne['ADRESSE_MAIL']?>&date=<?php echo $uneLigne['DATE_FRAIS']?>" onClick="return confirm ('Etes-vous sûr(e) de vouloir supprimer cette ligne de frais?')"><p>Supprimer</p></a>
            <br/><br/>
      <?php
        }
      ?>
      <button>Retour</button>
    </form>
    <?php
  }
  else
  {
    ?>
    <p>Vous n'avez pas encore enregistré de ligne de frais</p>
    <form class="register-form" action = "index.php?uc=gestionCompte&action=afficheMenu" method = "POST">
    <button>Retour</button>
    <?php
  }
    ?>
    </div>
</div>