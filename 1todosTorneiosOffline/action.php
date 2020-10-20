<?php
session_start();
$torneio = filter_input(INPUT_POST,'torneio');
$_SESSION['torneio_ofline']=$torneio;
echo "<script type='text/javascript'>window.location='../torneioOpcoesOfline/torneioOpcoes.php';</script>";
