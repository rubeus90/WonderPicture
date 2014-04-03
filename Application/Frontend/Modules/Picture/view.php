<!-- INFORMATION -->
<div class="info">
	<h2><?php echo $picture->getName();
		echo '  ';
		for($i =0; $i< $avg; $i ++){
			echo '<span class="star">★</span>';
		}?></h2>
	<p>
		<?php echo $picture->getDescription() ?> - 
		Taille : <?php echo $picture->getWidth() ?>x<?php echo $picture->getHeight() ?> - 
		Poids : <?php echo $picture->getSize() ?>Ko - 
		Format : <?php echo $picture->getType() ?> - 
		Date d'importation : <?php echo $picture->getDate_import() ?>
	</p>
</div>	


<!-- IMAGE -->
<div class="content">
	<img class="img" src="<?php echo '/'.$picture->getURL() ?>" alt="<?php echo $picture->getName() ?>" >
	<!-- NAVIGATION -->
	<?php if($pictureNext !== NULL){
		echo '<a href="'.$pictureNext->getName().'" class="next">&raquo;</a>';
	} ?>

	<?php if($picturePrec !== NULL){
		echo '<a href="'.$picturePrec->getName().'" class="prec">&laquo;</a>';
	} ?>
</div>

<!-- DOWNLOAD -->
<a class="download" href="<?php echo '/'.$picture->getURL() ?>">
	<img src="/Icons/download.svg" alt="download" >Télécharger
</a>


<!-- COMMENT -->
<ul class="comment">
<?php
foreach($comments as $comment){
?>

	<li>
		<div class="icon">
			<img src="<?php echo $comment['avatar'] ?>" alt="<?php echo $comment['name'] ?>">
		</div>
		<div class="text">
			<h3><?php echo $comment['name'] ?> <span>(<?php echo $comment['date_fr'] ?>)</span></h3>
			<p><?php echo $comment['comment'] ?></p>
		</div>
	</li>
<?php } ?>
</ul>

<?php if($connecting){?>
<!-- FORMULAIRE COMMENTAIRE -->
<form method="post" action="/album/<?php echo $picture->getName() ?>">
	<input type="hidden" name="id" value="<?php echo $picture->getId()?>">
	<div class="stars">
		<?php for($i=5; $i>0; $i--){
			if($i <= $note){
				echo '<input name="star" id="'.$i.'" value="'.$i.'" type="radio"><label for="'.$i.'" class="select">★</label>';
			}else{
				echo '<input name="star" id="'.$i.'" value="'.$i.'" type="radio"><label for="'.$i.'" >★</label>';
			}
		}
		?>
	</div>
	<textarea name="comment" rows="4" cols="50"></textarea>
	<input type="submit" name="addcomment" value="Commenter">
</form>
<?php }else{?>
	
<?php } ?>