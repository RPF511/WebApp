
function hello(){
    alert("Hello, world!");
}

function biggertext() {
	document.getElementById("textbox").style.fontSize = "24pt";
}

function textplus(){
    var text = document.getElementById("textbox");
    if(isNaN(parseInt(text.style.fontSize,10))){
        text.style.fontSize = "14pt";
    }
    else{
        //console.log(Number(text.style.fontSize.split("pt")[0])+2);
        text.style.fontSize = String(Number(text.style.fontSize.split("pt")[0])+2)+"pt";
    }
}

var texttime = null;
function texttimer(){
    if(texttime != null) {
        clearInterval(texttime);
        texttime = null;
    }
    else{
        texttime = setInterval(textplus,500);
    }
}

function blingtext() {
    var check = document.getElementById("check").checked;
    //console.log(check);
    var text = document.getElementById("textbox");
    
	if (check){
        text.style.color = "green";
        text.style.fontWeight = "bold";
        text.style.textDecoration = "underline";
        document.body.style.backgroundImage = "url(https://selab.hanyang.ac.kr/courses/cse326/2019/labs/images/8/hundred.jpg)"
    }
    else {
        text.style.color = "black";
        text.style.fontWeight = "normal";
        text.style.textDecoration = "none";
        document.body.style.backgroundImage = "none"
    }	
    //alert("blingtext");
}

function snoopify(){
	var text = document.getElementById("textbox");
	text.value = text.value.toUpperCase();
	text.value = text.value.split(".").join("-izzle.");
}

function igpay(){
    var text = document.getElementById("textbox");
    var splittext = text.value.split(" ");
    var vowel_list = 'aeiouAEIOU';
    //console.log(splittext);
    for(var i=0;i<splittext.length;i++){
        //console.log(vowel_list.indexOf(splittext[i][0]));
        for(var j=0;j<splittext[0].length;j++){
            if(vowel_list.indexOf(splittext[i][0]) !== -1){
                splittext[i] = splittext[i] + "ay";
                break;
            }
            else{
                splittext[i] = splittext[i].slice(1,) + splittext[i][0];
            }
        }
    }
    text.value = splittext.join(" ");
}

function malk(){
    var text = document.getElementById("textbox");
    var splittext = text.value.split(" ");
    var vowel_list = 'aeiouAEIOU';
    //console.log(splittext);
    for(var i=0;i<splittext.length;i++){
        //console.log(vowel_list.indexOf(splittext[i][0]));
        if(splittext[i].length >= 5){
            splittext[i] = "Malkovich";
        }
        
    }
    text.value = splittext.join(" ");
}