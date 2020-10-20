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
    <link rel="stylesheet" type="text/css" href="adminInicio.css">
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
            ?>
        </text>
        <ul>
            <li> <a href="../3criarTorneio/criarTorneio.php">Criar Torneios</a></li>
            <li><a href="../2meusTorneios/meusTorneios.php">Meus Torneios</a></li>
            <li> <a href="../3resultadosConflituosos/resultadosConflituosos.php">Conflitos de Resultados</a></li>
            <li><a href="../3tornarAdmin/tornarAdmin.php">Adicionar Administrador</a></li>
            <li> <a href="../3proximosJogos/proximosJogos.php">Sair do Modo de Administrador</a></li>
            <li><a href="../logout.php">Terminar Sessão</a></li>
        </ul>
        <div class="line"></div>
    </div>
    <div class="bodyContainer">
        <text class="title">Modo de Administrador</text>
        <img src="admin.png" class="adminImg">
    </div>
</body>
</html>