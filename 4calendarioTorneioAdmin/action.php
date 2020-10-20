<?php
session_start();
$_SESSION['equipa1'] = $_POST['equipa1'];
$_SESSION['equipa2'] = $_POST['equipa2'];
echo "<script>window.location='../atribuirResultadosAdmin/atribuirResultados.php';</script>";