<?php 
require 'conexao.php';
session_start();

$count = mysqli_query($conn,"select round from Round where datee='".$_SESSION['dateHoje']."'");
$countBanco = mysqli_fetch_array($count);
$rounds = $countBanco['round'];

for($i=1;$i<=$rounds;$i++){
?>
<h3>Round <?=$i?></h3>
<?php 
    $queryDetails = mysqli_query($conn,"select * from Fight where hasOponent='yes' and round=".$i);
    while($roundsDetails = mysqli_fetch_array($queryDetails)){;
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
} 
?>