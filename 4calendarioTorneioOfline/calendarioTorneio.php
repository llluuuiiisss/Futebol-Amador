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

    <text class="title">Calendario </text>
        <table id="tournments" class="tournments">
            <?php
            $conn = mysqli_connect('localhost','root','','futebolamador');
            if($conn->connect_error){
                die("Connection failed".$conn->connect_error);
            }
            $torneio=$_SESSION['torneio_ofline'];
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

    <div class="classforButton">
        <a class="backButton" href="javascript:history.back()" >Voltar</a>
    </div>

</body>
</html>