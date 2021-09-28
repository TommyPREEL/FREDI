<div class="login-page">
  <div class="form">
    <form class="register-form" action = "index.php?uc=gestionCompte&action=confirmationLigne&date=<?php echo $date;?>&mail=<?php echo $mail;?>" method = "POST">
      <h1>Validation d'une ligne de frais</h1>
      <p>Date</p>
      <input type="text" value="<?php echo $laLigne['DATE_FRAIS'];?>"disabled/>
      <p>Motif</p>
      <input type="text" value="<?php echo $laLigne['LIBELLE'];?>"disabled/>
      <p>Trajet</p>
      <input type="text" value="<?php echo $laLigne['TRAJET'];?>"disabled/>
      <p>Nombre de km</p>
      <input type="text" value="<?php echo $laLigne['KM'];?>"disabled/>
      <p>Cout des péages</p>
      <input type="text" value="<?php echo $laLigne['COUT_PEAGE'];?>"disabled/>
      <p>Cout des repas</p>
      <input type="text" value="<?php echo $laLigne['COUT_REPAS'];?>"disabled/>
      <p>Cout de l'hébergement</p>
      <input type="text" value="<?php echo $laLigne['COUT_HEBERGEMENT'];?>"disabled/>
      <p>Nombre de km validés</p>
      <input type="number" min="0" step="1" placeholder="Nombre de km" name="km" required/>
      <p>Cout des péages validés</p>
      <input type="number" min="0" step="0.01" placeholder="Coût des péages" name="peages" required/>
      <p>Cout des repas validés</p>
      <input type="number" min="0" step="0.01" placeholder="Coût des repas" name="repas"required/>
      <p>Cout de l'hébergement validé</p>
      <input type="number" min="0" step="0.01" placeholder="Coût de l'hébergement" name="hebergement"required/>

      <button>Valider la ligne de frais</button>
    </form>
    </div>
</div>