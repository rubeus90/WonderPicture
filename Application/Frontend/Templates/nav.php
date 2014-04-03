<ul>
	<?php
	foreach($albums as $element){
	?>
	<li><a href="<?php echo '/'.$element->getName()?>">
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