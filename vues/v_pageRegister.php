<div class="login-page">
  <div class="form">
    <form class="register-form" name = "formInscription" action = "index.php?uc=gestionUser&action=inscription" method = "POST">
      <input type="text" placeholder="Adresse mail" name="mail"/>
      <input type="password" placeholder="Mot de Passe" name="mdp"/>
      <input type="text" placeholder="Nom" name="nom"/>
      <input type="text" placeholder="Prénom" name="prenom"/>
      <input type="text" placeholder="Rue" name="rue"/>
      <input type="text" placeholder="Code Postal" name="cp"/>
      <input type="text" placeholder="Ville" name="ville"/>

      <button>Créer</button>
      <p class="message">Déjà enregistré? <a href="index.php?uc=gestionUser&action=formLogin">Se connecter</a></p>
    </form>
    </div>
</div>