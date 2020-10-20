<?php
session_start();

$equipa = filter_input(INPUT_POST,'torneio');


if(!empty($equipa)){
    $_SESSION['equipa_escolhida']=$equipa;
    header("location:../4quatroButoes/quatroButoes.php");

}else{
    echo "<script>alert('Equipa Nao Selecionada');window.location='minhasEquipas.php';</script>;";
}

