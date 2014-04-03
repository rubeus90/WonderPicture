<div class="info">
	<h2>Gestionnaire des Utilisateurs</h2>
	<p>Choississez vos paramètres</p>
</div>

<?php foreach($users as $user){
	if(($statut = $user->getStatut()) != 2){?>
	<form method="post" action="/admin/user" class="picture">
	
		<?php if($statut == 1 ){?>
			<button type="submit" name="banish">Bannir</button>
		<?php }else{ ?>
			<button type="submit" name="refuse">Refuser</button>
			<button type="submit" name="accept">Accepter</button>
		<?php } ?>

		<input type="hidden" name="id" value="<?php echo $user->getId() ?>">
		<div class="inline">
			<img src="<?php echo $user->getAvatar() ?>" alt="Avatar"/>
		</div>
		<div class="inline">
			<div>
				<h3><?php echo $user->getName() ?></h3>
			</div>
			<div>
				<p><?php echo $user->getEmail() ?></p>
			</div>
		</div>
	
	</form>
<?php }
} ?>