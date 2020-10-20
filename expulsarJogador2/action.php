<?php
session_start();
$select_player = $_POST['player'];
$select_team = $_SESSION['team_to_expel_player'];
$conn = mysqli_connect("localhost","root","","futebolamador");
if($conn -> connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql="SELECT teams FROM utilizadores WHERE username='$select_player'";
$result = mysqli_query($sql);
$row = mysqli_fetch_assoc($result);
$array = json_decode($row['teams'],true);
foreach($array as $team){
    if($select_team == $team){
        array_diff($array,[$team]);
    }
}
$array = json_encode($array);
$sql2 = "UPDATE utilizadores SET teams='$array' WHERE username='$select_player'";
$sql4="DELETE FROM 	guardaredes WHERE username='$select_player'";
$sql5="DELETE FROM 	defesa WHERE username='$select_player'";
$sql6="DELETE FROM 	medio WHERE username='$select_player'";
$sql7="DELETE FROM 	avancado WHERE username='$select_player'";


$sql3 = "SELECT capitao FROM equipa WHERE nome = '$select_team'";
$result2 = mysqli_query($conn,$sql3);
$row2 = mysqli_fetch_assoc($result2);
if($conn->query($sql2) and $conn->query($sql4) and $conn->query($sql5) and $conn->query($sql6) and $conn->query($sql7)){
    if($row2['capitao']==$select_player){
        echo "<script>alert('O jogador selecionado é capitão'); window.location='../expulsarJogador3/expulsarJogador3.php';</script>";
    }else{
        echo "<script>alert('Jogador expulso com sucesso');window.location='../2adminInicio/adminInicio.php';</script>";
    }
}






$conn->close();
