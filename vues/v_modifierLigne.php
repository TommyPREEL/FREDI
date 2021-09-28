<div class="login-page">
  <div class="form">

    <form class="register-form" action = "index.php?uc=gestionCompte&action=modificationLigne&demandeur=<?php echo $laLigne['ADRESSE_MAIL']?>&date=<?php echo $laLigne['DATE_FRAIS']?>" method = "POST">
      
    <h1>Modification d'une ligne de frais</h1>
      <p>Date</p>
      <input type="date" placeholder="Date" name="date" value = "<?php echo $laLigne['DATE_FRAIS']?>"/>
      <p>Motif</p>
      <select name = "motifChoisi">
      <?php
      $compteur = 1;
        foreach($lesMotifs as $unMotif) 
        {
          $motif = $unMotif['LIBELLE'];
          if($motif == $laLigne['LIBELLE'])
          {
             echo "<option selected value = '".$motif."'".$compteur."'>".$motif."</option>";
          }
          else
          {
          echo "<option value = '".$motif."'".$compteur."'>".$motif."</option>";
          }
          $compteur++;
        }
      ?>
      </select>
      <p>Trajet</p>
      <input type="text" placeholder="Trajet" name="trajet" value = "<?php echo $laLigne['TRAJET']?>"/>
      <p>Nombre de km</p>
      <input type="number" min="0" step="1" value = "<?php echo $laLigne['KM']?>" placeholder="Nombre de km" name="km"/>
      <p>Cout des péages</p>
      <input type="number" min="0" step="0.01" value = "<?php echo $laLigne['COUT_PEAGE']?>" placeholder="Coût des péages" name="peages"/>
      <p>Cout des repas</p>
      <input type="number" min="0" step="0.01" value = "<?php echo $laLigne['COUT_REPAS']?>" placeholder="Coût des repas" name="repas"/>
      <p>Cout de l'hébergement</p>
      <input type="number" min="0" step="0.01" value = "<?php echo $laLigne['COUT_HEBERGEMENT']?>" placeholder="Coût de l'hébergement" name="hebergement"/>

      <button>Modifier la ligne de frais</button>
    </form>
    </div>
</div>