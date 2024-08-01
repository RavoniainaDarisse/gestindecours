<?php
$mysqli = new mysqli("localhost", "root", "", "gestion_de_cours");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$query = "
    SELECT courses.*, levels.level_name
    FROM courses
    LEFT JOIN levels ON courses.level_id = levels.id
";
$result = $mysqli->query($query);
if (!$result) {
    die("Query failed: " . $mysqli->error);
}