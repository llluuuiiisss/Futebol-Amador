<?php session_start();
if(!isset($_SESSION['login_user'])){
    echo "<script> alert('Não tem permissão para ir para esta página');window.location='../0paginaInicial/paginaInicial.php';</script>";
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="selecionarEquipa.css">
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
        <li1 class="greenButton" type="button"> <a href="">Selecionar Equipa</a></li1>
        <li><a href="#">Ínicio</a></li>
        <li> <a href="#">Criar Equipa</a></li>
        <li><a href="#">Procurar Equipa</a></li>
        <li> <a href="#">Ver as Minhas Equipas</a></li>
        <li> <a href="#">Funções de Administrador</a></li>
        <li><a href="#">Terminar Sessão</a></li>
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
    //        nome do torneio que vem da file Selecionar Torneio
            $selected_torneio = $_POST['torneio'];
            $conn = mysqli_connect("localhost", "root", "", "futebolamador");
            if ($conn -> connect_error){
                die("Connection failed: ".$conn -> connect_error);
            }
            $sql = "SELECT equipa_nome FROM torneio_equipa WHERE torneio_nome = '$selected_torneio'";
            $result = $conn ->query($sql);
            if ($result -> num_rows > 0) {
                while ($row = $result -> fetch_assoc()){
                    echo "<tr><td>{$row['equipa_nome']}</td></tr>";
                }

                echo "</table>";
            }
            else{
                echo "0 result";
            }
            $conn ->close();
            ?>
        </table>
    Equipa Selecionado: <input type="text" name="equipa_nome" id="equipa_nome">
    <script>
        var table = document.getElementById('tournments');
        for(var i = 1; i < table.rows.length; i++){
            table.rows[i].onclick = function ()
            {
                document.getElementById("equipa_nome").value = this.cells[0].innerHTML;
            };
        }
    </script>
    <input type="submit" name="botaoequipa" value="Selecionar Equipa" class="buttonSubstituicao">
    </form>
</div>

<div class="classforButton">
    <a class="backButton" href="javascript:history.back()" >Voltar</a>
<!--    <input type="submit" name="insert" value="Pedir Substituição" class="buttonSubstituicao">-->
</div>
</div>
</body>
</html>