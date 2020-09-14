<?php 
    require 'conexao.php';
    session_start();

    $result = mysqli_query($conn,"select * from Fight where datee='".$_SESSION['dateHoje']."' and round='".$_SESSION['round']."' and alreadyFight='not'");
    if(mysqli_num_rows($result)>0){
    ?>
        <li class="msg-box">The all battles are not done.</li>
        <li class="msg-box">The next round is not ready!</li>
        <li class="msg-box">5</li>
        <section class="loader">
            <main class="loader-corpo">
                <article class="pop-cicle">
                    
                </article>
                <div class="sorvete">

                </div>
            </main>
        </section>
    <?php
    }else{
        $nextRound = $_SESSION['round']+1;
        $inserirRound = 'insert into Round(round, estado, datee) values(
        '.$nextRound.',
        "Interminado",
        "'.$_SESSION['dateHoje'].'"
        )';
        mysqli_query($conn,$inserirRound); 

        $players = [];
        $sortudo = "";
        $resultFighters = mysqli_query($conn,"select * from Fight where datee='".$_SESSION['dateHoje']."' and round='".$_SESSION['round']."' and alreadyFight='yes'");
        while($datesBd = mysqli_fetch_array($resultFighters)){
            array_push($players,$datesBd);
        }
        if(count($players) % 2 != 0){
            $sortudo = array_pop($players);
        }
        $metade = count($players)/2;
        $total = count($players);
        $array1 = array_slice($players,0,$metade);
        $array2 = array_slice($players,$metade,$total);
        shuffle($array2);
    
        for($i=0;$i<$metade;$i++){
             $sqlBattle = 'insert into Fight(round, namePlayerOne, hasOponent, namePlayerTwo, winner, datee, alreadyFight) values(
                "'.$nextRound.'",
                "'.$array1[$i]['winner'].'",
                "yes",
                "'.$array2[$i]['winner'].'",
                "waiting..",
                "'.$_SESSION['dateHoje'].'",
                "not"
                )';
            mysqli_query($conn,$sqlBattle);  
        }
        $showTortudo = false;
        if($sortudo!=""){
            $nextRoundLucky = $nextRound + 1;
            $result = mysqli_query($conn,"select * from Fight where datee='".$_SESSION['dateHoje']."' and round='".$_SESSION['round']."' and namePlayerTwo='waiting..'");
            if(mysqli_num_rows($result)>0){
                $showSortudo = true;
                $dados = mysqli_fetch_array($result);
                /* $sqlUpdate = "update Fight set round=".$nextRound.", hasOponent='yes',namePlayerTwo='".$dados['winner']."', alreadyFight='yes'  where idFight=".$dados['idFight']; 
                mysqli_query($conn,$sqlUpdate); */

                $sqlSortudo = 'insert into Fight(round, namePlayerOne, hasOponent, namePlayerTwo, winner, datee, alreadyFight) values(
                    "'.$nextRound.'",
                    "'.$dados['winner'].'",
                    "yes",
                    "'.$sortudo['winner'].'",
                    "waiting..",
                    "'.$_SESSION['dateHoje'].'",
                    "not"
                    )';
                mysqli_query($conn,$sqlSortudo);
            }else{
                $showSortudo = false;
                $sqlSortudo = 'insert into Fight(round, namePlayerOne, hasOponent, namePlayerTwo, winner, datee, alreadyFight) values(
                    "'.$nextRound.'",
                    "'.$sortudo['winner'].'",
                    "yes",
                    "waiting..",
                    "'.$sortudo['winner'].'",
                    "'.$_SESSION['dateHoje'].'",
                    "yes"
                    )';
                mysqli_query($conn,$sqlSortudo);
            }
        }  
        $_SESSION['round'] = $nextRound;

      ?>
        <li class="msg-box">The battles are done.</li>
        <li class="msg-box">preparing next round...</li>
        <li class="msg-box">5</li>
        <?php 
        if($showSortudo==true){
        ?>
        <li class="msg-box">There's no lucky this round.</li>
        <?php }else{ ?>
        <li class="msg-box">A lucky player with name:<?=$sortudo['winner']?> passed to the next round.</li>
        <?php } ?>
        <section class="loader">
            <main class="loader-corpo">
                <article class="pop-cicle">
                    
                </article>
                <div class="sorvete">

                </div>
            </main>
        </section> 
      <?php
    }
?>
