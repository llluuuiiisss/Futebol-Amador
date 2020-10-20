<?php
session_start();
$equipa = filter_input(INPUT_POST,'equipa');
if(!empty($equipa)){
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "futebolamador";

    $conn = new mysqli($host,$dbusername,$dbpassword,$dbname);
    if(mysqli_connect_error()){
        die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
    }else {
        if(isset($_POST['botao'])){
            $_SESSION['equipa_escolhida'] = $equipa;
            //adicionar as equipas
            $user = $_SESSION['login_user'];
            echo "equipa:".$equipa."  user:".$user;
            $sql23="SELECT teams FROM utilizadores WHERE username='$user'";
            $result23=mysqli_query($conn,$sql23);
            $row23 = mysqli_fetch_assoc($result23);
            if(!empty($row23['teams'])){
                $arrayteams = json_decode($row23['teams'],true);
                if(is_null($arrayteams)){
                    $arrayteams = array($equipa);
                }
                else{
                    array_push($arrayteams,$equipa);
                }
            }else{
                $arrayteams = array($equipa);
            }
            print_r($arrayteams);
            $arrayteams = json_encode($arrayteams);
            $sql4 = "UPDATE utilizadores SET teams='$arrayteams' where username ='$user'";

            if ($conn->query($sql4)) {
                echo "<script type='text/javascript'>alert('Inscrito');window.location='../4posicoesJoga/posicoesJoga.php';</script>";
            } else {
                echo "Error:" . $sql . "<br>" . $conn->error;
            }
            //header('location: ../3selecionarEquipaInscrever/selecionarEquipaInscrever.php');
        }else if(isset($_POST['equipa_nome'])){
            //Inscrever na equipa
            //
        }
    }
}else{
    echo "<script>alert('Nome do torneio não definido');window.location='torneiosCriarEquipa.php';</script>;";
}
