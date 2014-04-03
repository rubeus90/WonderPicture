
<div class="info">
	<div class="icon">
		<img src="<?php echo $user->getAvatar() ?>" alt="<?php echo $user->getName() ?>">
	</div>
	<div class="description">
		<h3><?php echo $user->getName() ?></h3>
		<p><?php echo $user->getEmail() ?></p>
	</div>
</div>

<?php if(isset($txt)){ ?>
	<div class="msg">
		<p><?php echo $txt ?></p>
	</div>
<?php } ?>

<form class="add" action="" method="post">
	<fieldset>
		<legend><span class="form-step">1</span>Changez votre mot de passe</legend>
		<input type="password" name="mdp" placeholder="Mot de passe">
		<input type="password" name="mdpv" placeholder="Vérification de mot de passe">
	</fieldset>

	<fieldset>
		<legend><span class="form-step">2</span>Changez votre EMail</legend>
		<input type="text" name="email" placeholder="Mail">
	</fieldset>	

	<fieldset>
		<legend><span class="form-step">3</span>Changez votre avatar</legend>
		<input type="text" name="avatar" placeholder="URL Avatar">
	</fieldset>	

	<input type="submit" name="update" value="Mettre à jour">
</form>