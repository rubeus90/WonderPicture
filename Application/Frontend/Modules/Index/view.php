<div class="info">
	<h2>Galerie Photos de Joe Doth</h2>
	<p>Derniers ajouts</p>
</div>

<?php
foreach($pictures as $picture){
?>
<article>
	<a href="<?php echo './Album/'.$picture->getName() ?>">
		<img src="<?php echo $picture->getUrlmin() ?>" alt="<?php echo $picture->getName() ?>">
		<h3><?php echo $picture->getName() ?></h3>
	</a>
</article>	
<?php } ?>