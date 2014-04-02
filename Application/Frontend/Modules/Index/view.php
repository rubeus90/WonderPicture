<!DOCTYPE html>
<html>
 	<head>
 		<meta charset="utf-8">
		<title>WonderPicture</title>
	</head>
	<body>
		<form action="" method="post">
				<input type="text" name="toto" />
				<input type="submit" value ="test" />
		</form>
		
		<?php
			echo $test.'<br/>';
			foreach($listeDernierePhoto as $photo){
			echo $photo->getTitre();
			echo '<br/>';
			}
		?>
	
	
		<div>
		<p>Photo avec la meilleur note</p>
		<img src="<?php echo $photoMeilleurNote->getUrlMiniature()?>"/>
		</div>
		
		<a href="/Photo/<?php echo $photoMeilleurNote->getId()?>"> ICI </a>
		
	</body>
</html>