<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="calendarioTorneio.css">
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
    <img src="" class="playerImg">
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
                        echo "calendarioTorneio.php";
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
    <text class="title">Calendario </text>
    <form method="post" action="action.php">
        <table id="tournments" class="tournments">
            <?php
            $conn = mysqli_connect('localhost','root','','futebolamador');
            if($conn->connect_error){
                die("Connection failed".$conn->connect_error);
            }
            $torneio=$_SESSION['torneio_escolhido'];
            $sql2="SELECT estado FROM torneios WHERE nome='$torneio'";
            $result2=mysqli_query($conn,$sql2);
            $row2 = mysqli_fetch_assoc($result2);

            if($row2['estado']==1){
                $sql = "SELECT data,equipa1,equipa2,golos1,golos2,jogado FROM jogo WHERE torneio= '$torneio'";
                $result = $conn->query($sql);
                if($result->num_rows >0){
                    $id =0;
                    while($row = $result->fetch_assoc()){
                        $golos1=$row['golos1'];
                        $golos2=$row['golos2'];
                        $resultado="";
                        if($row['jogado']==1){
                            $resultado=$golos1." - ".$golos2;
                        }
                        else{
                            $resultado="Por jogar";
                        }
                        echo "<tr><td>{$row['equipa1']}</td><td>VS</td><td>{$row['equipa2']}</td><td> Data :{$row['data']}</td><td> {$resultado}</td></tr>";
                        $id++;
                    }
                }
            }
            else{
                echo "<tr><td>Torneio ainda nao iniciado</td></tr>";
            }

            $conn->close();
            ?>
        </table>
        Equipa1: <input type="text" name="equipa1" id="equipa1">
        Equipa2: <input type="text" name="equipa2" id="equipa2">
        <script>
            var table = document.getElementById("tournments");
            for(var i=0;i<table.rows.length; i++){
                table.rows[i].onclick = function(){
                    document.getElementById("equipa1").value = this.cells[0].innerHTML;
                    document.getElementById("equipa2").value = this.cells[2].innerHTML;
                }
            }
        </script>
        <input class="backButton" type="submit" Value="Selecionar Jogo">
    </form>
    <div class="classforButton">
        <a class="backButton" href="javascript:history.back()" >Voltar</a>
    </div>
</div>
</body>
</html>