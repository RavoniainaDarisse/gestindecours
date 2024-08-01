<?php

$mysqli = new mysqli("localhost", "root", "", "gestion_de_cours");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$id = $_GET['id'];

if (!filter_var($id, FILTER_VALIDATE_INT)) {
    die("ID invalide.");
}

$levelsQuery = "SELECT id, level_name FROM levels";
$levelsResult = $mysqli->query($levelsQuery);
if (!$levelsResult) {
    die("Query failed: " . $mysqli->error);
}
$levels = [];
while ($row = $levelsResult->fetch_assoc()) {
    $levels[] = $row;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $class = $_POST['class'];
    $level = $_POST['level'];
    $video_url = $_POST['video_url'];

    $video_file = $_POST['existing_video_file'];
    if (!empty($_FILES["video_file"]["name"])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["video_file"]["name"]);
        if (move_uploaded_file($_FILES["video_file"]["tmp_name"], $target_file)) {
            $video_file = basename($_FILES["video_file"]["name"]);
        } else {
            echo "Erreur lors du téléchargement de la vidéo.";
            exit;
        }
    }

    $stmt = $mysqli->prepare("UPDATE courses SET title = ?, class = ?, level_id = ?, video_url = ?, video_file = ? WHERE id = ?");
    if (!$stmt) {
        die("Prepare failed: " . $mysqli->error);
    }

    $stmt->bind_param("sssisi", $title, $class, $level, $video_url, $video_file, $id);

    if (!$stmt->execute()) {
        die("Execute failed: " . $stmt->error);
    }

    $stmt->close();
    header("Location: index.php");
    exit;
} else {
    $stmt = $mysqli->prepare("SELECT * FROM courses WHERE id = ?");
    if (!$stmt) {
        die("Prepare failed: " . $mysqli->error);
    }

    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $course = $result->fetch_assoc();
    $stmt->close();

    if (!$course) {
        die("Cours non trouvé.");
    }
}