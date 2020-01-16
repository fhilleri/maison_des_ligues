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
					<li><a href="/PPE/pages/accueil.php">Accueil</a></li>
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
			
			<?php
				$error = "";
				if(isset($_POST["nomResa"]) && $_POST["nomResa"] != ""
				&& isset($_POST["dateResa"]) && $_POST["dateResa"] != ""
				&& isset($_POST["HeureDbResa"]) && $_POST["HeureDbResa"] != ""
				&& isset($_POST["HeureFinResa"]) && $_POST["HeureFinResa"] != ""
				&& isset($_POST["numSalle"]) && $_POST["numSalle"] != "")
				{
					//Vérifie que l'heure de début est inferieur à l'heure de fin
					date_default_timezone_set("Europe/Paris");
					if (strtotime($_POST["HeureDbResa"]) >= strtotime($_POST["HeureFinResa"]))
					{
						$error = "L'heure de début ne peut pas être supérieure ou égale à l'heure de fin";
					}

					if ($error === "")
					{
						$pdo = new PDO("mysql:host=localhost;dbname=mdl", "root", "root" , array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
						
						$requete = "SELECT reservation.numResa
							FROM reservation
							WHERE reservation.numSalle = :numSalle 
							AND reservation.dateResa = :dateResa
							AND (reservation.HeureDbResa >= :HeureDbResa AND HeureDbResa < :HeureFinResa
							OR reservation.HeureFinResa > :HeureDbResa AND HeureFinResa <=  :HeureFinResa
							OR :HeureDbResa >= reservation.HeureDbResa AND :HeureDbResa < reservation.HeureFinResa
							OR :HeureFinResa > reservation.HeureDbResa AND :HeureFinResa <= reservation.HeureFinResa)";
						
						$reponse = $pdo->prepare($requete);
						$reponse->execute(array("dateResa" => $_POST["dateResa"], "HeureDbResa" => $_POST["HeureDbResa"], "HeureFinResa" => $_POST["HeureFinResa"], "numSalle" => $_POST["numSalle"]));
						$count = $reponse->rowCount();
	
						if ($count == 0)
						{
							$data["nomResa"] = htmlspecialchars($_POST["nomResa"]);
							$data["dateResa"] = htmlspecialchars($_POST["dateResa"]);
							$data["HeureDbResa"] = htmlspecialchars($_POST["HeureDbResa"]);
							$data["HeureFinResa"] = htmlspecialchars($_POST["HeureFinResa"]);
							$data["numSalle"] = htmlspecialchars($_POST["numSalle"]);
							
							$requete = "INSERT INTO reservation (numResa, nomResa, dateResa, HeureDbResa, HeureFinResa, numSalle) 
								VALUES (NULL, :nomResa, :dateResa, :HeureDbResa, :HeureFinResa, :numSalle);";
							
							if (!$pdo->prepare($requete)->execute($data)) $error =  "Erreur lors de la requête";
						}
						else
						{
							$error = "Cette plage horaire est déjà réservée pour cette salle";
						}
					}
				}
				else $error = "Erreur : le formulaire est mal rempli";

				if ($error == "")
				{
					echo "<h1>Votre réservation a bien été prise en compte</h1>";
				}
				else 
				{
					echo "<h1>Votre réservation n'a pas été prise en compte";
					echo "<h2>" . $error . "</h2>";
					echo "<button type='button' class='button' onclick='window.history.back();'>Retourner à la réservation</button>";
				}
			?>

		</main>

		
		
		<footer>
			<hr style="margin-top:0">
			<!-- Pied de page -->
			<a href="https://www.facebook.com/" target="_blank" style="float:left">Facebook</a>
			<br>
			<a href="https://twitter.com/" target="_blank" style="float:left">Twitter</a>
			<a href=""style="float:right">Mentions légales</a>
		</footer>
	</body>
</html>