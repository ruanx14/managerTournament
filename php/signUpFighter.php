<?php
require 'conexao.php';
session_start();
if(isset($_GET['namePlayer'])){
    //header('location: casadocarai111.'.$_GET['namePlayer'].'php');
    $sql = 'insert into Fighter(name, round, datee) values(
        "'.$_GET['namePlayer'].'",
        "'.$_SESSION['round'].'",
        "'.$_SESSION['dateHoje'].'"
        )';
    mysqli_query($conn,$sql);


    //battle
    $hasOponent = mysqli_query($conn,"select * from Fight where hasOponent='not'");
    if(mysqli_num_rows($hasOponent)>0){
        $battle = mysqli_fetch_array($hasOponent);
        $sqlBattle = "update Fight set hasOponent='yes', namePlayerTwo='".$_GET['namePlayer']."' where idFight=".$battle['idFight'];
        mysqli_query($conn,$sqlBattle);  
    }else{
        $sqlBattle = 'insert into Fight(round, namePlayerOne, hasOponent, namePlayerTwo, winner, datee, alreadyFight) values(
            "'.$_SESSION['round'].'",
            "'.$_GET['namePlayer'].'",
            "not",
            "waiting..",
            "waiting..",
            "'.$_SESSION['dateHoje'].'",
            "not"
            )';
        mysqli_query($conn,$sqlBattle);  
    } 
}else{
    //header('location: casadocarai222.'.$_GET['playerName'].$_GET['playerName2'].'php');
    $sql = 'insert into Fighter(name, round, datee) values(
        "'.$_GET['playerName'].'",
        "'.$_SESSION['round'].'",
        "'.$_SESSION['dateHoje'].'"
        )';
    mysqli_query($conn,$sql);
    $sql = 'insert into Fighter(name, round, datee) values(
        "'.$_GET['playerName2'].'",
        "'.$_SESSION['round'].'",
        "'.$_SESSION['dateHoje'].'"
        )';
    mysqli_query($conn,$sql);

    //battle
    $sqlBattle = 'insert into Fight(round, namePlayerOne, hasOponent, namePlayerTwo, winner, datee, alreadyFight) values(
        "'.$_SESSION['round'].'",
        "'.$_GET['playerName'].'",
        "yes",
        "'.$_GET['playerName2'].'",
        "waiting..",
        "'.$_SESSION['dateHoje'].'",
        "not"
        )';
    mysqli_query($conn,$sqlBattle);  
}
?>