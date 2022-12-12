<?php
    require ('connexion/connexion.php');
    /** Variable déclaré pour les erreur ou validation du formulaire**/
    $emailError = $sendForm = "";

    if (isset($_POST['submit'])) 
    {
        $co = connexion();

        /**Fonction de vérification des charactères du formulaires**/
        function verifyInput($var)
        {
            $var = htmlentities($var);
            $var = trim($var);
            $var = strip_tags($var);
            $var = stripslashes($var);
            $var = htmlspecialchars($var);
            return $var;
        }

        /**Fonction de vérification de la validité d'un email**/
        function verifyEmail($var)
        {
            return filter_var($var, FILTER_VALIDATE_EMAIL);
        }

        /**Saisie des données du formulaire**/
        
        $emailForm = verifyInput($_POST["email"]);
        $messageForm = verifyInput($_POST["message"]);
        /**Vérification des champs du formulaire et affichage des erreurs**/
        
        if (empty($_POST["email"]))
        {
            $emailError = "Il faut obligatoirement mettre un email valide !";
        }
        else
        {
            if (!verifyEmail($_POST["email"]))
            {
                $emailError = "Il faut obligatoirement mettre un email valide !";
            }
            else
            {
                /**Formulaire correcte donc envoi des données dans la BDD**/
                $sendForm = "Le message a bien été envoyé. Merci de m'avoir contacté !";
                $saisieContact = $co->prepare("INSERT INTO infos (email, message) VALUES(?,?);");
                $saisieContact->execute(array($emailForm, $messageForm));
            }
          }
    }
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>PortFolio</title>
        
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
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/footer.css">
        <link rel="stylesheet" href="css/menu.css">
    </head>
    <body>

        <!--Navbar-->      
        <nav>
            <div id="nom">
            <a>Louka WASTEELS</a>
            </div>
            <div id="items">
            <a class="file" href="document/CV.pdf" download="CV"><i class="fas fa-file-download"></i></a>
            <a> . </a>
            <a class="item" href="#">Accueil</a>
            <a> . </a>
            <a class="item" href="#">Projets</a>
            <a> . </a>
            <a class="item" href="#">Parcours</a>
            <a> . </a>
            <a class="item" href="#">Contact</a>
            <a> . </a>
            <a  class="github" href="https://github.com/loukawstl" target="_blank"><i class="fab fa-github"></i></a>
            </div>
            <div id="connexion">
            <a class="BtnCon" href="Back/login.php">Connexion</a>
            </div>
        </nav> 
        <section id="pres">
            <h1 id="home"> PortFolio </h1>
            <h2>Présentation</h2>
            <div>
                <p class="descri"> <span>Je suis Louka WASTEELS</span> <br> Developpeur Full-Stack Junior.</p>
            </div>
        </section>

        <!-- Projets-->
        <section id="projet">
            <h2>Projets</h2>
            <div class="projet-flex">
                <?php 
                $co = connexion();
                $statement = $co->query('SELECT id_projet, titre_projet, desc_projet
                from projets');
                while($projets = $statement->fetch())
                {
                    echo '<div class="projet" >';
                        echo '<h4><i>' . $projets['titre_projet']. '</i></h4>';
                        echo '<a class="btnVoir" href="#">Voir</a>';
                    echo '</div>';
                }
                $co = deconnexion();
                ?>
            </div>
        </section>

        <!--Parcours-->
        <section id="Parcours">
            <h2>Parcours</h2>
            <div class="container">
                <div class="red-divider"></div>

                <ul class="timeline">
                <li>
                    <div class="timeline-badge"><i class="fas fa-briefcase"></i></div>
                    <div class="timeline-panel-container-inverted">
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h3>. Javascript</h3>
                            </div>
                            <div class="timeline-body">
                                <i class="text-muted">Novembre / Decembre 2022</i>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="timeline-badge"><i class="fas fa-file-code"></i></div>
                    <div class="timeline-panel-container">
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h3>. Symfony</h3>
                            </div>
                            <div class="timeline-body">
                                <i class="text-muted">Novembre / Decembre 2022</i>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="timeline-badge"><i class="fas fa-briefcase"></i></div>
                    <div class="timeline-panel-container-inverted">
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h3>. POO</h3>
                            </div>
                            <div class="timeline-body">
                                <i class="text-muted">Septembre / Octobre 2022</i>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="timeline-badge"><i class="fas fa-file-code"></i></div>
                    <div class="timeline-panel-container">
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h3>. JQuery</h3>
                            </div>
                            <div class="timeline-body">
                                <i class="text-muted">Mars / Avril 2022</i>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="timeline-badge"><i class="fas fa-briefcase"></i></div>
                    <div class="timeline-panel-container-inverted">
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h3>. PHP</h3>
                            </div>
                            <div class="timeline-body">
                                <i class="text-muted">Janvier / Février 2022 </i>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="timeline-badge"><i class="fas fa-folder"></i></div>
                    <div class="timeline-panel-container">
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h3>. BOOTSTRAP / SQL</h3>
                            </div>
                            <div class="timeline-body">
                                <i class="text-muted">Novembre / Décembre 2021</i>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="timeline-badge"><i class="fas fa-code"></i></div>
                    <div class="timeline-panel-container-inverted">
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h3>. HTML / CSS</h3>
                            </div>
                            <div class="timeline-body">
                                <i class="text-muted">Séptembre / Octobre 2021</i>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>

            </div>
        </section>
            <!--Contact-->
            <h2>Contact</h2>
        <footer>
            <form class="formContact" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                <label for="email">Email* :</label><br>
                <input id="email" class="saisie" type="email" name="email" placeholder="...">
                <p class="comments"><?php echo $emailError ?></p>

                <label for="message">Message :</label><br>
                <textarea id="message" class="saisie" name="message" placeholder="..."></textarea><br>

                <!-- Button envoyer pour le formulaire de contact -->
                <input id="btnEnv" type="submit" name="submit" value="Envoyer">
                <!-- Validation de l'envoi du formulaire dans la BDD -->
                <p class="validate"><?php echo $sendForm ?></p>
            </form>        
        </footer>
            <!--fin du footer-->
            <div class="text-center p-4" style="background-color: rgba(37, 70, 125, 1);">
                <a style="color: white">© 2022 PortFolio : Louka.WASTEELS</a>
                <a class="validation" style="color: white" target="_blank" href="https://validator.w3.org/nu/?doc=https%3A%2F%2Flwasteels.lyceestvincent.fr%2F">Validation W3C</a>
            </div>         
    </body>
</html>

