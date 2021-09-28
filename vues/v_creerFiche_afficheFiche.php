<div class="login-page">
  <div class="form">
    <h1>Fiche de frais</h1>
    <?php
      if(sizeof($lesLignesValidees) != 0)
      {
      ?>
    <form class="register-form" action = "index.php?uc=gestionCompte&action=creerFiche_listeDemandeurs" method = "POST">

      <p>Je soussigné(e)</p>
      <input type="text" value="<?php echo $infosDemandeur['NOM']." ".$infosDemandeur['PRENOM'];?>"disabled/>
      <p>Demeurant</p>
      <input type="text" value="<?php echo $infosDemandeur['RUE']." ".$infosDemandeur['CP']." ".$infosDemandeur['VILLE'];?>"disabled/>
      <p>Appartenant au club</p>
      <input type="text" value="<?php echo $nomClub;?>"disabled/>
      <p>Frais de déplacement : Tarif kilométrique appliqué pour le remboursement : 0,28 €</p><br/>
      <table border = 1 class="table-fill">
        <tr>
          <td>Date jj/mm/aaaa</td>
          <td>Motif</td>
          <td>Trajet</td>
          <td>Kms parcourus</td>
          <td>Coût Trajet</td>
          <td>Péages</td>
          <td>Repas</td>
          <td>Hébergement</td>
          <td>Total</td>
        </tr>
        <?php
        $totalLignes = 0.00;
        foreach($lesLignesValidees as $uneLigne) 
        {
        ?>
        <tr>
          <td><?php echo $uneLigne['DATE_FRAIS']?></td>
          <td><?php echo $uneLigne['LIBELLE']?></td>
          <td><?php echo $uneLigne['TRAJET']?></td>
          <td><?php echo $uneLigne['KM_VALIDE']?></td>
          <?php $trajet = doubleval($uneLigne['KM_VALIDE'])*0.28; ?>
          <td><?php echo $trajet; ?> €</td>
          <td><?php echo $uneLigne['PEAGE_VALIDE']?> €</td>
          <td><?php echo $uneLigne['REPAS_VALIDE']?> €</td>
          <td><?php echo $uneLigne['HEBERGEMENT_VALIDE']?> €</td>
          <?php $totalUneLigne = $trajet + doubleval($uneLigne['PEAGE_VALIDE']) + doubleval($uneLigne['REPAS_VALIDE']) + doubleval($uneLigne['HEBERGEMENT_VALIDE']); ?>
          <td><?php echo $totalUneLigne?> €</td>

          <?php $totalLignes += $totalUneLigne; ?>
          </tr>
          
          <?php
          }
          ?>
          <tr>
          <td colspan = '8'>Montant total des frais de déplacement</td>
          <td><?php echo $totalLignes ?> €</td>
        </tr>
      </table>
      <br/><br/>
       <p>Je suis le représentant légal des adhérents suivants :</p>
       <?php
       if(sizeof($listeAdherentsDuDemandeur != 0))
       {
       foreach($listeAdherentsDuDemandeur as $unAdherent) 
        {
        ?>
      <input type="text" value="<?php echo $unAdherent['NOM']." ".$unAdherent['PRENOM']." licence n° ".$unAdherent['NUMERO_LICENCE'];?>"disabled/>
      <?php
        }
      }
      else
      {
        echo "<p>Ce demandeur n'est lié à aucun adhérent.</p>";
      }
      ?>
      <br>
      <p>Je souhaite : (cocher une case)</p>

      <p>être remboursé de mes frais</p><input type = checkbox> 
      <br/><br/>
      <p>faire don de mes frais</p><input type = checkbox>
      <br/><br/>
      <p>Fait le</p><input type='text' disabled>
      <p>A</p><input type='text'disabled>
      <p>Signature du bénévole</p><input type='text' disabled>

      <h2>Partie réservée à l'association</h2>
      <p>Numero d'ordre du reçu</p><input type='text' value = '<?php echo $infosDemandeur['NUM_RECU'];?>'disabled>
      <p>Remis le</p><input type='text' disabled>
      <p>Signature du trésorier</p><input type='text' disabled>

      <button>Retour</button>
    </form>
    <?php
  }
  else
  {
    ?>
    <p>Ce demandeur n'a enregistré aucune ligne de frais</p>
    <form class="register-form" action = "index.php?uc=gestionCompte&action=creerFiche_listeDemandeurs" method = "POST">
    <button>Retour</button>
    <?php
  }
    ?>
    </div>
</div>