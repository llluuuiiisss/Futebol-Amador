<?php
session_start();
$torneio = filter_input(INPUT_POST,'torneio');
$user = $_SESSION['login_user'];
if(!empty($torneio)){
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "futebolamador";

    $conn = new mysqli($host,$dbusername,$dbpassword,$dbname);
    if(mysqli_connect_error()){
        die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
    }else {
        $sql="SELECT teams FROM torneios WHERE nome='$torneio'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
        $array1 = $row['teams'];
        $array_equipas_torneio =json_decode($array1,true);
        $sql2 = "SELECT teams FROM utilizadores WHERE username='$user'";
        $result2 = mysqli_query($conn,$sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $array2 = $row2['teams'];
        $array_equipas_utilizador = json_decode($array2,true);
        if(count(array_intersect($array_equipas_utilizador,$array_equipas_torneio))>0){
            echo "<script>alert('Não se pode inscrever no torneio,ja está a jogar nesse torneio');window.location='torneiosCriarEquipa.php';</script>";
        }else{
            $_SESSION['torneio_escolhido'] = $torneio;
            header('location:../3menuTorneio/menuTorneio.php');
        }
    }
}else{
    echo "<script>alert('Nome do torneio não definido');window.location='meusTorneios.php';</script>;";
}