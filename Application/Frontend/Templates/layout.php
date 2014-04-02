<!DOCTYPE html>
<html>
 	<head>
 		<meta charset="utf-8">
		<link rel="stylesheet" media="screen" href="/css/frontend.css" type="text/css" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400' rel='stylesheet' type='text/css'>
		<title>PicShow</title>
	</head>
	<body>
		<header>
			<a href="/Connexion" class="nav">
				<div>
					<img src="/Icons/login.png" alt="login">
				</div>
				<div>
					<span>Se Connecter / S'inscrire</span>
				</div>	
			</a>
			 
			<a href="/"><h1>PicShow</h1></a>
		</header>

		<nav>
			<?php echo $nav ?>
		</nav>

		<section>		
			<?php echo $content ?>
		</section>
	</body>
</html>