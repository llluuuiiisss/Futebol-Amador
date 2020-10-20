<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="criarTorneio.css">
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
    <text class="title">Criar Torneio</text><img src="taca.png" class="tacaImg">
    <form method="post" action="action.php" class="form">
        <label>Nome: </label><input type="text" name="nome" placeholder="Introduza o nome...">
        <br>
        <label>Nº Máximo de Equipas: </label><input type="text" name="nMaxEquipas" placeholder="Introduza o nº máximo de equipas...">
        <br>
        <label>Início: </label><input type="date" name="inicio" placeholder="Introduza a data de início...">
        <br>
        <label>Fim: </label><input type="date" name="fim" placeholder="Introduza a data de fim...">
        <br>
        <label>Campo: </label><input type="text" name="campo" placeholder="Introduza o local...">
        <br>
        <label>Preço: </label><input type="text" name="preco" placeholder="Introduza o preço...">
        <input type="submit" value="Validar" class="buttonValidate">
    <a href="javascript:history.back()" class="backButton">Voltar</a>
    </form>
</div>
</body>
</html>