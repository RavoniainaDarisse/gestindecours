<?php
include './Actions/indexAction.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <header>
        <div class="head">
            <div class="Logo">ALFALogo</div>
            <div class="nav">
                <ul>
                    <li>Acceuil</li>
                    <li>Services</li>
                    <li>Voir tous les cours</li>
                    <li>A propos</li>
                </ul>
            </div>
            <div class="search">
                <div class="input">
                    <input type="text" placeholder="Rechercher des cours...">
                </div>
                <div>
                    <img src="./assets/img/rechercher.png" width=33px" alt="" srcset="">
                </div>
            </div>
        </div>
    </header>

    <section class="ListeCours">
        <div class="top1">
            <div class="txt"><h1>Liste des cours disponibles : </h1></div>
            <div class="buttonAdd">
                <a href="create.php" class="btn btn-primary mb-3">Ajouter</a>
                <img src="./assets/img/fleches-vers-le-haut.png" width="33px" alt="">
            </div>
        </div>


        <div class="cardCours">
            <div class="Tuto">
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="card">
                    <div>
                        <div class="video">
            
                    </div>
                    </div>
                    <div class="details">
                        <div class="titleCours">
                        <img src="./assets/img/film.png" width="33px" alt="">
                        <p>Institut National Supérieur d’Informatique</p>    
                        </div>
                        <ul>
                            <li> <h4>Titre:</h4> <p><?php echo htmlspecialchars($row['title'] ?? ''); ?></p></li>
                            <li><h4>Semestre:</h4> <p><?php echo htmlspecialchars($row['class'] ?? ''); ?></p></li>
                            <li><h4>Niveau:</h4> <p><?php echo htmlspecialchars($row['level_name'] ?? ''); ?></p></li>
                            <li><h4>Date:</h4> <p><?php echo htmlspecialchars($row['created_at'] ?? ''); ?></p></li>
                        </ul>
                        <div class="buttonDetails">
                            <a  href="read.php?id=<?php echo htmlspecialchars($row['id'] ?? ''); ?>">Decouvrir</a>
                        </div>
                    </div>
                    <div class="Action">

                        <div class="btnAction">
                            <img src="./assets/img/crayon.png" width="30px" alt="">
                            <a  href="edit.php?id=<?php echo htmlspecialchars($row['id'] ?? ''); ?>">Modifier</a>
                        </div>
                        <div class="btnAction">
                            <img src="./assets/img/supprimer.png" width="30px" alt="">
                            <a href="delete.php?id=<?php echo htmlspecialchars($row['id'] ?? ''); ?>">Supprimer</a>
                        </div>
                    </div>
                    
                </div>
            <?php endwhile; ?>
                
                
            </div>
        </div>
    </section>


    <section class="posezQuestion">
        <div class="txt2">
            <h3>Voulez-vous poser des questions ?</h3>
        </div>

        <div class="question">
            <div class="top">
                <div class="gre"><p>Quels sont les meilleurs cours ?</p></div>
                <div class="gre"><p>Dans quel mois vous débutez?</p></div>
            </div>
            <div class="bottom">
                <div class="gre"><p>Pouvez-vous m’en dire plus?</p></div>
            </div>
        </div>
    </section>


    <footer>
        <div class="containerFooter">
            <div class="topFooter">
                <div class="listeFooter">
                    <h2>ALFALogo</h2>
                    <ul>
                        <li>Acceuil</li>
                        <li>Services</li>
                        <li>Voir tous les cours</li>
                        <li>A propos</li>
                    </ul>
                </div>
                <div class="listeFooter">
                    <h2>Communauté</h2>
                    <ul>
                        <li>Etudiants</li>
                        <li>Enseignants</li>
                        <li>Directeur General</li>
                        <li>Surveillant</li>
                    </ul>
                </div>
                <div class="listeFooter">
                    <h2>Envoyez-nous un commentaire :</h2>
                    <div class="inputcmt">
                    <Textarea cols="50" rows="10"></Textarea>
                    <div class="btnSendCmt">
                    <a href="#" >Envoyer</a>
                    </div>
                </div>
                </div>
                <div class="listeFooter">
                    <h2>Dispo sur : </h2>
                    <ul>
                        <li><img src="./assets/img/jeu-de-google.png" width="30px" alt="">Google Playstor</li>
                        <li><img src="./assets/img/android.png" width="30px" alt="">Android</li>
                    </ul>
                </div>
            </div>
            <div class="bottomFooter">
                <h4>Contacts : exemple@gmail.com</h4>
            </div>
        </div>
    </footer>
</body>
</html>