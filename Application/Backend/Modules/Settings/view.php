<div class="info">
	<h2>Paramètre de votre galerie photo</h2>
	<p>Choississez vos paramètres</p>
</div>

<?php if(isset($txt)){ ?>
	<div class="msg">
		<p><?php echo $txt ?></p>
	</div>
<?php } ?>


<form class="add" action="/admin" method="post">
	<fieldset>
		<legend><span class="form-step">1</span>Options des miniatures</legend>
		<input type="number" name="thumb_size" placeholder="Taille - 400 par défaut">
		<input type="number" name="thumb_quality" placeholder="Qualité - 75 par défaut">
	</fieldset>	

	<fieldset>
		<legend><span class="form-step">2</span>Ordre d'affichage des albums</legend>
		<select name="order_album">
			<option value=""></option>
			<option value="date">Date</option>
			<option value="nom">Nom</option>
		</select>
	</fieldset>	

	<fieldset>
		<legend><span class="form-step">3</span>Ordre d'affichage des images</legend>
		<select name="order_picture">
			<option value=""></option>
			<option value="date">Date</option>
			<option value="name">Nom</option>
		</select>
	</fieldset>

	<fieldset>
		<legend><span class="form-step">4</span>Nombre d'image à afficher sur la page d'accueil</legend>
		<input type="number" name="nombre" placeholder="Nombre - 20 par défaut">
	</fieldset>	

	<input type="submit" name="add" value="Mettre à jour">
</form>