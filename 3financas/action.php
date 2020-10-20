<?php
session_start();
$valor = filter_input(INPUT_POST,'value_to_add');
$user = $_SESSION['login_user'];
if(!empty($valor)){
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "futebolamador";

    $conn = new mysqli($host,$dbusername,$dbpassword,$dbname);
    if(mysqli_connect_error()){
        die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
    }else {
        $sql = "SELECT saldo FROM utilizadores WHERE username='$user'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
        $saldo = $row['saldo'];
        $saldo_acrescentar = $saldo+$valor;
        $sql2 = "UPDATE utilizadores SET saldo='$saldo_acrescentar' WHERE username ='$user'";
        if($conn->query($sql2)){
            echo "<script>alert('Saldo acrescentado com suceeso');window.location='../3proximosJogos/proximosJogos.php';</script>";
        }
    }
}else{
    echo "<script>alert('Nenhum valor definido');window.location='financas.php';</script>";
}
