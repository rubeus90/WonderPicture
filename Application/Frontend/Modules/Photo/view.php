<!DOCTYPE html>
<html>
 	<head>
 		<meta charset="utf-8">
		<title>WonderPicture</title>
	</head>
	<body>
		<div class="ensemble">
			<div class="content">
				<img src="../../<?php echo $photo->getUrl()?>" class="img" />
			</div>	
			<div class="info">
				<h2 class="titre"> <?php echo $photo->getTitre()?> </h2>
				<h2 class="description"> <?php echo $photo->getDescription()?> </h2>
				<div class='donnees'>
					<h2>Date d'import : <?php echo $photo->getDateImport()?> </h2>
					<h2>Taille : <?php echo $photo->getLargeur()?>x<?php echo $photo->getHauteur()?></h2>
					<h2>Poids : <?php echo $photo->getPoids()?></h2>
					<h2>Extension : <?php echo $photo->getExtension()?></h2>
				</div>
				<div class="note">
					<?php 
							$note = $photo->getNote();
							$nbDemi = ceil($note);
							$nbEtoile = floor($nbDemi/2);
							$nbReste = $nbDemi%2;
							$nbVide = 5-$nbEtoile - $nbReste;
							
							for($i=0;$i<$nbEtoile;$i++)
								echo '<img src="../../Image/star.png"/>';
							if ($nbReste == 1)
								echo '<img src="../../Image/starleft.png"/>';
							for($i=0;$i<$nbVide;$i++)
								echo '<img src="../../Image/starempty.png"/>';
					?> 
				</div>

				
			</div>
		</div>
		
		
	</body>
</html>