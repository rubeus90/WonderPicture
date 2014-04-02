<!DOCTYPE html>
<html>
 	<head>
 		<meta charset="utf-8">
		<title>WonderPicture</title>
	</head>
	<body>
		<?php			
			foreach($listeImage as $image){
			echo $image->getTitre();
			echo '<br/>';
			}
		?>
	
	</body>
</html>