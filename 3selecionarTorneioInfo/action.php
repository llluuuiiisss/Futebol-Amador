<?php
session_start();
$torneio = filter_input(INPUT_POST,'torneio');
if(!empty($torneio)){
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "futebolamador";

    $conn = new mysqli($host,$dbusername,$dbpassword,$dbname);
    if(mysqli_connect_error()){
        die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
    }else {
        if(isset($_POST['botao'])){
            $_SESSION['torneio_escolhido'] = $torneio;
            header('location: ../torneioOpcoes/torneioOpcoes.php');
        }else if(isset($_POST['equipa_nome'])){
            //Inscrever na equipa
            //
        }
    }
}else{
    echo "<script>alert('Nome do torneio não definido');window.location='torneiosCriarEquipa.php';</script>;";
}
