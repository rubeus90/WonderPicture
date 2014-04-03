<div class="info">
	<h2>Ajouter un album</h2>
	<p>Merci de remplir tous les champs ci-dessous</p>
</div>	

<?php if(isset($txt)){ ?>
	<div class="msg">
		<p><?php echo $txt ?></p>
	</div>
<?php } ?>

<form class="add" action="/admin/addAlbum" method="post" enctype="multipart/form-data">
	<fieldset>
		<legend><span class="form-step">1</span>Choisissez un nom et une description</legend>
		<input type="text" name="name" placeholder="Titre">
		<input type="text" name="description" placeholder="Description" >
	</fieldset>	

	<fieldset>
		<legend><span class="form-step">2</span>Choisissez une miniature</legend>
		<input type="file" name="fichier">
	</fieldset>	

	<fieldset>
		<legend><span class="form-step">3</span>Choisissez la visibilité</legend>
		<input type="radio" id="public" name="visibilite" value="1"/><label for="public">Public</label>
		<input type="radio" id="private" name="visibilite" value="0"/><label for="private">Privé</label>
	</fieldset>	

	<input type="submit" name="addalbum" value="Ajouter">
</form>