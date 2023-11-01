/*
setTimeout(techanime,1100);
techstr="Tech  World";
nextlet=0;
function techanime(){
	if(nextlet<techstr.length){
		document.getElementById("container").lastElementChild.innerHTML+=techstr[nextlet];
		nextlet++;
		setTimeout(techanime,7);
	}
	else{
		setTimeout(close_entry,1700);
	}
}

function close_entry(){
	document.getElementById("entry").style.display="none";
}
*/

function pass_valid(pass1,pass2){
	let a=pass1,b=pass2;
	if(a!=b){
		return "Password didn't match";
	}
	else{
		if(a.length<8){
			return "password length must be atleast 8";
		}
		else {

			let upper,lower,digit,special;

			if(/[A-Z]/.test(a)){
				upper=a.match(/[A-Z]/g).length;
			}
			else{return "password should contain uppercase letters"}
			if(/[a-z]/.test(a)){
				lower=a.match(/[a-z]/g).length;
			}
			else{return "password should contain lowercase letters"}
			if(/[0-9]/.test(a)){
				digit=a.match(/[0-9]/g).length;
			}
			else{return "password should contain uppercase letters"}
			if(a.length==upper+lower+digit){
				return "password should contain special characters";
			}

		}
	}
	return true;
}

function validate_signup(){
	//password validation
	let pass1=document.getElementById("password1").value;
	let pass2=document.getElementById("rpassword").value;
	let pvalid=pass_valid(pass1,pass2);
	if(pvalid!=true){
		alert(pvalid);
		return false;
	}

	return true;
}

a=0
function accountopen(){
if ((a/2)==0){
document.getElementById("account").style.height="66px";
a=a+1;
	}
else{
document.getElementById("account").style.height="0px";
a=a-1;
	}
}


function close_sidenav(n){
if (n==0){
document.getElementById("sidenav").style.width="0px"
document.getElementById("sidenav").style.border="none"
//document.getElementById("bottom_nav1").style.zIndex="1"
}
else{
document.getElementById("sidenav").style.width="240px"
document.getElementById("sidenav").style.border="1px solid black"
//document.getElementById("bottom_nav1").style.zIndex="0"
	}
}

function openwehave(){
document.getElementById("wehave").style.height="230px"
}


backg="p1"
//bookmark="pl1"
function color_change(k,m,n){
tops=document.getElementById(n).offsetTop;
window.scrollTo(0,tops);
/*
document.getElementById(bookmark).style.backgroundColor="white";
document.getElementById(bookmark).style.transform="scale(1,1)"
bookmark=k;
document.getElementById(k).style.backgroundColor=m;
document.getElementById(k).style.transform="scale(1.2,1.2)";*/
document.getElementById("sidenav").style.backgroundColor=m;
//document.getElementById("account").style.backgroundColor=m;
//document.getElementById(n).style.backgroundAttachment="scroll";
//document.getElementById(backg).style.backgroundAttachment="fixed";
//backg=n;
document.getElementById("sidenav").style.width="0px";
document.getElementById("sidenav").style.border="none"
//document.getElementById("bottom_nav1").style.zIndex="1";
//document.getElementById("login").style.backgroundColor=m;
//document.getElementById("create_account").style.backgroundColor=m;

if (n=="p2"){
s=document.getElementsByClassName("aboutus3");
for (let an=0;an<6;an++){
s[an].style.animation="height 0.7s linear 0s 1 normal";
		}
	}
/*
if (n=="p1" || n=="p3"){
m=m+"00";
}*/
//document.getElementById("header").style.backgroundColor=m;
}
/*
career=0
function open_career(cdiv){
if (career==0){
document.getElementById(cdiv).style.height="510px"
career=cdiv
	}
else if (career==cdiv){
document.getElementById(cdiv).style.height="0px";
career=0
	}
else{
document.getElementById(career).style.height="0px";
document.getElementById(cdiv).style.height="510px";
career=cdiv
	}
}*/

popup=0
function open_popup(pop,flag){
if (flag==1){
document.getElementById("account_popup").style.display="flex";
document.getElementById(pop).style.display="block";
document.getElementById(pop).style.animation="scale 0.35s linear 0s 1 normal"
document.getElementById("account").style.height="0px";
a=a-1
	}

else{
document.getElementById("account_popup").style.display="none";
document.getElementById(pop).style.display="none";
document.getElementById(pop).style.animation="";
	}

}

d=0
service=0
m=0
function open_service(k,l){
document.getElementById("service2").style.width="310px";
document.getElementById("service2").style.display="block";
document.getElementById("service3").style.flexDirection="column";
document.getElementById("service4").style.flexDirection="column";
document.getElementById("service3").style.height="260px";
document.getElementById("service4").style.height="160px";
document.getElementById("service4").style.width="100%";
document.getElementById("service5").style.display="block";
document.getElementById("service5").style.width="60%";
x=document.getElementsByClassName("img");
y=document.getElementsByClassName("service_div");

for (let i=0;i<5;i++){
x[i].style.display="none";
y[i].style.height="50px"

}


if (d==0){
document.getElementById(k).style.display="block";
y[l].style.animation="jump 0.2s linear 0s infinite alternate";
document.getElementById(k).style.animation="opac 0.7s linear 0s 1 normal";
m=l;
service=k;
d=d+1
	}

else if (k==service){
document.getElementById("service2").style.width="90%";
document.getElementById("service2").style.display="flex";
document.getElementById("service3").style.flexDirection="row";
document.getElementById("service4").style.flexDirection="row";
document.getElementById("service3").style.height="auto";
document.getElementById("service4").style.height="auto";
document.getElementById("service4").style.width="80%";
document.getElementById("service5").style.display="none";
document.getElementById("service5").style.width="0px";
x=document.getElementsByClassName("img");
y=document.getElementsByClassName("service_div");

for (let j=0;j<5;j++){
x[j].style.display="block";
y[j].style.height="150px";
}

y[l].style.animation="";
m=0;
document.getElementById(k).style.display="none";
document.getElementById(k).style.animation="";
d=0;

	}

else{
document.getElementById(k).style.display="block";
document.getElementById(service).style.display="none";
y[l].style.animation="jump 0.2s linear 0s infinite alternate";
y[m].style.animation="";
document.getElementById(k).style.animation="opac 0.5s linear 0s 1 normal";
document.getElementById(service).style.animation="";
m=l
service=k;
	}

}

function stoppro(event){
	event.stopPropagation();
}

function cancelpop(event){
	eve=event.target;
	eve.children[0].firstElementChild.click();
	eve.children[1].firstElementChild.click();
}


var scrol={1:"#3a0473",2:"#06558a",3:"#2f0680",4:"#2999bf"};
function scrolling(){
	heit=window.scrollY;
	let num;
	if(heit>0 && heit<=610){num=1}
	else if(heit>610 && heit<=1230){num=2}
	else if(heit>1230 && heit<=1880){num=3}
	else if(heit>1880){num=4}
	let m=scrol[num]
	document.getElementById("header").style.backgroundColor=m;
	document.getElementById("sidenav").style.backgroundColor=m;
	document.getElementById("account").style.backgroundColor=m;
	//document.getElementById("login").style.backgroundColor=m;
	//document.getElementById("create_account").style.backgroundColor=m;

}

function close_alert(){
		document.getElementById("alerting").style.animation="alert_anim1 0.2s ease-in-out 0s 1 reverse";
		document.getElementById("alerting").style.top="-100px";
}

/*
window.onload=alert_fun;
function alert_fun(){
	let a=document.getElementById("alerting");
	if(a.children[0].innerHTML==""){
		a.style.display="none";
	}
}
*/
function closemenu(){
	if(a!=0){
		accountopen();
	}
}


function close_opens(){
	/*alert("hi");
	if(event.target.id!="account"){
		closemenu();
	}*/
	closemenu();
}

function remove_closeopens(){
	document.documentElement.removeEventListener("click",close_opens);
}
function add_closeopens(){
	alert("hi");
	document.documentElement.addEventListener("click",close_opens);
}

function logout(){
	accountopen();
	document.getElementById("logout_form").click();
	document.getElementById("logout_form").click();
}
