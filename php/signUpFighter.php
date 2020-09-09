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
}
?>