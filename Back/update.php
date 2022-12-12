<?php

    require '../connexion/connexion.php';
    include 'session.php';
    if (!empty($_GET['id'])) {
        $id = checkInput($_GET['id']);
    }

    $isSuccess = $titreError = $descError =  $techError = $titre = $desc = $tech = "";

    if (!empty($_POST)) {
        $titre        = checkInput($_POST['titre_projet']);
        $desc              = checkInput($_POST['desc_projet']);
        $tech              = checkInput($_POST['tech_projet']);
        $isSuccess          = true;

        if (empty($titre)) {
            $titreError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        } 
        if (empty($desc)) {
            $descError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }  
        if (empty($tech)) {
            $techError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }    
    }
         
        if ($isSuccess) { 
            $co = connexion();
                $statement = $co->prepare("UPDATE projets  set titre_projet = ?, desc_projet = ?,tech_projet = ? WHERE id_projet = ?");
                $statement->execute(array($id,$titre,$desc,$tech,));
            $co = deconnexion();
        }
         else {
        $co = connexion();
        $statement = $co->prepare("SELECT * FROM projets where id_projet = ?");
        $statement->execute(array($id));
        $item = $statement->fetch();
        $titre    = $item['titre_projet'];
        $desc          = $item['desc_projet'];
        $tech          = $item['tech_projet'];
        $co = deconnexion();
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
        <h1 class="text-logo"> PortFolio </h1>
        <div class="container admin">
            <div class="row">
                <div class="col-md-6">
                    <h1><strong>Modifier un projet</strong></h1>
                    <br>
                    <form class="form" action="<?php echo 'update.php?id='.$id;?>" role="form" method="post" enctype="multipart/form-data">
                        <br>
                        <div>
                            <label class="form-label" for="titre_projet">Titre :</label>
                            <input type="text" class="form-control" id="titre_projet" name="titre_projet" placeholder="..." value="<?php echo $titre;?>">
                            <span class="help-inline"><?php echo $titreError;?></span>
                        </div>
                        <br>
                        <div>
                        <label class="form-label" for="desc_projet">Description :</label>
                            <input type="text" class="form-control" id="desc_projet" name="desc_projet" placeholder="..." value="<?php echo $desc;?>">
                            <span class="help-inline"><?php echo $descError;?></span>
                        </div>
                       <br>
                       <div>
                            <label class="form-label" for="tech_projet">Technologies :</label>
                            <input type="text" class="form-control" id="tech_projet" name="tech_projet" placeholder="..." value="<?php echo $tech;?>">
                            <span class="help-inline"><?php echo $techError;?></span>
                        </div>
                        <br>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"><span class="bi-pencil"></span> Modifier</button>
                            <a class="btn btn-primary" href="view.php"><span class="bi-arrow-left"></span> Retour</a>
                       </div>
                    </form>
                </div>
            </div>
        </div>   
    </body>
</html>