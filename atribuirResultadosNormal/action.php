<?php

session_start();
$conn = mysqli_connect("localhost","root","","futebolamador");
if($conn -> connect_error){
    die("Connection failed: ".$conn->connect_error);
}
$score1 = $_POST['score1'];
$score2 = $_POST['score2'];
$equipa1=$_SESSION['equipa1'];
$equipa2=$_SESSION['equipa2'];

$query20="SELECT golos1,golos2,jogado FROM torneios WHERE nome='$torneio'";
$result20=mysqli_query($conn,$query20);
$row20=mysqli_fetch_assoc($result20);
$state = $row20['jogado'];

if($jogado==1){
    if($row20['golos1']!=$score1 or $row20['golos2']!=$score2){
        $sql4 = "UPDATE jogo SET golos1='$score1',golos2='$score2',jogado=1,conflituoso=1	 where equipa1='$equipa1' and equipa2='$equipa2'";
        if ($conn->query($sql4)) {
            echo "<script type='text/javascript'>alert('Resultado Conflituoso!');window.location='../4calendarioTorneio/calendarioTorneio.php';</script>";
        } else {
            echo "Error:" . $sql . "<br>" . $conn->error;
        }
    }
    else{
        echo "<script type='text/javascript'>alert('Resultado Fornecido');window.location='../4calendarioTorneio/calendarioTorneio.php';</script>";
    }
}
else{
    $sql4 = "UPDATE jogo SET golos1='$score1',golos2='$score2',jogado=1 where equipa1='$equipa1' and equipa2='$equipa2'";
    if ($conn->query($sql4)) {
        echo "<script type='text/javascript'>alert('Resultado Fornecido');window.location='../4calendarioTorneio/calendarioTorneio.php';</script>";
    } else {
        echo "Error:" . $sql . "<br>" . $conn->error;
    }
}



$conn->close();


