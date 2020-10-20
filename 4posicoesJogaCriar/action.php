<?php
session_start();
$nome = $_SESSION['login_user'];

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "futebolamador";

$conn = new mysqli($host,$dbusername,$dbpassword,$dbname);
if(mysqli_connect_error()){
    die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
}else {
    $sql = "SELECT username,ccnumber,saldo FROM utilizadores WHERE username='$nome'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $cc = $row['ccnumber'];
    $saldo = $row['saldo'];
    $nome_equipa = $_SESSION['equipa_escolhida'];
    $sql2 = "SELECT n_jogadores FROM equipa WHERE nome='$nome_equipa'";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($result2);
    $n_jogadores = $row2['n_jogadores'];
    $ggrr=0;
    $dd=0;
    $mm=0;
    $aa=0;
    if (isset($_POST['guardaredes']) or isset($_POST['defesa']) or isset($_POST['medio']) or isset($_POST['avancado'])) {
        if (isset($_POST['guardaredes'])) {
            $ggrr=1;
            $grestatuto="titular";
            $query = "SELECT estatuto FROM guardaredes WHERE equipa='$nome_equipa'";
            $result = mysqli_query($conn,$query);
            while($row = mysqli_fetch_assoc($result)){
                if($row['estatuto']=="titular"){
                    $grestatuto="suplente";
                }
            }
        }
        if (isset($_POST['defesa'])) {
            $n_defesas=0;
            $dd=1;
            $destatuto="suplente";
            $query = "SELECT estatuto FROM defesa WHERE equipa='$nome_equipa'";
            $result = mysqli_query($conn,$query);
            while($row = mysqli_fetch_assoc($result)){
                if($row['estatuto']=="titular"){
                    $n_defesas++;
                }
            }
            if($n_defesas<4){
                $destatuto="titular";

            }
            else if($ggrr!=0){
                $destatuto="suplente";
            }
        }
        if (isset($_POST['medio'])){
            $n_medios=0;
            $mm=1;
            $mestatuto="suplente";
            $query = "SELECT estatuto FROM medio WHERE equipa='$nome_equipa'";
            $result = mysqli_query($conn,$query);
            while($row = mysqli_fetch_assoc($result)){
                if($row['estatuto']=="titular"){
                    $n_medios++;
                }
            }
            if($n_medios<3){
                $mestatuto="titular";

            }
            else{
                $mestatuto="suplente";
            }
        }
        if (isset($_POST['avancado'])) {

            $n_avançado=0;
            $aa=1;
            $aestatuto="suplente";
            $query = "SELECT estatuto FROM avancado WHERE equipa='$nome_equipa'";
            $result = mysqli_query($conn,$query);
            while($row = mysqli_fetch_assoc($result)){
                if($row['estatuto']=="titular"){
                    $n_avançado++;
                }
            }
            if($n_avançado<3){
                $aestatuto="titular";
            }
            else {
                $aestatuto="titular";
            }
        }
        $jata=0;
        $jgr=$ggrr;
        $jd=$dd;
        $jm=$mm;
        $ja=$aa;
        if($ggrr!=0 and $jata==0){
            if($grestatuto=="titular"){
                if ($dd!=0){
                    $destatuto="titular1";
                }
                if ($mm!=0){
                    $mestatuto="titular1";
                }
                if ($aa!=0){
                    $aestatuto="titular1";
                }
                $grestatuto="titular";
                $jata=1;
            }
        }
        if($dd!=0 and $jata==0){
            if($destatuto=="titular"){
                if ($ggrr!=0){
                    $grestatuto="titular1";
                }
                if ($mm!=0){
                    $mestatuto="titular1";
                }
                if ($aa!=0){
                    $aestatuto="titular1";

                }
                $destatuto="titular";
                $jata=1;
            }
        }
        if($mm!=0 and $jata==0){
            if($mestatuto=="titular"){
                if ($ggrr!=0){
                    $grestatuto="titular1";
                }
                if ($dd!=0){
                    $destatuto="titular1";
                }
                if ($aa!=0){
                    $aestatuto="titular1";

                }
                $mestatuto="titular";
                $jata=1;
            }
        }
        if($aa!=0 and $jata==0){
            if($aestatuto=="titular"){
                if ($ggrr!=0){
                    $grestatuto="titular1";
                }
                if ($dd!=0){
                    $destatuto="titular1";
                }
                if ($mm!=0){
                    $mestatuto="titular1";

                }
                $aestatuto="titular";
                $jata=1;
            }
        }

        //suplente
        if($ggrr!=0 and $jata==0){
            if($grestatuto=="suplente"){
                if ($dd!=0){
                    $destatuto="suplente1";
                }
                if ($mm!=0){
                    $mestatuto="suplente1";
                }
                if ($aa!=0){
                    $aestatuto="suplente1";
                }
                $grestatuto="suplente";
                $jata=1;
            }
        }
        if($dd!=0 and $jata==0){
            if($destatuto=="suplente"){
                if ($ggrr!=0){
                    $grestatuto="suplente1";
                }
                if ($mm!=0){
                    $mestatuto="suplente1";
                }
                if ($aa!=0){
                    $aestatuto="suplente1";

                }
                $destatuto="suplente";
                $jata=1;
            }
        }
        if($mm!=0 and $jata==0){
            if($mestatuto=="suplente"){
                if ($ggrr!=0){
                    $grestatuto="suplente1";
                }
                if ($dd!=0){
                    $destatuto="suplente1";
                }
                if ($aa!=0){
                    $aestatuto="suplente1";

                }
                $mestatuto="suplente";
                $jata=1;
            }
        }
        if($aa!=0 and $jata==0){
            if($aestatuto=="suplente"){
                if ($ggrr!=0){
                    $grestatuto="suplente1";
                }
                if ($dd!=0){
                    $destatuto="suplente1";
                }
                if ($mm!=0){
                    $mestatuto="suplente1";

                }
                $aestatuto="suplente";
                $jata=1;
            }
        }

        if($ggrr!=0){
            $gr = "INSERT INTO guardaredes(saldo,estatuto,username,equipa) values ('$saldo','$grestatuto','$nome','$nome_equipa')";
            if ($conn->query($gr)) {
                echo "<script type='text/javascript'>alert('Posição registada com sucesso');window.location='../4quatroButoes/quatroButoes.php';</script>";
            } else {
                echo "<script>alert('Erro1')</script>";
            }
        }
        if($dd!=0){
            $d = "INSERT INTO defesa(saldo,estatuto,username,equipa) values ('$saldo','$destatuto','$nome','$nome_equipa')";
            if ($conn->query($d)) {
                echo "<script type='text/javascript'>alert('Posição registada com sucesso');window.location='../4quatroButoes/quatroButoes.php';</script>";
            } else {
                echo "<script>alert('Erro2')</script>";
            }
        }
        if($mm!=0){
            $m = "INSERT INTO medio(saldo,estatuto,username,equipa) values ('$saldo','$mestatuto','$nome','$nome_equipa')";
            if ($conn->query($m)) {
                echo "<script type='text/javascript'>alert('Posição registada com sucesso');window.location='../4quatroButoes/quatroButoes.php';</script>";
            } else {
                echo "<script>alert('Erro3')</script>";
            }
        }
        if($aa!=0){
            $a = "INSERT INTO avancado(saldo,estatuto,username,equipa) values ('$saldo','$aestatuto','$nome','$nome_equipa')";
            if ($conn->query($a)) {
                //echo "<script type='text/javascript'>alert('Posição registada com sucesso');window.location='../4quatroButoes/quatroButoes.php';</script>";
            } else {
                echo "<script>alert('Erro4')</script>";
            }
        }

    } else {
        echo "<script>alert('Não foi selecionada nenhuma posição'); window.location='posicoesJogaCriar.php';</script>";
    }
}


