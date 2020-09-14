botoesUp = document.querySelectorAll(".inicio");
telaCadastrar = document.querySelectorAll(".event-click");
botoesDown = document.querySelectorAll(".final");
bdBotoes = document.querySelectorAll("button[type='submit']");
dataPlayer = document.querySelectorAll(".btnData");
botoesFighters = document.querySelectorAll(".btnFighter");
nextPlayer = document.querySelectorAll('.next-player');
boxWinner = document.querySelector('.box-winner');
nextRound = document.querySelectorAll('.bloco-signup')[2];
btnRound = document.querySelector(".btnRound");

if(botoesUp[0]!=undefined && botoesUp[1]!=undefined){
    botoesUp[0].onclick = function(){
        telaCadastrar[1].style.display = "flex";
    } 
    botoesUp[1].onclick = function(){
        telaCadastrar[0].style.display = "flex";
    }
}

btnRound.onclick = function(){
    telaCadastrar[2].style.display = "flex";
    xmr = new XMLHttpRequest();
    xmr.onreadystatechange = function(){
        if(xmr.readyState==1){
            nextRound.innerHTML = "preparing next round...";
        }
        if(xmr.readyState==2){
            nextRound.innerHTML = "almost there...";
        }
        if(xmr.readyState==3){
            nextRound.innerHTML = "more...";
        }
        if(xmr.readyState==4){
                nextRound.innerHTML = xmr.responseText;
                var cont = 5;
                var timer = setInterval(() => {
                    nextRound.childNodes[5].innerHTML = cont;
                    cont--;
                    if(cont==0){
                        clearInterval(timer);
                    }
                }, 1000); 
                if(nextRound.childNodes[1].innerHTML=="The all battles are not done."){
                    setTimeout(function(){
                        telaCadastrar[2].style.display = "none";
                        nextRound.childNodes[5].innerHTML = 5;
                    },6000);
                }else{
                    setTimeout(function(){
                        window.location.reload();
                    },6000);
                } 
            }
    }
    xmr.open('GET','php/nextRound.php');
    xmr.send();
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
    //add fight and add battle
    name = dataPlayer[2].value;
    if(name==""){
        //alert("Missing name player");
    }else{
    xmr = new XMLHttpRequest();
    xmr.open('GET','php/signUpFighter.php?namePlayer='+name);
    xmr.send();

    dataPlayer[2].value =  "";
    telaCadastrar[1].style.display = "none";
    ///check batte
    }
}
bdBotoes[0].onclick = function(){
     //add fight and add battle
    name1 = dataPlayer[0].value;
    name2 = dataPlayer[1].value;
    if(name1=="" || name2==""){
        //alert("Missing name player");
    }else{
    
    xmr = new XMLHttpRequest();
    xmr.open('GET','php/signUpFighter.php?playerName='+name1+'&playerName2='+name2);
    xmr.send();
    
    dataPlayer[0].value = "";
    dataPlayer[1].value = "";
    telaCadastrar[0].style.display = "none";
    window.location.reload();
    }   
}   


if(botoesFighters[0].id!='dead'){
    botoesFighters.forEach(function(elem, index, listObj){
        elem.onclick = function(){  
            xmr = new XMLHttpRequest();
            xmr.open('GET','php/nextBattle.php?namePlayer='+elem.innerHTML+'&idLuta='+botoesFighters[0].id);
            xmr.onreadystatechange = function(){
                xmr.onload = function(){
                    dados = JSON.parse(xmr.responseText);
                    var cont = 5;
                    var timer = setInterval(() => {
                        boxWinner.innerHTML = "<p>The winner of this battle is:</p><p>"+elem.innerHTML+"</p><p>preparing next battle...<br>"+cont+"<br>"+"<section class='loader'><main class='loader-corpo'><article class='pop-cicle'></article><div class='sorvete'></div></main></section></p>";
                        cont--;
                        if(cont==0){
                            clearInterval(timer);
                        }
                    }, 1000);
                    setTimeout(function(){
                        if(dados.length>0){
                            botoesFighters[0].innerHTML = dados[0]['namePlayerOne'];
                            botoesFighters[1].innerHTML = dados[0]['namePlayerTwo'];
                            botoesFighters[0].id = dados[0]['idFight'];
                        }else{
                            botoesFighters[0].innerHTML = "waiting player 1...";
                            botoesFighters[1].innerHTML = "waiting player 2...";
                            botoesFighters[0].id = "dead";
                        }

                        if(dados.length>1){
                            nextPlayer[0].innerHTML = dados[1]['namePlayerOne'];
                            nextPlayer[1].innerHTML = dados[1]['namePlayerTwo'];
                        }else{ 
                            nextPlayer[0].innerHTML = "waiting more players..";
                            nextPlayer[1].innerHTML = "waiting more players..";
                        }
                        boxWinner.innerHTML = "<div class='waiting-result'>Waiting battle result...</div>";
                    },6000);
                }
            }
            xmr.send();
        }
    });
}else{
    //alert("oi");
}


