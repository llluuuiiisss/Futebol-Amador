<?php
session_start();
$torneio = filter_input(INPUT_POST,'torneio');
$equipa = filter_input(INPUT_POST,'equipa_nome');
if(!empty($torneio)){
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "futebolamador";

    $conn = new mysqli($host,$dbusername,$dbpassword,$dbname);
    if(mysqli_connect_error()){
        die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
    }else {
        $query = "SELECT username FROM utilizadores";
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['username'] == $_SESSION['login_user']) {

                $sql = "INSERT INTO subs(nome) values ('$torneio')";
                if ($conn->query($sql)) {
                    echo "<script>alert('Jogador selecionado com sucesso');window.location='../3garantirSubstitutos/garantirSubstitutos.php';</script>";
                }
            }
        }
    }
}else{
    echo "<script>alert('Nenhum Jogador definido');window.location='financas.php';</script>";
}
