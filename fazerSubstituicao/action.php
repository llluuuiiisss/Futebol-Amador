<?php
session_start();
$selected_player = filter_input(INPUT_POST, 'player');

$conn = mysqli_connect('localhost','root','','futebolamador');
if($conn->connect_error){
    die("Connection failed".$conn->connect_error);
}

$_SESSION['player_to_expel'] = $selected_player;

header('location: ../fazerSubstituicao2/fazerSubstituicao.php');
