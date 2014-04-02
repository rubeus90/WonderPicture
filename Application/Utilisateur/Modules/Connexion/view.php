<section>
	<div class="content">
		<h3>Je possède un compte</h3>
		<?php if(isset($txt)){ ?>
			<div class="msg">
				<p><?php echo $txt ?></p>
			</div>
		<?php } ?>
		<form method="post" action="/Connexion" class="connexion">
			<fieldset>
				<input type="text" name="login" placeholder="Identifiant" required>
				<input type="password" name="mdp" placeholder="Mot de passe" required>
			</fieldset>	
			<input type="submit" name="connexion" value="Continuer">
		</form>
	</div>

	<div class="content">
	    <h3>Je ne possède pas de compte</h3>
	    <a href="/Register">M'inscrire</a>
	</div>
</section>