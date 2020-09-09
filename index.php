<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
    session_start();
    require 'php/conexao.php';

    $dateHoje =  date("Y-m-d");

    if(isset($_GET['logout'])){
        unset($_SESSION['admin']);
        unset($_SESSION['round']);
        unset($_SESSION['dia']);
        header('location: ./');
    }
    if(isset($_POST['user']) || isset($_POST['password'])){
        $user = $_POST['user'];
        $password = $_POST['password'];
        if($user!="gg" and $password!="123"){
            $_SESSION['msg'] = "<p class='error'>Wrong person!</p>";
        }else{
            $_SESSION['admin'] = "goldraven";
            $_SESSION['dateHoje'] = $dateHoje;
            $result = mysqli_query($conn,"select * from Round where datee='".$dateHoje."'");
            if(mysqli_num_rows($result)>0){
                $dadosBanco = mysqli_fetch_array($result);
                $_SESSION['round'] = $dadosBanco['round'];
            }else{
                $inserirRound = 'insert into Round(round, estado, datee) values(
                1,
                "Interminado",
                "'.$_SESSION['dateHoje'].'"
                )';
                mysqli_query($conn,$inserirRound);
                $_SESSION['round'] = 1;
            }
        }
    }
   
    //dia que eu to
    //round que eu to

    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css"> 
    <title>Tournament AQ3D</title>
</head>
<body>
    <?php 
    if(!isset($_SESSION['admin'])){
    ?>
    <container class="container">
        <div class="firezard">
            <form method="post">
                 <?php 
                    if(isset($_SESSION['msg'])){
                        echo $_SESSION['msg'];
                        unset($_SESSION['msg']);
                    } 
                ?> 
                <article class="gold">Gold Raven</article>
                <input type="text" name="user" placeholder="User">
                <input type="password" name="password" placeholder="Password">
                <input type="submit" name="btnCadastro" value="Admin!">
            </form>
        </div>
    </container> 
    <?php 
    }else{
    ?>
    <main class="main">
        <div class="botoes">
            <?php 
            if($_SESSION['round']==1){
            ?>
                <div class="botao inicio">New Player</div>
                <div class="botao inicio">New Battle</div>
                <div class="botao inicio">Next Round</div>
            <?php 
            }else{
            ?>
                <div class="botao disabled">New Player</div>
                <div class="botao disabled">New Battle</div>
                <div class="botao inicio">Next Round</div>
            <?php } ?>
        </div>
        <h2>Current Fight</h2>
        <div class="gaming">
            <div class="left-side">
                <div class="side-up">
                   <p>Player I</p>
                </div>
                <div class="side-down">
                   <p>Player II</p>
                </div>
            </div>
            <div class="right-side">
                <div class="box-winner">
                    Winner: <br>
                    Player X
                </div>
            </div>
        </div>
        <?php 
        $rest = false;
        if($rest){
        ?>
        <h2>Next Fight</h2>
        <section class="gaming-next">
            <div class="next-player">
                NextPlayer
            </div>
            <div class="versus">
                X
            </div>
            <div class="next-player">
                NextPlayer
            </div>
        </section>
        <?php 
        }
        ?>
        <h2>Information</h2>
        <div class="check-database">
            
        </div>
        <div class="botoes">
            <div class="botao final">Check all Rounds</div>
            <div class="botao final">Check all Players</div>
            <div class="botao final">Logout</div>
        </div>
        <section class="event-click">
            <div class="bloco-signup">
                <input type="text" class="btnData" name="playerOne" placeholder="Player Name">
                <input type="text" class="btnData" name="playerTwo" placeholder="Player Name">
                <button type="submit">Done</button>
            </div>
        </section>
        <section class="event-click">
            <div class="bloco-signup">
                <input type="text" class="btnData" name="onePlayer" placeholder="Player Name">
                <button type="submit">Done</button>
            </div>
        </section>
        
        <script src="js/index.js"></script>
    </main>
    <?php 
    }
    ?>
</body>
</html>