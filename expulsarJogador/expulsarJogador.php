<?php session_start();
if(!isset($_SESSION['login_user'])){
    echo "<script> alert('Não tem permissão para ir para esta página');window.location='../0paginaInicial/paginaInicial.php';</script>";
}
$torneio_escolhido = $_SESSION['torneio_escolhido'];
                
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="expulsarJogador.css">
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
        <text class="title">Selecione a equipa</text>
        <form id="myform" action="action.php" method="post">
            <select class="dropdown" name="team">
                <?php
                $torneio_escolhido = $_SESSION['torneio_escolhido'];
                echo "torneio:".$torneio_escolhido;
                $sql = "SELECT teams FROM torneios WHERE nome = '$torneio_escolhido'";
                $result = $conn->query($sql);
                $row=mysqli_fetch_assoc($result);
                $array = json_decode($row['teams'],true);
                foreach($array as $team){
                     echo "<option value='{$team}'> {$team}</option>";
                }
                $conn->close();
                ?>
            </select>
            <a type="submit" form="myform"> <button>Selecionar Equipa</button></a>
        </form>
		
		
        <a class="backButton" href="javascript:history.back()"  >Voltar</a>

    </div>

    
</body>
</html>