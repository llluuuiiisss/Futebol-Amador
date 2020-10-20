<?php
session_start();
/*if(!isset($_SESSION['login_user'])){
    echo "<script> alert('Não tem permissão para ir para esta página');window.location='../0paginaInicial/paginaInicial.php';</script>";
}*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="posicoesJogaCriar.css">
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
                        echo "posicoesJogaCriar.php";
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
    <text class="title">Em que posições joga?</text>

    <div class="asd">
        <img src="../guarda-redes.png" width="250" height="400" alt="gr" >
        <img src="../def.png" width="230" height="400" alt="df" >
        <img src="../medio.png" width="230" height="400" alt="md" >
        <img src="../ata.png" width="300" height="400" alt="pl" >
    </div>
    <div class="check">
        <form method="post" action="action.php">
            <input class="check1" type="checkbox" name="guardaredes" id="guardaredes">
            <label for="guarda-redes">Guarda-Redes</label>
            <input class="check2" type="checkbox" name="defesa" id="defesa">
            <label for="defesa">Defesa</label>
            <input class="check3" type="checkbox" name="medio" id="medio">
            <label for="medio">Médio</label>
            <input class="check4" type="checkbox" name="avancado" id="avancado">
            <label for="avancado">Avançado</label>
            <input class="choose" type="submit" value="Escolher Posição">
        </form>
    <div class="classforButton">
        <a class="backButton" href="javascript:history.back()"  >Voltar</a>
    </div>
</div>

</div>
</body>
</html>