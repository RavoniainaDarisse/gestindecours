<?php
$mysqli = new mysqli("localhost", "root", "", "gestion_de_cours");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}