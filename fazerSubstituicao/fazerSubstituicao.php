<?php session_start();
if(!isset($_SESSION['login_user'])){
    echo "<script> alert('Não tem permissão para ir para esta página');window.location='../0paginaInicial/paginaInicial.php';</script>";
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="fazerSubstituicao.css">
    <title>Futebol Amador</title>
</head>
<body>
<div class="header">
    <div class="headerText">
        <p>Futebol Amador</p>
    </div>
    <div class="middleRect">
        <span class="middleCircle"></span>
    </div>
</div>
<div id="navigation">
    <img src="#" class="playerImg">
    <text class ="bodyText"><?php
        $conn = mysqli_connect("localhost","root","","futebolamador");
        if($conn -> connect_error){
            die("Connection failed: ".$conn->connect_error);
        }
        $query = "SELECT username FROM utilizadores";
        $result = mysqli_query($conn,$query);
        while($row = mysqli_fetch_assoc($result)){
            if($row['username'] == $_SESSION['login_user']){
                echo $row['username'];
            }
        }
        $conn->close();
        ?></text>
    <ul>
        <li1 class="greenButton" type="button"> <a href="../3proximosJogos/proximosJogos.php">Proximos Jogos</a></li1>
        <li><a href="../3selecionarTorneioInfo/3selecionarTorneioInfo.php">Procurar Torneios</a></li>
        <li> <a href="../4torneiosCriarEquipa/torneiosCriarEquipa.php">Criar Equipa</a></li>
        <li><a href="../3selecionarTorneio/selecionarTorneio.php">Inscrever Equipa</a></li>
        <li> <a href="../3minhasEquipas/minhasEquipas.php">Ver as Minhas Equipas</a></li>
        <li> <a href="<?php
            $query = "SELECT username,admin FROM utilizadores";
            $result = mysqli_query($conn,$query);
            while($row = mysqli_fetch_assoc($result)){
                if($row['username'] == $_SESSION['login_user']){
                    if($row['admin']==0){
                        echo "fazerSubstituicao.php";
                    }else{
                        echo "../2adminInicio/adminInicio.php";
                    }
                }
            }
            ?>">Funções de Administrador</a></li>
        <li> <a href="../3financas/financas.php">Finanças</a></li>
        <li><a href="../logout.php">Terminar Sessão</a></li>
    </ul>
    <div class="line"></div>
</div>
<div class="bodyContainer">
    <text class="title">Jogador a Substituir</text>

    <form id="myform" action="action.php" method="post">
        <select class="dropdown" name="player">
            <?php
            $conn = mysqli_connect('localhost','root','','futebolamador');
            if($conn->connect_error){
                die("Connection failed".$conn->connect_error);
            }
            $players_of_team = array();
            $team = $_SESSION['equipa_escolhida'];
            $sql = "SELECT teams,username FROM utilizadores";
            $result = mysqli_query($conn,$sql);
            if($result->num_rows >0){
                while($row = $result->fetch_assoc()){
                    $arrayteams = json_decode($row['teams'],true);
                    if(in_array($team,$arrayteams)){
                        array_push($players_of_team,$row['username']);
                    }
                }
            }
            foreach ($players_of_team as $player){
                $sql1 = "SELECT estatuto FROM guardaredes WHERE username='$player'";
                $sql2 = "SELECT estatuto FROM defesa WHERE username='$player'";
                $sql3 = "SELECT estatuto FROM medio WHERE username='$player'";
                $sql4 = "SELECT estatuto FROM avancado WHERE username='$player'";

                $result1 = mysqli_query($conn,$sql1);
                $result2 = mysqli_query($conn,$sql2);
                $result3 = mysqli_query($conn,$sql3);
                $result4 = mysqli_query($conn,$sql4);

                $row1 = mysqli_fetch_assoc($result1);
                $row2 = mysqli_fetch_assoc($result2);
                $row3 = mysqli_fetch_assoc($result3);
                $row4 = mysqli_fetch_assoc($result4);
                if(($row1['estatuto'] == 'titular') or ($row2['estatuto'] == 'titular') or ($row3['estatuto'] == 'titular') or ($row4['estatuto'] == 'titular')){
                    echo "<option value='$player'>{$player}</option>";
                }
            }

            $conn->close();
            ?>
        </select>
        <a type="submit" form="myform"> <button>Selecionar Jogador a Substituir</button></a>
    </form>
    <a class="backButton" href="javascript:history.back()"  >Voltar</a>

</div>

</body>
</html>