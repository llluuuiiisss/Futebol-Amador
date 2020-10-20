<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="tabelaClassificaçaoInfo.css">
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
                        echo "tabelaClassificaçaoInfo.php";
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
    <text class="title">Tabela Classificativa</text>
    <table class="tabela" border="20" width="300" cellspacing="3" cellpadding="3" >
        <thead>

        <tr>
            <th>Pos</th>
            <th>Clube</th>
            <th>TJ</th>
            <th>V</th>
            <th>E</th>
            <th>D</th>
            <th>GM</th>
            <th>GS</th>
            <th>Pts</th>
        </tr>

        </thead>
        <tbody>
        <?php
        session_start();

        $conn = mysqli_connect('localhost','root','','futebolamador');
        $username=$_SESSION['login_user'];
        if($conn->connect_error){
            die("Connection failed".$conn->connect_error);
        }
        $torneio=$_SESSION['torneio_escolhido'];

        $sql2="SELECT teams,estado FROM torneios WHERE nome='$torneio'";
        $result2=mysqli_query($conn,$sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $arrayteams = json_decode($row2['teams'],true);
        if($row2['estado']==1){

            $arrayordem=array();
            foreach ($arrayteams as $team){
                $arrayordem[$team]=0;
            }
            foreach ($arrayteams as $team){
                $sql = "SELECT data,equipa1,equipa2,golos1,golos2,jogado FROM jogo WHERE torneio= '$torneio'";
                $result = $conn->query($sql);
                if($result->num_rows >0){
                    $arrayordem[$team]=0;
                    while($row = $result->fetch_assoc()){
                        if($row['jogado']==1){
                            if ($team==$row['equipa1']){
                                if ((!empty($row['golos1'])) or (!empty($row['golos2']))){
                                    if($row['golos1']>$row['golos2']){/*equipa1 ganha*/
                                        $pts=$arrayordem[$team];
                                        $pts=$pts+3;
                                        $arrayordem[$team]=$pts;
                                    }
                                    else if($row['golos1']==$row['golos2']){/*equipa2 ganha*/
                                        $pts=$arrayordem[$team];
                                        $pts=$pts+1;
                                        $arrayordem[$team]=$pts;
                                    }
                                }
                            }
                            else if ($team==$row['equipa2']){
                                if ((!empty($row['golos1'])) or (!empty($row['golos2']))){
                                    if($row['golos1']<$row['golos2']){/*equipa1 ganha*/
                                        $pts=$arrayordem[$team];
                                        $pts=$pts+3;
                                        $arrayordem[$team]=$pts;
                                    }
                                    else if($row['golos1']==$row['golos2']){/*equipa2 ganha*/
                                        $pts=$arrayordem[$team];
                                        $pts=$pts+1;
                                        $arrayordem[$team]=$pts;
                                    }
                                }
                            }
                        }


                    }
                }
            }
            $n=count($arrayteams);
            for ($i = 1; $i <= $n; $i++) {
                $max=0;

                foreach ($arrayteams as $team){
                    if($arrayordem[$team]>=$max){
                        $maxnome=$team;
                        $max=$arrayordem[$team];
                    }

                }
                $ar=array($maxnome);
                $qweqwe=array_diff( $arrayteams, $ar );
                $arrayteams=$qweqwe;
                unset($arrayordem[$maxnome]);
                $pontos=$max;
                $max=0;
                $totalj=0;
                $vitorias=0;
                $empates=0;
                $derrotas=0;
                $golosM=0;
                $golosS=0;

                $sql = "SELECT data,equipa1,equipa2,golos1,golos2,jogado FROM jogo WHERE torneio= '$torneio'";
                $result = $conn->query($sql);
                if($result->num_rows >0){
                    while($row = $result->fetch_assoc()){
                        if($row['jogado']==1){
                            if ($maxnome==$row['equipa1']){
                                if ((!empty($row['golos1'])) or (!empty($row['golos2']))){
                                    if($row['golos1']>$row['golos2']){/*ganha*/
                                        $totalj=$totalj+1;
                                        $vitorias=$vitorias+1;
                                        $golosM=$golosM+$row['golos1'];
                                        $golosS=$golosS+$row['golos2'];
                                    }
                                    else if($row['golos1']==$row['golos2']){/*empata*/
                                        $totalj=$totalj+1;
                                        $empates=$empates+1;
                                        $golosM=$golosM+$row['golos1'];
                                        $golosS=$golosS+$row['golos2'];
                                    }
                                    else if($row['golos1']<$row['golos2']){/*perde*/
                                        $totalj=$totalj+1;
                                        $derrotas=$derrotas+1;
                                        $golosM=$golosM+$row['golos1'];
                                        $golosS=$golosS+$row['golos2'];
                                    }
                                }
                            }
                            else if ($maxnome==$row['equipa2']){
                                if ((!empty($row['golos1'])) or (!empty($row['golos2']))){
                                    if($row['golos1']<$row['golos2']){/*ganha*/
                                        $totalj=$totalj+1;
                                        $vitorias=$vitorias+1;
                                        $golosM=$golosM+$row['golos2'];
                                        $golosS=$golosS+$row['golos1'];
                                    }
                                    else if($row['golos1']==$row['golos2']){/*empata*/
                                        $totalj=$totalj+1;
                                        $empates=$empates+1;
                                        $golosM=$golosM+$row['golos2'];
                                        $golosS=$golosS+$row['golos1'];
                                    }
                                    else if($row['golos1']>$row['golos2']){/*perde*/
                                        $totalj=$totalj+1;
                                        $derrotas=$derrotas+1;
                                        $golosM=$golosM+$row['golos2'];
                                        $golosS=$golosS+$row['golos1'];
                                    }
                                }
                            }

                        }


                    }
                }

                echo "<tr><td>$i</td><td>$maxnome</td><td>$totalj</td><td>$vitorias</td><td>$empates </td><td>$derrotas</td><td>$golosM</td><td>$golosS </td> <td>$pontos</td></tr>";
            }

        }
        else{
            $i=1;
            foreach ($arrayteams as $team){
                echo "<tr><td>$i</td><td>$team</td><td>0</td><td>0</td><td>0 </td><td>0</td><td>0</td><td>0 </td> <td>0</td></tr>";

            }

        }
        $conn->close();
        ?>


    </table>
    <a class="backButton" href="javascript:history.back()" >Voltar</a>
    </div>
</div>
</body>
</html>