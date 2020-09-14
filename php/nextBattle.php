<?php 
    require 'conexao.php';
    session_start();

    $updateFight = "update Fight set winner='".$_GET['namePlayer']."', alreadyFight='yes' where idFight=".$_GET['idLuta'];
    $result = mysqli_query($conn,$updateFight); 
    
    $arrayJson = [];
    $hasNext = mysqli_query($conn,"select * from Fight where alreadyFight='not' and round='".$_SESSION['round']."' and datee='".$_SESSION['dateHoje']."' limit 2");
    while($bdDates = mysqli_fetch_array($hasNext)){
        array_push($arrayJson,$bdDates);
    }
    echo json_encode($arrayJson);
?>