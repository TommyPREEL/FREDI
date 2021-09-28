 <div class="login-page">
  <div class="form">
    <form class="register-form" action = "index.php?uc=gestionCompte&action=creationLigne" method = "POST">
      <h1>Création d'une ligne de frais</h1>
      <p>Date</p>
      <input type="date" placeholder="Date" name="date"/>
      <p>Motif</p>
      <select name = "motifChoisi">
      <?php
      $compteur = 1;
        foreach($lesMotifs as $unMotif) 
        {
          $motif = $unMotif['LIBELLE'];
          echo "<option value = '".$motif."'".$compteur."'>".$motif."</option>";
          $compteur++;
        }
      ?>
      </select>
      <p>Trajet</p>
      <input type="text" placeholder="Trajet" name="trajet"/>
      <p>Nombre de km</p>
      <input type="number" min="0" step="1" value="0" placeholder="Nombre de km" name="km"/>
      <p>Cout des péages</p>
      <input type="number" min="0" step="0.01" value="0" placeholder="Coût des péages" name="peages"/>
      <p>Cout des repas</p>
      <input type="number" min="0" step="0.01" value="0" placeholder="Coût des repas" name="repas"/>
      <p>Cout de l'hébergement</p>
      <input type="number" min="0" step="0.01" value="0" placeholder="Coût de l'hébergement" name="hebergement"/>

      <button>Créer la ligne de frais</button>
    </form>
    </div>
</div>