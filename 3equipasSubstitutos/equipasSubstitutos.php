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
    <link rel="stylesheet" type="text/css" href="equipasSubstitutos.css">
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
    <img src="user.png" class="playerImg">
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
                        echo "equipasSubstitutos.php";
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
    <div class="title"><p>Menu de Substituição</p><br></div>
    <form  class="form" method="post" action="action.php">
        <a type="submit" href="../3garantirSubstitutos/garantirSubstitutos.php" class="buttonSubstituto">Garantir Substituto</a>
        <a type="submit" href="action.php" name="addSubstituicao" class="buttonSubstituicao">Pedir Substituição</a>
        <a type="submit" href="<?php
        $conn = mysqli_connect('localhost','root','','futebolamador');
        if($conn->connect_error){
            die("Connection failed".$conn->connect_error);
        }
        $nome_equipa = $_SESSION['equipa_escolhida'];
        $queryx = "SELECT capitao from equipa WHERE nome='$nome_equipa'";
        $resultx = mysqli_query($conn,$queryx);
        $rowx = mysqli_fetch_assoc($resultx);
        if($_SESSION['login_user'] == $rowx['capitao']){
            echo "../fazerSubstituicao/fazerSubstituicao.php";
        }else{
            echo "equipasSubstitutos.php";
        }
        ?>" class="buttonSubstituicao2">Fazer Substituição</a>
        <a href="javascript:history.back()" class="backButton">Voltar</a>
    </form>
</div>
</body>
</html>