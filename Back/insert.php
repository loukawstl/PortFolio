<?php
    include 'session.php';
    require '../connexion/connexion.php';
 
    $idError = $titreError = $descError = $techError = $id = $titre = $desc = $tech = "";

    if(!empty($_POST)) {
        $id               = checkInput($_POST['id_projet']);
        $titre       = checkInput($_POST['titre_projet']);
        $desc              = checkInput($_POST['desc_projet']); 
        $tech              = checkInput($_POST['tech_projet']); 
        $isSuccess          = true;
        $isUploadSuccess    = false;
        
        if(empty($id)) {
            $idError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        if(empty($titre)) {
            $titreError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        } 
        if(empty($desc)) {
            $descError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        } 
        if(empty($tech)) {
            $techError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        } 
                
        if($isSuccess) {
            $co = connexion();
            $statement = $co->prepare("INSERT INTO projets (id_projet,titre_projet,desc_projet, tech_projet) values(?, ?, ?, ?)");
            $statement->execute(array($id,$titre,$desc,$tech));
            $co = deconnexion();
            header("Location: view.php");
        }
    }

    function checkInput($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>PortFolio / Ajouter un projet</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="../css/back.css">
    </head>
    
    <body>
        <h1 class="text-logo"> PortFolio</h1>
        <div class="container admin">
            <div class="row">
                <h1><strong>Ajouter un projet</strong></h1>
                <br>
                <form class="form" action="insert.php" role="form" method="post" enctype="multipart/form-data">
                    <br>
                    <div>
                        <label class="form-label" for="id_projet">Id :</label>
                        <input type="text" class="form-control" id="id_projet" name="id_projet" placeholder="Insérer un id pour le projet" value="<?php echo $id;?>">
                        <span class="help-inline"><?php echo $idError;?></span>
                    </div>
                    <br>
                    <div>
                        <label class="form-label" for="titre_projet">Titre :</label>
                        <input type="text" class="form-control" id="titre_projet" name="titre_projet" placeholder="Insérer un titre pour le projet" value="<?php echo $titre;?>">
                        <span class="help-inline"><?php echo $titreError;?></span>
                    </div>
                    <br>
                    <div>
                        <label class="form-label" for="desc_projet">Description :</label>
                        <input type="text " class="form-control" id="desc_projet" name="desc_projet" placeholder="Insérer une descrption pour le projet" value="<?php echo $desc;?>">
                        <span class="help-inline"><?php echo $descError;?></span>
                    </div>
                    <br>
                    <div>
                        <label class="form-label" for="tech_projet">Technologie :</label>
                        <input type="text " class="form-control" id="tech_projet" name="tech_projet" placeholder="Insérer des technologies pour le projet" value="<?php echo $tech;?>">
                        <span class="help-inline"><?php echo $techError;?></span>
                    </div>
                    <br>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success"><span class="bi-pencil"></span> Ajouter</button>
                        <a class="btn btn-primary" href="view.php"><span class="bi-arrow-left"></span> Retour</a>
                    </div>
                </form>
            </div>
        </div>   
    </body>
</html>