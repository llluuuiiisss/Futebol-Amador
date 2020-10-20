<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="todosTorneiosOffline.css">
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
    <div class="title"><p>Torneios Planeados e a Decorrer</p></div>
    <div class="bodyContainer">
        <form id="myform" action="action.php" method="post" class="form">
            <table id="tournments" class="tournments">
                <?php
                $conn = mysqli_connect('localhost','root','','futebolamador');
                if($conn->connect_error){
                    die("Connection failed".$conn->connect_error);
                }
                $sql = "SELECT nome,start,end,estado FROM torneios";
                $result = $conn->query($sql);
                if($result->num_rows >0){
                    while($row = $result->fetch_assoc()){
                        echo "<tr><td>{$row['nome']}</td><td> Início :</td><td>{$row['start']}</td><td>Fim: </td><td>{$row['end']}</td></tr>";
                    }
                }
                $conn->close();
                ?>
            </table>
            <br>
            Torneio Selecionado: <input type="text" name="torneio" id="torneio">
            <script>
                var table = document.getElementById("tournments");
                for(var i=0;i<table.rows.length; i++){
                    table.rows[i].onclick = function(){
                        document.getElementById("torneio").value = this.cells[0].innerHTML;
                    }
                }
            </script>
            <input class="backButton" type="submit" Value="Selecionar Torneio">
        </form>
        <a class="backButton" href="javascript:history.back()"  >Voltar</a>

    </div>


</div>
</body>
</html>