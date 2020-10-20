<?php
session_start();
$select_team = $_POST['team'];
$conn = mysqli_connect("localhost","root","","futebolamador");
if($conn -> connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
unset($_SESSION['torneio_escolhido']);
$_SESSION['team_to_expel_player']=$select_team;
header('location:../expulsarJogador2/expulsarJogador2.php');
$conn->close();
