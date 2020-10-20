<?php
session_start();
$selected_player = filter_input(INPUT_POST, 'player');

$conn = mysqli_connect('localhost','root','','futebolamador');
if($conn->connect_error){
    die("Connection failed".$conn->connect_error);
}

$team = $_SESSION['equipa_escolhida'];
$player_to_expel = $_SESSION['player_to_expel'];
$pos=$_SESSION['pos'];

$sql1 = "SELECT username,estatuto FROM guardaredes WHERE username='$selected_player'";
$sql2 = "SELECT username,estatuto FROM defesa WHERE username='$selected_player'";
$sql3 = "SELECT username,estatuto FROM medio WHERE username='$selected_player'";
$sql4 = "SELECT username,estatuto FROM avancado WHERE username='$selected_player'";

$result1 = mysqli_query($conn,$sql1);
$result2 = mysqli_query($conn,$sql2);
$result3 = mysqli_query($conn,$sql3);
$result4 = mysqli_query($conn,$sql4);

$row1 = mysqli_fetch_assoc($result1);
$row2 = mysqli_fetch_assoc($result2);
$row3 = mysqli_fetch_assoc($result3);
$row4 = mysqli_fetch_assoc($result4);
echo $selected_player.";".$player_to_expel.";".$pos;
if($pos=='guardaredes'){
    $sql11 = "UPDATE guardaredes SET estatuto='titular' WHERE username='$selected_player'";
    $sql12 = "UPDATE defesa SET estatuto='titular1' WHERE username='$selected_player'";
    $sql13 = "UPDATE medio SET estatuto='titular1' WHERE username='$selected_player'";
    $sql14 = "UPDATE avancado SET estatuto='titular1' WHERE username='$selected_player'";
}
else if($pos=='defesa'){
    $sql11 = "UPDATE guardaredes SET estatuto='titular1' WHERE username='$selected_player'";
    $sql12 = "UPDATE defesa SET estatuto='titular' WHERE username='$selected_player'";
    $sql13 = "UPDATE medio SET estatuto='titular1' WHERE username='$selected_player'";
    $sql14 = "UPDATE avancado SET estatuto='titular1' WHERE username='$selected_player'";
}
else if($pos=='medio'){
    $sql11 = "UPDATE guardaredes SET estatuto='titular1' WHERE username='$selected_player'";
    $sql12 = "UPDATE defesa SET estatuto='titular1' WHERE username='$selected_player'";
    $sql13 = "UPDATE medio SET estatuto='titular' WHERE username='$selected_player'";
    $sql14 = "UPDATE avancado SET estatuto='titular1' WHERE username='$selected_player'";}
else if($pos=='avancado'){
    $sql11 = "UPDATE guardaredes SET estatuto='titular1' WHERE username='$selected_player'";
    $sql12 = "UPDATE defesa SET estatuto='titular1' WHERE username='$selected_player'";
    $sql13 = "UPDATE medio SET estatuto='titular1' WHERE username='$selected_player'";
    $sql14 = "UPDATE avancado SET estatuto='titular' WHERE username='$selected_player'";}



$sqle1 = "SELECT username,estatuto FROM guardaredes WHERE username='$player_to_expel'";
$sqle2 = "SELECT username,estatuto FROM defesa WHERE username='$player_to_expel'";
$sqle3 = "SELECT username,estatuto FROM medio WHERE username='$player_to_expel'";
$sqle4 = "SELECT username,estatuto FROM avancado WHERE username='$player_to_expel'";

$resulte1 = mysqli_query($conn,$sqle1);
$resulte2 = mysqli_query($conn,$sqle2);
$resulte3 = mysqli_query($conn,$sqle3);
$resulte4 = mysqli_query($conn,$sqle4);

$rowe1 = mysqli_fetch_assoc($resulte1);
$rowe2 = mysqli_fetch_assoc($resulte2);
$rowe3 = mysqli_fetch_assoc($resulte3);
$rowe4 = mysqli_fetch_assoc($resulte4);

if($pos=='guardaredes'){
    $sqle1 = "UPDATE guardaredes SET estatuto='suplente' WHERE username='$player_to_expel'";
    $sqle2 = "UPDATE defesa SET estatuto='suplente1' WHERE username='$player_to_expel'";
    $sqle3 = "UPDATE medio SET estatuto='suplente1' WHERE username='$player_to_expel'";
    $sqle4 = "UPDATE avancado SET estatuto='suplente1' WHERE username='$player_to_expel'";
}
if($pos=='defesa'){
    $sqle1 = "UPDATE guardaredes SET estatuto='suplente1' WHERE username='$player_to_expel'";
    $sqle2 = "UPDATE defesa SET estatuto='suplente' WHERE username='$player_to_expel'";
    $sqle3 = "UPDATE medio SET estatuto='suplente1' WHERE username='$player_to_expel'";
    $sqle4 = "UPDATE avancado SET estatuto='suplente1' WHERE username='$player_to_expel'";}
if($pos=='medio'){
    $sqle1 = "UPDATE guardaredes SET estatuto='suplente1' WHERE username='$player_to_expel'";
    $sqle2 = "UPDATE defesa SET estatuto='suplente1' WHERE username='$player_to_expel'";
    $sqle3 = "UPDATE medio SET estatuto='suplente' WHERE username='$player_to_expel'";
    $sqle4 = "UPDATE avancado SET estatuto='suplente1' WHERE username='$player_to_expel'";}
if($pos=='avancado'){
    $sqle1 = "UPDATE guardaredes SET estatuto='suplente1' WHERE username='$player_to_expel'";
    $sqle2 = "UPDATE defesa SET estatuto='suplente1' WHERE username='$player_to_expel'";
    $sqle3 = "UPDATE medio SET estatuto='suplente1' WHERE username='$player_to_expel'";
    $sqle4 = "UPDATE avancado SET estatuto='suplente' WHERE username='$player_to_expel'";}

if($conn->query($sql11) and $conn->query($sql12) and $conn->query($sql13) and $conn->query($sql14) and $conn->query($sqle1) and $conn->query($sqle2) and $conn->query($sqle3) and $conn->query($sqle4)){

    echo "<script>alert('Substituição feita com sucesso');window.location='../4quatroButoes/quatroButoes.php';</script>";
}






