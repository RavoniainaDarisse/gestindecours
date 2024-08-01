<?php
$mysqli = new mysqli("localhost", "root", "", "gestion_de_cours");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    $id = $_GET['id'];

    $stmt = $mysqli->prepare("SELECT video_file FROM courses WHERE id = ?");
    if (!$stmt) {
        die("Prepare failed: " . $mysqli->error);
    }

    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $course = $result->fetch_assoc();
    $stmt->close();

    if ($course) {
        $video_file = $course['video_file'];
        if (!empty($video_file)) {
            $file_path = "uploads/" . $video_file;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }

        $stmt = $mysqli->prepare("DELETE FROM courses WHERE id = ?");
        if (!$stmt) {
            die("Prepare failed: " . $mysqli->error);
        }

        $stmt->bind_param("i", $id);
        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }

        $stmt->close();
    }
}

header("Location: index.php");
exit;

$mysqli->close();
?>
