<?php
$mysqli = new mysqli("localhost", "root", "", "gestion_de_cours");

if ($mysqli->connect_error) {
    die("Échec de la connexion : " . $mysqli->connect_error);
}

$result = $mysqli->query("SELECT id, level_name FROM levels");
$levels = $result->fetch_all(MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $class = $_POST['class'];
    $level_id = $_POST['level']; 
    $video_url = $_POST['video_url'];

    if (empty($title) || empty($class) || empty($level_id) || empty($video_url)) {
        echo "Tous les champs sont requis.";
        exit;
    }

    if ($_FILES["video_file"]["size"] > 2 * 1024 * 1024) {
        echo "Le fichier est trop volumineux. La taille maximale autorisée est de 5 Mo.";
        exit;
    }
    
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["video_file"]["name"]);
    if (move_uploaded_file($_FILES["video_file"]["tmp_name"], $target_file)) {
        $video_file = basename($_FILES["video_file"]["name"]);
        $stmt = $mysqli->prepare("INSERT INTO courses (title, class, level_id, video_url, video_file) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $title, $class, $level_id, $video_url, $video_file);
        $stmt->execute();
        $stmt->close();
        header("Location: index.php");
        exit;
    } else {
        echo "Erreur lors du téléchargement de la vidéo.";
    }
}

$mysqli->close();

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

    <section class="Add">
    <div class="centerForm">
        <h1>Bonjour cher utilisateur !</h1>
        <h3>Ajoutez votre cours : </h3>
        <form  action="create.php" method="post" enctype="multipart/form-data">
            <div class="form">
                <label for="">Titre: </label>
                <input type="text" class="form-control" name="title" id="title" required>
            </div>

            <div class="form">
                <label for="">Semestre: </label>
                <input type="text" class="form-control" name="class" id="class" required>
            </div>

            <div class="form">
                <label for="">Niveau: </label>
                <select class="form-control" name="level" id="level" required>
                    <?php foreach ($levels as $level): ?>
                        <option value="<?= $level['id'] ?>"><?= $level['level_name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form1">
                <label for="">Add file : </label>
                <input type="file" class="form-control-file" name="video_file" id="video_file" required>
            </div>

            <div class="form">
                <label for="">URL de la vidéo : </label>
                <input type="url" class="form-control" name="video_url" id="video_url" required>
            </div>
            <div class="btnAddForm">
                <div class="btnLeftAddForm">
                    <button type="submit" class="AddLessons">Ajouter</button>
                </div>
            </div>
        </form>
    </div>
    </section>
    
</body>
</html>