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
