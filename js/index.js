botoesUp = document.querySelectorAll(".inicio");
telaCadastrar = document.querySelectorAll(".event-click");
botoesDown = document.querySelectorAll(".final");
bdBotoes = document.querySelectorAll("button[type='submit']");
dataPlayer = document.querySelectorAll(".btnData");

if(botoesUp[0]!=undefined && botoesUp[1]!=undefined){
    botoesUp[0].onclick = function(){
        telaCadastrar[1].style.display = "flex";
    } 
    botoesUp[1].onclick = function(){
        telaCadastrar[0].style.display = "flex";
    } 
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

bdBotoes[1].onclick = function(){
    name = dataPlayer[2].value;

    xmr = new XMLHttpRequest();
    xmr.open('GET','php/signUpFighter.php?namePlayer='+name);
    xmr.send();

    dataPlayer[2].value =  "";
    telaCadastrar[1].style.display = "none";
}
bdBotoes[0].onclick = function(){
    name1 = dataPlayer[0].value;
    name2 = dataPlayer[1].value;

    xmr = new XMLHttpRequest();
    xmr.open('GET','php/signUpFighter.php?playerName='+name1+'&playerName2='+name2);
    xmr.send();
    
    dataPlayer[0].value = "";
    dataPlayer[1].value = "";
    telaCadastrar[0].style.display = "none";
}


