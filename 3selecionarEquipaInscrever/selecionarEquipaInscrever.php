<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="selecionarEquipaInscrever.css">
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
        session_start();
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
                        echo "selecionarEquipaInscrever.php";
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
    <text class="title">Selecione uma Equipa</text>
    <form id="myform" action="action.php" method="post">
    <table id="tournments" class="tournments">
        <tr>
            <th> Equipa </th>
        </tr>
        <?php
        $torneio=$_SESSION['torneio_escolhido'];
        $conn = mysqli_connect("localhost", "root", "", "futebolamador");
        if ($conn -> connect_error){
            die("Connection failed: ".$conn -> connect_error);
        }
        $sql2="SELECT teams FROM torneios WHERE nome='$torneio'";
        $result2=mysqli_query($conn,$sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $arrayteams = json_decode($row2['teams'],true);
        if (!empty($arrayteams)){
            foreach ($arrayteams as $team){
                echo "<tr><td>{$team}</td> </tr>";
            }
        }
        else{
            echo "<tr><th>Nao existem equipas incritas no torneio</th></tr>";
        }


        $conn ->close();
        ?>
    </table>
    Equipa Selecionada: <input type="text" name="equipa" id="equipa">

    <script>
        var table = document.getElementById('tournments');
        for(var i = 1; i < table.rows.length; i++){
            table.rows[i].onclick = function ()
            {
                document.getElementById("equipa").value = this.cells[0].innerHTML;
            };
        }
    </script>
    <input type="submit" name="botao" value="Selecionar Equipa" class="buttonSubstituicao" >
    </form>

</div>



<div class="classforButton">
    <a class="backButton" href="javascript:history.back()"  >Voltar</a>
</div>
</div>
</body>
</html>