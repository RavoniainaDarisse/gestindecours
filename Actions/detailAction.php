<?php
$mysqli = new mysqli("localhost", "root", "", "gestion_de_cours");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$id = $_GET['id'];

if (!filter_var($id, FILTER_VALIDATE_INT)) {
    die("ID invalide.");
}

$stmt = $mysqli->prepare("
    SELECT courses.*, levels.level_name 
    FROM courses 
    LEFT JOIN levels ON courses.level_id = levels.id 
    WHERE courses.id = ?
");
if (!$stmt) {
    die("Prepare failed: " . $mysqli->error);
}

$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Aucun cours trouvé avec cet ID.");
}

$course = $result->fetch_assoc();
$stmt->close();
