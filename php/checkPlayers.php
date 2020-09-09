<?php 
require "conexao.php";
session_start();
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
