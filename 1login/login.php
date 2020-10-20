<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="login.css">
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
    <div class="title"><p>Login</p></div>
    <form method="post" action="action.php" class="form">
        Nome de Utilizador:<br> <input type="text" name="username" placeholder="Introduza o seu nome..."><br>
        Palavra-Passe:<br> <input type="password" name="password" placeholder="Introduza a sua password..."><br>
        <input type="submit" value="Login" class="buttonLogin">
    </form>
    <a href="javascript:history.back()" class="backButton">Voltar</a>
</div>
</body>
</html>