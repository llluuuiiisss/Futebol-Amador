<?php
session_start();
if(!isset($_SESSION['login_user'])){
    echo "<script> alert('Não tem permissão para ir para esta página');window.location='../0paginaInicial/paginaInicial.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="quatroButoes.css">
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
                        echo "quatroButoes.php";
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
    <text class="title"><?php
        $equipaa=$_SESSION['equipa_escolhida'];
        echo $equipaa;
        ?></text>

    <div class="asd">
        <img src="../442.png" alt="tatica" align="middle">
    </div>
    <div class="classforButton">
        <a class="umButton" padding="15px 52px" href="<?php
        $conn = mysqli_connect('localhost','root','','futebolamador');
        if($conn->connect_error){
            die("Connection failed".$conn->connect_error);
        }
        $nome_equipa = $_SESSION['equipa_escolhida'];
        $queryx = "SELECT capitao from equipa WHERE nome='$nome_equipa'";
        $resultx = mysqli_query($conn,$queryx);
        $rowx = mysqli_fetch_assoc($resultx);
        if($_SESSION['login_user'] == $rowx['capitao']){
            echo "../notificacoes/notificacoes.php";//pagina que o boinas ainda vai fazer
        }else{
            echo "equipasSubstitutos.php";
        }
        ?>" >Ver Pedidos</a>
        <a class="doisButton" href="../torneioOpcoes/torneioOpcoes.php"  >Torneio</a>
        <a class="tresButton" href="../3equipasSubstitutos/equipasSubstitutos.php"  >Substituiçao</a>
        <a class="backButton" href="javascript:history.back()"  >Voltar</a>

    </div>
</div>
<div class="right">
    <table class="container">
        <?php

        $conn = mysqli_connect('localhost','root','','futebolamador');
            if($conn->connect_error){
                die("Connection failed".$conn->connect_error);
            }
            //gguarda redes
        $nome_equipa = $_SESSION['equipa_escolhida'];
            $sql = "SELECT username FROM guardaredes WHERE equipa='$nome_equipa' and estatuto='titular'";
            $result = $conn->query($sql);
            if($row = $result->fetch_assoc()){
                echo "<tr><td>1: {$row['username']}</td></tr>";
            }
            else{
                echo "<tr><td>1: Vazio</td></tr>";
            }
            //defesa
            $sql1 = "SELECT username FROM defesa WHERE equipa='$nome_equipa' and estatuto='titular'";
            $result1 = $conn->query($sql1);
            $i=2;
            while($row1 = $result1->fetch_assoc()){
                echo "<tr><td>{$i}: {$row1['username']}</td></tr>";
                $i++;
            }
            if($i==2){
                echo "<tr><td>2: Vazio</td></tr><tr><td>3: Vazio</td></tr><tr><td>4: Vazio</td></tr><tr><td>5: Vazio</td></tr>";
            }
            elseif ($i==3){
                echo "<tr><td>3: Vazio</td></tr><tr><td>4: Vazio</td></tr><tr><td>5: Vazio</td></tr>";
            }
            elseif ($i==4){
                echo "<tr><td>4: Vazio</td></tr><tr><td>5: Vazio</td></tr>";

            }
            elseif ($i==5){
                echo "<tr><td>5: Vazio</td></tr>";

            }

            //medio
            $sql2 = "SELECT username FROM medio WHERE equipa='$nome_equipa' and estatuto='titular'";
            $result2= $conn->query($sql2);
            $i=6;
            while($row2 = $result2->fetch_assoc()){
                echo "<tr><td>{$i}: {$row2['username']}</td></tr>";
                $i++;
            }
            if($i==6){
                echo "<tr><td>6: Vazio</td></tr><tr><td>7: Vazio</td></tr><tr><td>8: Vazio</td></tr>";
            }
            elseif ($i==7){
                echo "<tr><td>7: Vazio</td></tr><tr><td>8: Vazio</td></tr>";
            }
            elseif ($i==8){
                echo "<tr><td>8: Vazio</td></tr>";

            }
            //avancado
            $sql3 = "SELECT username FROM avancado WHERE equipa='$nome_equipa' and estatuto='titular'";
            $result3= $conn->query($sql3);
            $i=9;
            while($row3 = $result3->fetch_assoc()){
                echo "<tr><td>{$i}: {$row3['username']}</td></tr>";
                $i++;
            }
            if($i==9){
                echo "<tr><td>9: Vazio</td></tr><tr><td>10: Vazio</td></tr><tr><td>11: Vazio</td></tr>";
            }
            elseif ($i==10){
                echo "<tr><td>10: Vazio</td></tr><tr><td>11: Vazio</td></tr>";
            }
            elseif ($i==11){
                echo "<tr><td>11: Vazio</td></tr>";

            }

            //suplentes
            $nj=12;
            $sql11 = "SELECT username FROM guardaredes WHERE equipa='$nome_equipa' and estatuto='suplente'";
            $result11 = $conn->query($sql11);
            while($row11 = $result11->fetch_assoc()){
                echo "<tr><td>{$nj}: {$row11['username']}</td></tr>";
                $nj++;
            }
        $sql112 = "SELECT username FROM defesa WHERE equipa='$nome_equipa' and estatuto='suplente'";
        $result112 = $conn->query($sql112);
        while($row112 = $result112->fetch_assoc()){
            echo "<tr><td>{$nj}: {$row112['username']}</td></tr>";
            $nj++;
        }
        $sql1123 = "SELECT username FROM medio WHERE equipa='$nome_equipa' and estatuto='suplente'";
        $result1123 = $conn->query($sql1123);
        while($row1123 = $result1123->fetch_assoc()){
            echo "<tr><td>{$nj}: {$row1123['username']}</td></tr>";
            $nj++;
        }
        $sql11234 = "SELECT username FROM avancado WHERE equipa='$nome_equipa' and estatuto='suplente'";
        $result11234 = $conn->query($sql11234);
        while($row11234 = $result11234->fetch_assoc()){
            echo "<tr><td>{$nj}: {$row11234['username']}</td></tr>";
            $nj++;
        }
        $conn->close();?>


    </table>




</div>

</body>
</html>