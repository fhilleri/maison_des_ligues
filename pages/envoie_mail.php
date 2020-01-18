<?php 
    header("Content-Type: text/plain");

    $error = "";
    if (isset($_POST["nom"]) && 
    isset($_POST["adresse"]) && 
    isset($_POST["contenu"]))
    {
        $pdo = new PDO("mysql:host=localhost;dbname=mdl", "root", "root" , array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
        
        $data["nom"] = htmlspecialchars($_POST["nom"]);
        $data["adresse"] = htmlspecialchars($_POST["adresse"]);
        $data["contenu"] = htmlspecialchars($_POST["contenu"]);
        
        $requete = "INSERT INTO MAILS (id_mail, nom, adresse, contenu) 
            VALUES (NULL, :nom, :adresse, :contenu);";
        
        if (!$pdo->prepare($requete)->execute($data)) $error =  "Erreur lors de la requête";
    }
    else $error = "Le formulaire a mal été remplit";


    echo $error;
?>