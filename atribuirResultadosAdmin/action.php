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


$sql4 = "UPDATE jogo SET golos1='$score1',golos2='$score2',jogado=1,conflituoso=0 where equipa1='$equipa1' and equipa2='$equipa2'";
if ($conn->query($sql4)) {
    echo "<script type='text/javascript'>alert('resultado aletrado');window.location='../4calendarioTorneioAdmin/calendarioTorneioAdmin.php';</script>";
}
else {
    echo "Error:" . $sql4 . "<br>" . $conn->error;
}
