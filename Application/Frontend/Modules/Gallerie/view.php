<div class="info">
	<h2><?php echo $album->getName() ?> - <?php echo count($pictures) ?> Photos</h2>
	<p><?php echo $album->getDescription() ?></p>
</div>


<?php
foreach($pictures as $picture){
?>
<article>
	<a href="<?php echo $album->getName().'/'.$picture->getName() ?>">
		<img src="<?php echo $picture->getUrlmin() ?>" alt="<?php echo $picture->getName() ?>">
		<h3><?php echo $picture->getName() ?></h3>
	</a>

</article>	
<?php } ?>