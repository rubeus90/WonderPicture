<form method="post" action="/admin/<?php echo $album->getName() ?>" class="album">
	<button type="submit" name="erasealbum">Supprimer</button>
	<button type="submit" name="editalbum">Editer</button>
	<input type="hidden" name="id" value="<?php echo $album->getId() ?>">
	<h2><?php echo $album->getName() ?></h2>
	<p><?php echo $album->getDescription() ?></p>
	<select name="visibilite">
		<option value="1" <?php if($album->isPublic()){ echo 'selected';}?>>Public</option>
		<option value="0" <?php if(!$album->isPublic()){ echo 'selected';}?>>Privé</option>
	</select>
</form>

<?php foreach($pictures as $picture){ ?>
<form method="post" action="/admin/<?php echo $album->getName() ?>" class="picture">
	<button type="submit" name="erase">Supprimer</button>
	<button type="submit" name="edit">Editer</button>
	<input type="hidden" name="id" value="<?php echo $picture->getId() ?>">
	<div class="inline">
		<img src="<?php echo '/'.$picture->getUrlmin() ?>" alt="thumb"/>
	</div>
	<div class="inline">
		<div>
			<h3><?php echo $picture->getName() ?></h3>
		</div>
		<div>
			<p><?php echo $picture->getDescription() ?></p>
		</div>
		<div>
			<select name="visibilite">
				<option value="1" <?php if($picture->isPublic()){ echo 'selected';}?>>Public</option>
				<option value="0" <?php if(!$picture->isPublic()){ echo 'selected';}?>>Privé</option>
			</select>
			<select name="album">
				<?php foreach($albums as $element){?>
					<option value="<?php echo $album->getId(); ?>" <?php if($picture->getAlbum_id() == $element->getId()){ echo 'selected';}?>> <?php echo $element->getName(); ?></option>';
				<?php }?>
			</select>
		</div>
	</div>
</form>
<?php 
} ?>