<ul>
	<li><a href="/admin">
		<div class="icon">
			<img src="/Icons/setting.png" alt="settings" class="param">
		</div>
		<div class="description">
			<h3>Préférence</h3>
			<p>Modifier les préférences</p>
		</div>
	</a></li>

	<li><a href="/admin/user">
		<div class="icon">
			<img src="/Icons/login.png" alt="login" class="param">
		</div>
		<div class="description">
			<h3>Utilisateur</h3>
			<p>Gestion des utilisateurs</p>
		</div>
	</a></li>

	<li><a href="/admin/addPicture">
		<div class="icon">
			<img src="/Icons/add.png" alt="image" class="param">
		</div>
		<div class="description">
			<h3>Image</h3>
			<p>Ajouter une image</p>
		</div>
	</a></li>

	<li><a href="/admin/addAlbum">
		<div class="icon">
			<img src="/Icons/add.png" alt="album" class="param">
		</div>
		<div class="description">
			<h3>Album</h3>
			<p>Ajouter un Album</p>
		</div>
	</a></li>
</ul>

<ul>
	<?php
	foreach($albums as $element){
	?>
	<li><a href="<?php echo '/admin/'.$element->getName()?>">
		<div class="icon">
			<img src="<?php echo '/'.$element->getThumb() ?>" alt="<?php echo $element->getName() ?>">
		</div>
		<div class="description">
			<h3><?php echo $element->getName() ?></h3>
			<p><?php echo $element->getDescription() ?></p>
		</div>
	</a></li>
	<?php } ?>
</ul>