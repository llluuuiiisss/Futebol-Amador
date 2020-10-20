<?php
$selected_player = $_POST['player'];
echo "<script>console.log('$selected_player');</script>";
$conn = mysqli_connect("localhost","root","","futebolamador");
if($conn -> connect_error){
    die("Connection failed: ".$conn->connect_error);
}
$sql = "UPDATE utilizadores SET admin=1 WHERE username='$selected_player'";
if($conn->query($sql)===TRUE){
    echo "<script>alert('Privilégios mudados com sucesso');window.location='../2adminInicio/adminInicio.php';</script>";
}else{
    echo "<script>alert('Ocorreu um erro');window.location='../2adminInicio/adminInicio.php';</script>";
}
$conn->close();
