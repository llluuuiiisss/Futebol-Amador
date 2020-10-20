<?php
session_start();
$nome_equipa = filter_input(INPUT_POST,'nome');
$n_jogadores=1;
if(!empty($nome_equipa)){
        $host = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "futebolamador";

        $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

        if (mysqli_connect_error()) {
            die('Connect Error(' . mysqli_connect_errno() . ')' . mysqli_connect_error());
        } else {
            $query = "SELECT username FROM utilizadores";
            $result = mysqli_query($conn,$query);

            while($row = mysqli_fetch_assoc($result)){
                if($row['username'] == $_SESSION['login_user']){
                    $capitao = $row['username'];
                    $query20="SELECT teams,saldo FROM utilizadores WHERE username='$capitao'";
                    $result20=mysqli_query($conn,$query20);
                    $row20=mysqli_fetch_assoc($result20);
                    if(!empty($row20['teams'])){
                        $array2 = json_decode($row20['teams'],true);
                        array_push($array2,$nome_equipa);
                    }else{
                        $array2 = array($nome_equipa);
                    }
                }
            }
            $check = mysqli_query($conn,"SELECT nome FROM equipa");
            while($row2 = mysqli_fetch_assoc($check)) {
                if ($row2['nome'] == $nome_equipa) {
                    echo "<script>alert('Nome de equipa já existe');window.location='criarEquipa.php';</script>";
                    exit();
                }
            }
            $torneio = $_SESSION['torneio_escolhido'];
            $sql = "INSERT INTO equipa(nome,n_jogadores,capitao) values ('$nome_equipa','$n_jogadores','$capitao')";
            $sql2 ="SELECT nMaxTeams,teams,preco FROM torneios where nome='$torneio'";
            $result2 = mysqli_query($conn,$sql2);
            $row3 = mysqli_fetch_assoc($result2);
            if(!empty($row3['teams'])){
                $array = json_decode($row3['teams'],true);
                if(count($array) < $row3['nMaxTeams']){
                    array_push($array,$nome_equipa);
            }else{
                    echo "<script>alert('Torneio Sem Vagas');window.location='../4torneiosCriarEquipa/torneiosCriarEquipa.php';</script>";
                    exit();
                }
            }else{
                $array = array($nome_equipa);
            }
            $array = json_encode($array);
            $array2 = json_encode($array2);

            $saldoactual = $row20['saldo'];
            $preco = $row3['preco'];
            $saldoatualizado = $saldoactual-$preco;


            $sql4 = "UPDATE utilizadores SET teams='$array2',saldo='$saldoatualizado' where username ='$capitao'";
            $sql3 = "UPDATE torneios SET teams='$array' where nome ='$torneio'";

            if ($conn->query($sql) and $conn->query($sql2) and $conn->query($sql3) and $conn->query($sql4)) {
                unset($_SESSION['torneio_escolhido']);
                $_SESSION['equipa_escolhida'] = $nome_equipa;
                echo "<script type='text/javascript'>alert('Equipa criada e inscrita com sucesso');window.location='../4posicoesJogaCriar/posicoesJogaCriar.php';</script>";
            } else {
                echo "Error:" . $sql . "<br>" . $conn->error;
            }
            $conn->close();
        }
}else{
    echo "<script>alert('Nome de equipa não atribuído');window.location='criarEquipa.php';</script>";
}
