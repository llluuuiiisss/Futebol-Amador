<?php
session_start();
$new_captain = $_POST['player'];
$select_team = $_SESSION['team_to_expel_player'];
$conn = mysqli_connect("localhost","root","","futebolamador");
if($conn -> connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "UPDATE equipa SET capitao='$new_captain' WHERE nome='$select_team'";
if($conn->query($sql)){
    echo "<script>alert('Capitao Mudado Com Sucesso');window.location='../2adminInicio/adminInicio.php';</script>";
}
$conn->close();
