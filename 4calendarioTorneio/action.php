<?php
session_start();
$equipa1 = $_POST['equipa1'];
$equipa2= $_POST['equipa2'];
$user = $_SESSION['login_user'];

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "futebolamador";
$conn = new mysqli($host,$dbusername,$dbpassword,$dbname);
if(mysqli_connect_error()){
    die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
}

$sql = "SELECT capitao FROM equipa WHERE nome ='$equipa1'";
$sql1 = "SELECT capitao FROM equipa WHERE nome ='$equipa2'";

$result = mysqli_query($conn,$sql);
$result1 = mysqli_query($conn,$sql1);

$row=mysqli_fetch_assoc($result);
$row1=mysqli_fetch_assoc($result1);

if(($row['capitao']== $user) or ($row1['capitao']==$user)){
    echo "<script>window.location='../atribuirResultadosNormal/atribuirResultados.php';</script>";
    $_SESSION['equipa1'] = $equipa1;
    $_SESSION['equipa2'] = $equipa2;
}else{
    echo "<script>alert('Você não é capitão de nenhuma das equipas selecionadas'); window.location='calendarioTorneio.php';</script>";
}

