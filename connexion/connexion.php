<?php

	#Fonction � appeler pour se connecter � la base de donn�es
	function connexion() 
	{
		// Tentative de connexion � la base de donn�es MySQL 
		try
		{
			require('config.php');
            // chaine de connexion avec API PDO
			$var = new PDO("mysql:host=" . $server .";dbname=" . $dbName, $user, $pass);
			//On d�finit le mode d'erreur de PDO sur Exception
			$var->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}		
		// En cas de probl�me dans la tentative connexion on termine le script php et on affichera le message d'erreur
		catch(PDOException $e)
		{
			die('Erreur : ' . $e->getMessage());
		}
        return $var;
	}

	function deconnexion(){
		$var = NULL;
		return $var;
	}
	

	

?>