<?php
session_start();

$conn = mysqli_connect("localhost","root","","futebolamador");
if($conn -> connect_error){
    die("Connection failed: ".$conn->connect_error);
}

if(isset($_POST['inittournment'])){
    header('location:roundRobin.php');
}else if(isset($_POST['expelplayer'])){

}else if(isset($_POST['table'])){
    header("location:../tabelaClassificaçao/tabelaClassificaçao.php");
}
