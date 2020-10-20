<?php
$username = filter_input(INPUT_POST,"username");
$password = filter_input(INPUT_POST, "password");


$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "futebolamador";

$conn = new mysqli($host,$dbusername,$dbpassword,$dbname);

$username = stripcslashes($username);
$password = stripcslashes($password);
$username = mysqli_real_escape_string($conn,$username);
$password = mysqli_real_escape_string($conn, $password);

if(mysqli_connect_error()){
    die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
}else{
    $sql = "SELECT username,password,admin FROM utilizadores WHERE username = '$username' and password = '$password'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
    if($row['username']==$username && $row['password']==$password){
        session_start();
        $_SESSION['login_user'] = $username;
        if($row['admin']==1){
            //login admin
            header("location: ../2adminInicio/adminInicio.php");
        }else{
            //login normal
            header("location: ../2normaInicio/normaInicio.php");
        }
    }else{
        echo "<script>alert('Nome ou Password inválidas!');window.location='login.php';</script>" ;
    }
}