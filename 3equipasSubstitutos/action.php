<?php
session_start();
$conn = mysqli_connect("localhost","root","","futebolamador");
if($conn -> connect_error){
    die("Connection failed: ".$conn->connect_error);
}
$jogador = $_SESSION['login_user'];
$equipa = $_SESSION['equipa_escolhida'];


$sql ="INSERT INTO pedido(equipa,jogador) values ('$equipa','$jogador')";
if($conn->query($sql)){
    echo "<script>alert('Substituição pedida com sucesso');window.location='../4quatroButoes/quatroButoes.php';</script>";
}else{
    echo"Erro";
}