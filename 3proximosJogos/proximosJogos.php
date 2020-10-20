<?php session_start();
if(!isset($_SESSION['login_user'])){
    echo "<script> alert('Não tem permissão para ir para esta página');window.location='../0paginaInicial/paginaInicial.php';</script>";
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="proximosJogos.css">
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
                        echo "proximosJogos.php";
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
    <text class="title">Os Teus Próximos Jogos</text>
    <table id="tournments" class="tournments">
            <?php
            $usernamee=$_SESSION['login_user'];
            $conn = mysqli_connect('localhost','root','','futebolamador');
            if($conn->connect_error){
                die("Connection failed".$conn->connect_error);
            }
            $sql2="SELECT teams FROM utilizadores WHERE username='$usernamee'";
            $result2=$conn->query($sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $arrayteams = json_decode($row2['teams'],true);
            if(!empty($arrayteams)){
                foreach ($arrayteams as $team){
                    $sql = "SELECT data,equipa1,equipa2,golos1,golos2 FROM jogo";
                    $result = $conn->query($sql);
                    if($result->num_rows >0){
                        while($row = $result->fetch_assoc()){//vai percorrer os jogos todos
                            if(($row['equipa1']==$team or $row['equipa2']==$team) and(empty($row['golos1'])and empty($row['golos2'])) ){
                                echo "<tr><td>{$row['equipa1']} VS {$row['equipa2']}</td><td> Data :{$row['data']}</td></tr>";
                            }
                        }
                    }

                }
            }


            $conn->close();
            ?>
        </table>

</div>
</body>
</html>