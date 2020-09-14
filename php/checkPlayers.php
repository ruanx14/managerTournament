<?php 
require "conexao.php";
session_start();

$resultTotal = "select count(*) from Fighter where datee='".$_SESSION['dateHoje']."'";
$resultBanco = mysqli_query($conn,$resultTotal);
$db = mysqli_fetch_array($resultBanco);
$total = $db['count(*)'];
$sql = "select * from Fighter where datee='".$_SESSION['dateHoje']."'";
$resultado = mysqli_query($conn,$sql);
while($players = mysqli_fetch_array($resultado)){
?>
    <div class="past-c">
        <?=$players['name']?>
    </div>
<?php 
}
?>
<h3>Total players: <?=$total?></h3>
