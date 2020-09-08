botoesUp = document.querySelectorAll(".inicio");
telaCadastrar = document.querySelectorAll(".event-click");
botoesDown = document.querySelectorAll(".final");

botoesUp[0].onclick = function(){
    telaCadastrar[1].style.display = "flex";
} 
botoesUp[1].onclick = function(){
    telaCadastrar[0].style.display = "flex";
} 
telaCadastrar.forEach(function(tela, index, listObj){
    tela.onclick = function(e){
        if(e.target == tela){
            telaCadastrar[index].style.display = "none";
        }
    }
});
botoesDown[0].onclick = function(){
    xmr = new XMLHttpRequest();
    xmr.onreadystatechange = function(){
        xmr.onload = function(){
            document.querySelector('.check-database').innerHTML = xmr.responseText;
        }
    }
    xmr.open('GET','php/checkRounds.php');
    xmr.send();
 }
botoesDown[1].onclick = function(){
    xmr = new XMLHttpRequest();
    xmr.onreadystatechange = function(){
        xmr.onload = function(){
            document.querySelector('.check-database').innerHTML = xmr.responseText;
        }
    }
    xmr.open('GET','php/checkPlayers.php');
    xmr.send();
}
botoesDown[2].onclick = function(){
   window.location.href = "index.php?logout=sim";
}