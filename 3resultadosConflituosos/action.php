<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "futebolamador");
if ($conn -> connect_error){
    die("Connection failed: ".$conn -> connect_error);
}
$equipa1 = $_POST['equipa1'];
$equipa2 = $_POST['equipa2'];
$torneio = $_POST['torneio'];

$_SESSION['equipa1']=$equipa1;
$_SESSION['equipa2']=$equipa2;

echo "<script type='text/javascript'>window.location='../atribuirResultadosAdmin/atribuirResultados.php';</script>";