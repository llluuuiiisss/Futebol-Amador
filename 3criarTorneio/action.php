<?php
session_start();
$name = filter_input(INPUT_POST,'nome');
$nMaxTeams = filter_input(INPUT_POST,'nMaxEquipas');
$start = filter_input(INPUT_POST,'inicio');
$end = filter_input(INPUT_POST,'fim');
$field = filter_input(INPUT_POST,'campo');
$preco = filter_input(INPUT_POST,'preco');

if(!empty($name)){
    if(!empty($nMaxTeams)){
        if(!empty($start)){
            if(!empty($end)){
                if(!empty($field)){
                    if(!empty($preco)){
                        $host = "localhost";
                        $dbusername = "root";
                        $dbpassword = "";
                        $dbname = "futebolamador";
                        $conn = new mysqli($host,$dbusername,$dbpassword,$dbname);
                        if(mysqli_connect_error()){
                            die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
                        }else{
                            $criador = $_SESSION['login_user'];
                            $sql = "INSERT INTO torneios(nome,nMaxTeams,start,end,field,preco,criador) values ('$name','$nMaxTeams','$start','$end','$field','$preco','$criador')";
                            if($conn->query($sql)){
                                echo "<script type='text/javascript'>alert('Torneio Criado com sucesso!');window.location='../2adminInicio/adminInicio.php';</script>";
                            }else{
                                echo "Error:".$sql."<br>".$conn->error;
                            }
                            $conn->close();
                        }
                    }else{
                        echo "<script>alert('Dias do torneio não definido');window.location='criarTorneio.php';</script>" ;
                    }
                }else {
                    echo "<script>alert('Campo não definido');window.location='criarTorneio.php';</script>" ;
                }
            }else{
                echo "<script>alert('Fim não definido');window.location='criarTorneio.php';</script>" ;
            }
        }else{
            echo "<script>alert('Início não definido');window.location='criarTorneio.php';</script>" ;
        }
    }else{
        echo "<script>alert('Número máximo de Equipas não definido');window.location='criarTorneio.php';</script>" ;
    }
}else{
    echo "<script>alert('Nome do torneio não definido');window.location='criarTorneio.php';</script>" ;
}
