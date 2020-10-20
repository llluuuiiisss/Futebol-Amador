<?php session_start();
if(!isset($_SESSION['login_user'])){
    echo "<script> alert('Não tem permissão para ir para esta página');window.location='../0paginaInicial/paginaInicial.php';</script>";
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="resultadosConflituosos.css">
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
    <text class="title">Resultados Conflituosos</text>
    <form method="post" action="action.php" class="form">
    <table id="tournments" class="tournments">
        <?php
        $conn = mysqli_connect("localhost", "root", "", "futebolamador");
        if ($conn -> connect_error){
            die("Connection failed: ".$conn -> connect_error);
        }
        $sql = "SELECT equipa1, equipa2, torneio, conflituoso FROM jogo";
        $result = $conn ->query($sql);
        if ($result -> num_rows > 0) {
            while ($row = $result -> fetch_assoc()){
                if($row['conflituoso']==1){
                    echo "<tr><td>{$row['equipa1']}</td><td>{$row['equipa2']}</td><td>{$row['torneio']}</td></tr>";
                }

            }
        }
        ?>
    </table>
    Equipa1: <input type="text" name="equipa1" id="equipa1">
    Equipa2: <input type="text" name="equipa2" id="equipa2">
    Torneio: <input type="text" name="torneio" id="torneio">
    <script>
        var table = document.getElementById("tournments");
        for(var i=0;i<table.rows.length; i++){
            table.rows[i].onclick = function(){
                document.getElementById("equipa1").value = this.cells[0].innerHTML;
                document.getElementById("equipa2").value = this.cells[1].innerHTML;
                document.getElementById("torneio").value = this.cells[2].innerHTML;
            }
        }
    </script>
    <input class="backButton" type="submit" Value="Selecionar Jogo">
    </form>
</div>
    <div class="classforButton">
        <a class="backButton" href="javascript:history.back()" >Voltar</a>
    </div>
</div>
</body>
</html>