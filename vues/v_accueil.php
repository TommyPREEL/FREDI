<div class="page">
  <nav class="menu">
    <ul class="menu__list">
      <li class="menu__group"><a href="index.php?uc=presentation" class="menu__link">Présentation</a></li>
      <?php initUser();
      if ($_SESSION["connecte"] == false)
      {
       	echo '<li class="menu__group"><a href="index.php?uc=gestionUser&action=formLogin" class="menu__link">Se connecter</a></li>';
      }
      else
      {
      	echo '<li class="menu__group"><a href="index.php?uc=gestionCompte&action=afficheMenu" class="menu__link">Compte</a></li>';

      	echo '<li class="menu__group"><a href="index.php?uc=gestionUser&action=deconnexion" class="menu__link">Se déconnecter</a></li>';

      	echo '<li class="menu__link_name">'.$_SESSION["statut_user"].'<br/>Bonjour '.$_SESSION["nom_user"].' '.$_SESSION["prenom_user"].'</li>';
      }
      ?>

    </ul>
  </nav>
</div>