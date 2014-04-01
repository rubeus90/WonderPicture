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
			echo __DIR__.$photoMeilleurNote->getUrlMiniature().'<br/>';
			 if(file_exists(__DIR__.$photoMeilleurNote->getUrlMiniature()))
			 echo 'good';
			 else
			 echo 'bad';

		?>
	
	
		<div>
		<p>Photo avec la meilleur note</p>
		
		<img src=""/>
		</div>
		
	</body>
</html>