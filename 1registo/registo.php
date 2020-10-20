<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="registo.css">
    <title>Futebol Amador</title>
</head>
<body>
<div class="header">
    <div class="headerText">
        <p>Futebol Amador</p>
    </div>
    <div class="middleRect">
        <span class="middleCircle"></span>
    </div>
    <div class="title"><p>Registo</p></div>
    <form method="post" action="action.php" class="form">
        <label>Nome de Utilizador:</label> <input type="text" name="username" placeholder="Introduza o seu nome...">
        <label class ="contact">Contacto:</label> <input type="text" name="contact" placeholder="Introduza o seu contacto..."><br>
        <label>Número do CC:</label> <input type="text" name="ccnumber" placeholder="Introduza o número do Cartão de Cidadão...">
        <label class="mail">E-mail:</label> <input type="text" name="email" placeholder="Introduza o seu e-mail..."><br>
        <label>Primeiro Nome:</label> <input type="text" name="firstname" placeholder="Introduza o seu primeiro nome...">
        <label class="pass">Password:</label> <input type="password" name="pass1" placeholder="Introduza a sua password..."><br>
        <label>Último Nome:</label> <input type="text" name="lastname" placeholder="Introduza o seu último nome...">
        <label class="pass2">Confirmar Password:</label> <input type="password" name="pass2" placeholder="Introduza novamente a sua password..."><br>
        <input type="submit" name="submit" value="Registar" class="buttonRegister">
    </form>
    <a class="backButton" href="javascript:history.back()"  >Voltar</a>
</div>
</body>
</html>