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
    <link rel="stylesheet" type="text/css" href="pedirSubstituicao.css">
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
    <text class ="bodyText">class ="bodyText"><?php
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
                        echo "pedirSubstituicao.php";
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
<!--    <div class="title"><p>Equipa 1 vs Equipa 2</p></div>-->
    <table class="title">
        <?php
        $conn = mysqli_connect('localhost','root','','futebolamador');
        if($conn->connect_error){
            die("Connection failed".$conn->connect_error);
        }
        // ir buscar nome do jogo
        $sql = "SELECT equipa1, equipa2 FROM jogo WHERE faltas ='2'";
        $result = $conn->query($sql);
        if($result->num_rows >0){
            while($row = $result->fetch_assoc()){
                echo "<tr><td>{$row['equipa1']} vs {$row['equipa2']}</td></tr>";
            }
        }
        $conn->close();
        ?>
    </table>
    <form id="myform" action="action.php" method="post">
        <table id="tournments" class="tournments">
            <tr>
                <th> Jogadores </th>
            </tr>
            <?php
            $conn = mysqli_connect("localhost", "root", "", "futebolamador");
            if ($conn -> connect_error){
                die("Connection failed: ".$conn -> connect_error);
            }
            $sql = "SELECT username FROM utilizadores";
            $result = $conn ->query($sql);
            if ($result -> num_rows > 0) {
                while ($row = $result -> fetch_assoc()){
                    echo "<tr><td>{$row['username']}</td></tr>";
                }

                echo "</table>";
            }
            else{
                echo "0 result";
            }
            $conn ->close();
            ?>
        </table>
        Jogador Selecionado: <input type="text" name="torneio" id="torneio">

        <script>
            var table = document.getElementById('tournments');
            for(var i = 1; i < table.rows.length; i++){
                table.rows[i].onclick = function ()
                {
                    document.getElementById("torneio").value = this.cells[0].innerHTML;
                };
            }
        </script>
        <input type="submit" name="botao" value="Selecionar Jogador" class="buttonSubstituicao" >
    </form>
</div>

<div class="classforButton">
    <a class="backButton" href="javascript:history.back()" >Voltar</a>
    <!--    <input type="submit" name="insert" value="Pedir Substituição" class="buttonSubstituicao">-->
</div>
</div>
</body>
</html>