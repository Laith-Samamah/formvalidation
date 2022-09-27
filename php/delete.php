<?php

require './connection.php';
$id = $_GET["id"];

$sql = "DELETE from loginfo WHERE id=:id ";

$query = $conn->prepare($sql);

$query->bindParam(':id',$id, PDO::PARAM_STR);

$result = $query->execute();

header("location: admin.php");
?>