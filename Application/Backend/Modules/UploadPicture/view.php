<div class="info">
	<h2>Ajouter une image</h2>
	<p>Merci de remplir tous les champs ci-dessous</p>
</div>	

<?php if(isset($txt)){ ?>
	<div class="msg">
		<p><?php echo $txt ?></p>
	</div>
<?php } ?>

<?php if($validation){?>
	<form class="add" action="/admin/addPicture" method="post" enctype="multipart/form-data">
		<fieldset>
			<legend><span class="form-step">1</span>Choisissez votre fichier</legend>
			<input type="file" name="fichier">
		</fieldset>	

		<fieldset>
			<legend><span class="form-step">2</span>Choisissez un nom et une description</legend>
			<input type="text" name="name" placeholder="Titre">
			<input type="text" name="description" placeholder="Description" >
		</fieldset>	

		<fieldset>
			<legend><span class="form-step">3</span>Choisissez votre album</legend>
			<select name="album">
			<?php foreach($albums as $album){
				echo '<option value="'.$album->getId().'">'.$album->getName().'</option>';
			}?>
			</select>
		</fieldset>	

		<fieldset>
			<legend><span class="form-step">4</span>Choisissez la visibilité</legend>
			<input type="radio" name="visibilite" value="1" id="public" /> <label for="public">Public</label>
			<input type="radio" name="visibilite" value="0" id="private" /> <label for="private">Privé</label>
		</fieldset>	

		<input type="submit" name="addpicture" value="Ajouter">
	</form>
<?php } else{ ?>
	<div class="msg">
		<p>Merci de bien vouloir créer un album avant d'uploader une image</p>
	</div>
<?php } ?>
