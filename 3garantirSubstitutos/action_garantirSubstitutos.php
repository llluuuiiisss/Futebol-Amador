<?php
session_start();
$firstname = filter_input(INPUT_POST, 'primeironome');
$lastname = filter_input(INPUT_POST, 'ultimonome');
if (!empty($firstname)) {
    if (!empty($lastname)) {
        $host = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "futebolamador";

        $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

        if (mysqli_connect_error()) {
            die('Connect Error(' . mysqli_connect_errno() . ')' . mysqli_connect_error());
        } else {
            $jogador_inserir = $firstname." ".$lastname;
            $nome_equipa = $_SESSION['equipa_escolhida'];
            $nome = $_SESSION['login_user'];
            $sql = "INSERT INTO notifacacao(equipa,jogadorantes,jogadordepois) values ('$nome_equipa','$nome','$jogador_inserir')";
            if ($conn->query($sql)) {
                echo "<script>alert('Substitudo submetido para avaliação com sucesso');window.location='../4quatroButoes/quatroButoes.php';</script>";
            } else {
                echo "Error:" . $sql . "<br>" . $conn->error;
            }
            $conn->close();
        }
    } else {
        echo "<script>alert('Apelido em falta!!');window.location='garantirSubstitutos.php';</script>";
    }
} else {
    echo "<script>alert('Nome Próprio em falta!!');window.location='garantirSubstitutos.php';</script>";
}
?>