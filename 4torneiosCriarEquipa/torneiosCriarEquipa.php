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
    <link rel="stylesheet" type="text/css" href="torneiosCriarEquipa.css">
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
                        echo "torneiosCriarEquipa.php";
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
    <text class="title">Selecione o Torneio</text>
    <form id="myform" action="action.php" method="post">
        <table id="tournments" class="tournments">
            <?php
            $conn = mysqli_connect('localhost','root','','futebolamador');
            if($conn->connect_error){
                die("Connection failed".$conn->connect_error);
            }
            $sql = "SELECT nome,start,end,estado FROM torneios";
            $result = $conn->query($sql);
            if($result->num_rows >0){
                while($row = $result->fetch_assoc()){
                    if($row['estado']!=1){
                        echo "<tr><td>{$row['nome']}</td><td> Início :</td><td>{$row['start']}</td><td>Fim: </td><td>{$row['end']}</td></tr>";
                    }
                }
            }
            $conn->close();
            ?>
        </table>
        <br>
        Torneio Selecionado: <input type="text" name="torneio" id="torneio">
        <script>
            var table = document.getElementById("tournments");
            for(var i=0;i<table.rows.length; i++){
                table.rows[i].onclick = function(){
                    document.getElementById("torneio").value = this.cells[0].innerHTML;
                }
            }
        </script>
        <input class="backButton" type="submit" Value="Selecionar Torneio">
    </form>
</div>
<div>
    <div class="classforButton">
        <a class="backButton" href="javascript:history.back()" >Voltar</a>
    </div>
</div>
</body>
</html>