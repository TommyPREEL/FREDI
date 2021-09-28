<div class="login-page">
  <div class="form">
    <h1>Valider une/des ligne(s) de frais</h1>
    <?php
      if(sizeof($lesLignes) != 0)
      {
      ?>
    <form class="register-form" action = "index.php?uc=gestionCompte&action=ValiderLignes_afficheLaLigne&demandeur=<?php echo $mail; ?>" method = "POST">
      
      <p>Choisir la ligne de frais à valider</p>
      <select name = "ligneChoisi">
      <?php
      $compteur = 1;
        foreach($lesLignes as $uneLigne) 
        {
          $date = $uneLigne['DATE_FRAIS'];
          $motif = $uneLigne['LIBELLE'];
          echo "<option value = '".$date."''".$compteur."'>".$date." ".$motif."</option>";
          $compteur++;
        }
      ?>
      </select>
      <button>Valider</button>
    </form>
    <?php
  }
  else
  {
    ?>
    <p>Ce demandeur n'a enregistré aucune ligne de frais</p>
    <form class="register-form" action = "index.php?uc=gestionCompte&action=ValiderLignes_listeDemandeurs" method = "POST">
    <button>Retour</button>
    <?php
  }
    ?>
    </div>
</div>