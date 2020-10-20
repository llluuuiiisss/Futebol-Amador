<?php
if(isset($_POST['submit'])){
    $username = filter_input(INPUT_POST,'username');
    $password = filter_input(INPUT_POST, 'pass1');
    $cartaocidadao = filter_input(INPUT_POST,'ccnumber');
    $contact = filter_input(INPUT_POST,"contact");
    $mail = filter_input(INPUT_POST,"email");
    $firstname = filter_input(INPUT_POST,"firstname");
    $lastname =  filter_input(INPUT_POST,"lastname");
    $checkpass = filter_input(INPUT_POST, "pass2");
    if(!empty($username)){
        if(!empty($password)){
            if(!empty($cartaocidadao)){
                if(!empty($contact)){
                    if(!empty($mail)){
                        if(!empty($firstname)){
                            if(!empty($lastname)){
                                if($password == $checkpass){
                                    $host = "localhost";
                                    $dbusername = "root";
                                    $dbpassword = "";
                                    $dbname = "futebolamador";
                                    $conn = new mysqli($host,$dbusername,$dbpassword,$dbname);

                                    if(mysqli_connect_error()){
                                        die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
                                    }else{
                                        $check = mysqli_query($conn,"SELECT username FROM utilizadores WHERE username='$username'");
                                        $checkrows=mysqli_num_rows($check);
                                        if($checkrows>0){
                                            echo "<script>alert('Nome de Utilizador já existe');window.location='registo.php';</script>";
                                        }else{
                                            $sql = "INSERT INTO utilizadores(username,password,ccnumber,contact,mail,fname,lname) values ('$username','$password','$cartaocidadao','$contact','$mail','$firstname','$lastname')";
                                            if($conn->query($sql)){
                                                echo "<script type='text/javascript'>alert('Registado com sucesso');window.location='../0paginaInicial/paginaInicial.php';</script>";
                                            }else{
                                                echo "Error:".$sql."<br>".$conn->error;
                                            }
                                            $conn->close();
                                        }
                                    }
                                }else{
                                    echo "<script>alert('Passwords não coincidem');window.location='registo.php';</script>";
                                }
                            }else{
                                echo "<script>alert('Último nome não atribuído');window.location='registo.php';</script>";
                            }
                        }else{
                            echo"<script>alert('Primeiro nome não atribuído');window.location='registo.php';</script>";
                        }
                    }else{
                        echo "<script>alert('Email não atribuído');window.location='registo.php';</script>" ;
                    }
                }else{
                    echo "<script>alert('Contacto não atribuído');window.location='registo.php';</script>" ;
                }
            }else{
                echo "<script>alert('Número do cartão de cidadão não atribuído');window.location='registo.php';</script>" ;
            }
        }else{
            echo "<script>alert('A password não atribuída');window.location='registo.php';</script>" ;
        }
    }else{
        echo "<script>alert('O nome de utilizador não atribuído');window.location='registo.php';</script>" ;
    }
}else{
    echo "<script>alert('Post nao ta a dar');</script>" ;
}

?>