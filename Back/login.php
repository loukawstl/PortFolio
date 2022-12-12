<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>PortFolio/Connexion</title>
    <link rel="stylesheet" href="login.css" type="text/css">
    <!--MetaName-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" 
    integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <link rel="stylesheet" href="../css/back.css">
    </head>
    <body>
        
        <?php
			// Permet d'appeler la fonction de connexion à la BD
            require('../connexion/connexion.php');
			
			// Démarrage d'une session
            session_start();

            // Connexion à la BD
            $co = connexion();

            if (isset($_POST['submit'])){
                $username = $_POST['username'];
				$password = hash('sha256', $_POST['password']);
				//$password = password_hash($_POST['password'], PASSWORD_ARGON2I);

                // Préparation de la requête
                $query = $co->prepare('SELECT * FROM connexion WHERE username=:login and password=:pass');

                // Association des paramètres aux variables/valeurs
                $query->bindParam(':login', $username);
				$query->bindParam(':pass', $password);

                // Execution de la requête
                $query->execute();    

                // Récupération dans la variable $result de toutes les lignes que retourne la requête
                $result = $query->fetchall();

                // On compte le nombre de lignes résultats de la requête
                $rows = $query->rowCount();
				
				// Si une ligne résultat est trouvée, cela signifi que l'utilisateur existe dans la BD
				// et donc qu'il a le droit de se connecter
                if($rows==1){
					// On définit la variable de session username avec la valeur saisie par l'utilisateur
                    $_SESSION['username'] = $username;
					// On lance la page index.php à la place de la page actuelle
                    header("Location: view.php");
                }else{
					// Si la requête ne retourne rien, alors l'utilisateur n'existe pas dans la BD, on lui
					// affiche un message d'erreur
                    $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
                }
            }
            $co = deconnexion();
        ?>
    <div class="container-fluid">
        <form action="" method="post" name="login">
        <div class="login-box">
                <h1 class="box-title">Connexion</h1>
            <div class="textbox" >
                <i class="fa fa-user" aria-hidden="true"></i>
                <input type="text" class="box-input" name="username" placeholder="Nom d'utilisateur">
            </div>
            <div class="textbox">
                <i class="fa fa-user" aria-hidden="true"></i>
                <input type="password" class="box-input" name="password" placeholder="Mot de passe">
            </div>
            <div>
                <input class="buttonn"type="submit" value="Sign In" name="submit" class="box-button">
                <a href="../index.php">Retour</a>
            </div>
                <?php if (! empty($message)) { ?>
                    <p class="errorMessage"><?php echo $message; ?></p>
                <?php } ?>
        </div>
        </form>

    </div>
    </body>
</html>