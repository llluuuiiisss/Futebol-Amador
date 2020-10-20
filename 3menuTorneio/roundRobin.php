<?php
session_start();
$torneio = $_SESSION['torneio_escolhido'];
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "futebolamador";

$conn = new mysqli($host,$dbusername,$dbpassword,$dbname);


if(mysqli_connect_error()){
    die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
}else{

    $query20="SELECT estado FROM torneios WHERE nome='$torneio'";
    $result20=mysqli_query($conn,$query20);
    $row20=mysqli_fetch_assoc($result20);
    $state = $row20['estado'];
    if($state==0){
        $sql="SELECT teams,end,start FROM torneios WHERE nome='$torneio'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
        $teams = json_decode($row['teams'],true);
        $num_teams= count($teams);
        $start = date_create($row['start']);
        $end = date_create($row['end']);
        $data_jogo=$start;
        $diff2 = date_diff($start,$end);
        $diff=$diff2->days;
        if($num_teams % 2!=0){
            $push = array_push($teams, "0none0");
            $num_teams++;
        }
        $n2=($num_teams-1)/2;
        $n3=$num_teams-1;
        $aux=$start->format('Y-m-d');
        $add=($diff - ($diff % $n3)) / $n3;
        $add=2;
        $addata="P".$add."D";
        for ($i=0;$i<$num_teams-1;$i++){
            echo "<br>"."data jornada:".$aux."<br>";
            $aux = date('Y-m-d');
            $d = new DateTime($aux);
            for($j=0;$j<$n2;$j++){
                //$data_jogo->modify($addata);
                //$data_jogo = strtotime($data_jogo . '+ '.$addata.'days');
                if ($add!=0){
                    $data_jogo->add(new DateInterval($addata));
                }
                $aux=$start->format('Y-m-d');
                $team1=$teams[$n2-$j];
                $team2=$teams[$n2+$j+1];
                $results[$team1][$i]=$team2;
                $results[$team2][$i]=$team1;
                if ($team1=="0none0" or $team2=="0none0"){//aqui a equipa tem folga logo nao se regista jogo
                    echo $results[$team1][$i]."vs".$results[$team2][$i].";<br>";
                }
                else{//registar o jogo
                    $host = "localhost";
                    $dbusername = "root";
                    $dbpassword = "";
                    $dbname = "futebolamador";
                    $conn = new mysqli($host,$dbusername,$dbpassword,$dbname);
                    if(mysqli_connect_error()){
                        die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
                    }else{
                        echo $results[$team1][$i]."vs".$results[$team2][$i]."<br>";
                        $sql = "INSERT INTO jogo(data,equipa1,equipa2,torneio) values ('$aux','$team1','$team2','$torneio')";
                        echo "escreveu<br>";
                    }
                    if ($conn->query($sql)) {

                    } else {
                        echo "Error:" . $sql . "<br>" . $conn->error;
                    }


                }

            }
            $temp=$teams[1];
            for($k=1;$k<sizeof($teams)-1;$k++){
                $teams[$k]=$teams[$k+1];
            }
            $teams[sizeof($teams)-1]=$temp;

        }
        $sql = "INSERT INTO jogo(data,equipa1,equipa2) values ('$aux','$team1','$team2')";
        $sql1 = "UPDATE torneios SET estado=1 where nome ='$torneio'";
        if ($conn->query($sql1)) {

        } else {
            echo "Error:" . $sql1 . "<br>" . $conn->error;
        }
        $conn->close();
        //unset($_SESSION['torneio_escolhido']);
        //$_SESSION['nome_equipa'] = $nome_equipa;
        echo "<script type='text/javascript'>alert('torneio iniciado');window.location='../4calendarioTorneioAdmin/calendarioTorneioAdmin.php';</script>";

    }
    else {
        echo "<script type='text/javascript'>alert('torneio ja iniciado');window.location='menuTorneio.php';</script>";
    }


}

