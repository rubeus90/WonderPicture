<?php if(isset($txt)){ ?>
	<div class="msg">
		<p><?php echo $txt ?></p>
	</div>
<?php } ?>

<form class="add" action="" method="post">
	<fieldset>
		<legend><span class="form-step">1</span>Votre identité</legend>
		<input type="text" name="login" placeholder="Identifiant">
		<input type="email" name="email" placeholder="Email">
	</fieldset>	

	<fieldset>
		<legend><span class="form-step">2</span>Votre mot de passe</legend>
		<input type="password" name="mdp" placeholder="Mot de passe">
		<input type="password" name="mdpv" placeholder="Vérification de mot de passe">
	</fieldset>	

	<fieldset>
		<legend><span class="form-step">3</span>Votre avatar</legend>
		<input type="text" name="avatar" placeholder="URL Avatar">
	</fieldset>	

	<input type="submit" name="add" value="S'enregistrer">
</form>