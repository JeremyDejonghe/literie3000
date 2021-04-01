<?php 
$id = $_POST["id"];

$dsn = "mysql:host=localhost;dbname=literie3000";
$db = new PDO($dsn, "root", "");

$query = $db->prepare("DELETE FROM matelas WHERE id = :id");
$query->bindParam(":id", $id);
if ($query->execute()) {
    header("Location: index.php");
}
