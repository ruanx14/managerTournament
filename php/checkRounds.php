<?php 
require 'conexao.php';
session_start();

$count = mysqli_query($conn,"select count(*) from Round where datee='".$_SESSION['dateHoje']."'");
$countBanco = mysqli_fetch_array($count);
$rounds = $countBanco['count(*)'];


$result = mysqli_query($conn,"select count(*) from Fight where alreadyFight='yes' and datee='".$_SESSION['dateHoje']."'");
$bd = mysqli_fetch_array($result);
$totalBattles = $bd['count(*)'];


for($i=1;$i<=$rounds;$i++){
?>
<h3>Round <?=$i?></h3>
<?php 
    $queryDetails = mysqli_query($conn,"select * from Fight where hasOponent='yes' and datee='".$_SESSION['dateHoje']."' and round=".$i);
    while($roundsDetails = mysqli_fetch_array($queryDetails)){
?>
    <div class="past-c">
        <?=$roundsDetails['namePlayerOne']?>
    </div>
    <div class="versus past-c">
        X
    </div>
    <div class="past-c">
        <?=$roundsDetails['namePlayerTwo']?>
    </div>
    <?php 
    if($roundsDetails['winner']=="waiting.."){ 
    ?>
        <div class="waiting-past past-c">
            <?=$roundsDetails['winner']?>
        </div>
    <?php  
    }else{
    ?>
        <div class="winner-past past-c">
            <?=$roundsDetails['winner']?>
        </div>
    <?php } ?>
<?php 
    }
    $result = mysqli_query($conn,"select count(*) from Fight where alreadyFight='yes' and datee='".$_SESSION['dateHoje']."' and round=".$i);
    $bd = mysqli_fetch_array($result);
    $totalBattlesRound = $bd['count(*)'];
    ?>
    <h3>Total battles in this round: <?=$totalBattlesRound?></h3>
    <?php
} 
?>
    <h3>Total all battles: <?=$totalBattles?></h3>