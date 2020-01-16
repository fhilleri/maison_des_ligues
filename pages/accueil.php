<?php
	session_start();
	if(file_exists('compteur_visites.txt'))
	{
			$compteur_f = fopen('compteur_visites.txt', 'r+');
			$compte = fgets($compteur_f);
	}
	else
	{
			$compteur_f = fopen('compteur_visites.txt', 'a+');
			$compte = 0;
	}
	if(!isset($_SESSION['compteur_de_visite']))
	{
			$_SESSION['compteur_de_visite'] = 'visite';
			$compte++;
			fseek($compteur_f, 0);
			fputs($compteur_f, $compte);
	}
	fclose($compteur_f);
?>
<!DOCTYPE html>
<html>
	<!-- en-têtes de la page HTML -->
	<head>
		<title>Accueil</title>
		<meta charset="UTF-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="/PPE/css/site.css" />
		<link rel="icon" href="/PPE/img/m2l_sans_text_carre.png"/>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="/PPE/js/responsive_menu.js">
		</script>
	</head>

	
	<!-- contenus de la page HTML -->
	<body>
		<header>
			<div class="menu" id="menu">
				<!-- Entête -->
				<!--span id = "nom_site" >Maison des ligues</span-->
				<ul>
					<img id="logo_site" src="/PPE/img/m2l_sans_text.png">
					<li><a class=current href="/PPE/pages/accueil.php">Accueil</a></li>
					<li><a href="/PPE/pages/annuaire_des_ligues.php">Annuaire des ligues</a></li>
					<li><a href="/PPE/pages/formations.php">Formations</a></li>
					<li><a href="/PPE/pages/salles.php">Salles</a></li>
					<li><a href="/PPE/pages/contacts.html">Contacts</a></li>
					<a href="javascript:void(0);" class="icon" onclick="switchResponsive()">
						<i class="fa fa-bars"></i>
					</a>
				</ul>
			</div>
		</header>

		<!-- Contenu de la page -->
		<main>
			<h1>Bienvenue sur le site de la maison des ligues des pays de la loire </h1>
			<p>La Maison des Ligues des pays de la loire (M2L) a pour mission de fournir des espaces et des services aux différentes ligues sportives régionales des pays de la loire et à d’autres structures hébergées. La M2L est une structure financée par le Conseil Régional des pays de la loire dont l'administration est déléguée au Comité Régional Olympique et Sportif des pays de la loire . Installée depuis 2003 dans la banlieue de cholet, la M2L accueille l'ensemble du mouvement sportif des pays de la loire qui représente près de 6 500 clubs, plus de 525 000 licenciés et près de 50 000 bénévoles.</p>
			<div style="text-align: center">
				<img src="/PPE/img/judo.png">
				<img src="/PPE/img/tennis.png">
				<img src="/PPE/img/badminton.png">
				<img src="/PPE/img/handball.png">
			</div>

			<iframe width="560" height="315" style="display:block; margin-left:auto; margin-right:auto; padding:20px;" src="https://www.youtube.com/embed/mB2Vw3hhxnI" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		</main>

		
		
		<footer>
			<hr style="margin-top:0">
			<!-- Pied de page -->
			<a href="https://www.facebook.com/" target="_blank" style="float:left">Facebook</a>
			<?php
				echo '<span style="float:right">Nombre de visites : <strong>'.$compte.'</strong></span>';
			?>
			<br>
			<a href="https://twitter.com/" target="_blank" style="float:left">Twitter</a>
			<a href=""style="float:right">Mentions légales</a>
		</footer>
	</body>
</html>