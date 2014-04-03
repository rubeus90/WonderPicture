<!DOCTYPE html>
<html>
 	<head>
 		<meta charset="utf-8">
		<link rel="stylesheet" media="screen" href="/css/frontend.css" type="text/css" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400' rel='stylesheet' type='text/css'>
		<title>WonderPicture <?php echo $title ?></title>
	</head>
	<body>
		<header>
			<?php if($connecting){?>
			<a href="/Deconnexion" class="nav">
				<div>
					<img src="/Icons/logout.png" alt="logout">
				</div>
			</a>
			<?php if($isAdmin){?>
					<a href="/admin" class="nav">
						<div>
							<img src="/Icons/setting.png" alt="logout">
						</div>
					</a>
				<?php } ?>
			<a href="/Profil" class="nav">
				<div>
					<img src="<?php echo $avatar ?>" class="circle" alt="login">
				</div>
				<div>
					<span><?php echo $name ?></span>
				</div>	
			</a>
			<?php } else{ ?>
			<a href="/Connexion" class="nav">
				<div>
					<img src="/Icons/login.png" alt="login">
				</div>
				<div>
					<span>Se Connecter / S'inscrire</span>
				</div>	
			</a>
			<?php } ?>
			 
			<a href="/"><h1>WonderPicture</h1></a>
		</header>

		<nav>
			<?php echo $nav ?>
		</nav>

		<section>		
			<?php echo $content ?>
		</section>
	</body>
</html>