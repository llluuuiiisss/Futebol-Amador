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
    <link rel="stylesheet" type="text/css" href="notificacoes.css">
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
        <li><a href="../3infoTorneio/infoTorneio.php">Procurar Torneios</a></li>
        <li> <a href="../4torneiosCriarEquipa/torneiosCriarEquipa.php">Criar Equipa</a></li>
        <li><a href="">Procurar Equipa</a></li>
        <li> <a href="../3minhasEquipas/minhasEquipas.php">Ver as Minhas Equipas</a></li>
        <li><a href="<?php
            $query = "SELECT username,admin FROM utilizadores";
            $result = mysqli_query($conn,$query);
            while($row = mysqli_fetch_assoc($result)){
            if($row['username'] == $_SESSION['login_user']){
            if($row['admin']==0){
            echo "notificacoes.php";
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
    <table class="tournments">
        <?php
        $equipa = $_SESSION['equipa_escolhida'];
        $sql = "SELECT jogadorantes,jogadordepois FROM notifacacao WHERE equipa='$equipa'";
        $result = $conn->query($sql);
        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
                echo "<tr><td>O jogador {$row['jogadorantes']} vai ser substituído por {$row['jogadordepois']}</td></tr>";
            }
        }else{
            echo "<tr><td>Não há substituições</td></tr>";
        }

        ?>
    </table>
</div>
<div class="pedido">
    <table class="tournments">
        <?php
        $sql = "SELECT jogador FROM pedido WHERE equipa='$equipa'";
        $result = $conn->query($sql);
        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
                echo "<tr><td>O jogador {$row['jogador']} quer ser substituído</td></tr>";
            }
        }else{
            echo "<tr><td>Não há pedidos de substituição</td></tr>";
        }
        ?>
    </table>
</div>
<div class="buttonlocate">
    <a href="../fazerSubstituicao/fazerSubstituicao.php" class="button">Substituir</a>
</div>
</body>
</html>