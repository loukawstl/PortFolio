<!doctype html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>PortFolio/Back-End</title>
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
    <?php 
        require '../MenuBack.html';
        include 'session.php';
    ?>
    <h1 id="home"> PortFolio <span class='button'>.</span></h1>
        <div class="container admin">
            <div class="row">
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>id</th>
                      <th>Nom</th>
                      <th>Description</th>
                      <th>Technologies</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                        require '../connexion/connexion.php';
                        $co = connexion();
                        $statement = $co->query('SELECT id_projet, titre_projet, desc_projet, tech_projet FROM projets ORDER BY id_projet ASC');
                        while($item = $statement->fetch()) {
                            echo '<tr>';
                            echo '<td>'. $item['id_projet'] . '</td>';
                            echo '<td>'. $item['titre_projet'] . '</td>';
                            echo '<td>'. $item['desc_projet'] . '</td>';
                            echo '<td>'. $item['tech_projet'] . '</td>';
                            echo '<td width=340>';
                            echo '<a class="btn btn-primary" href="update.php?id='.$item['id_projet'].'"><i class="fas fa-angle-up"></i> Modifier</a>';
                            echo ' ';
                            echo '<a class="btn btn-danger" href="delete.php?id='.$item['id_projet'].'"><i class="fas fa-trash"></i> Supprimer</a>';
                            echo '</td>';
                            echo '</tr>';
                        }
                        $co = deconnexion();
                      ?>

                  </tbody>
                </table>
            </div>
        </div>