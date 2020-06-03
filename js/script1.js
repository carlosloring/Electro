//var initTime = new Date();
var i = 0;

var dias=7;
var horas=0;
var minutos=0;
var segundos=0;
if(localStorage.getItem("dias")!=null){
    
    dias=localStorage.getItem("dias");
    horas=localStorage.getItem("horas");
    minutos=localStorage.getItem("minutos");
    segundos=localStorage.getItem("segundos");
}
function myTimer(){

  segundos=segundos-1;
  if (segundos<0){
      
      segundos = 59;
      minutos = minutos-1;
      if (minutos<0){
          minutos=59;
          horas = horas-1;
          if (horas<0){
              horas=23;
              dias = dias -1;
              if (dias<0){
                  dias=7;
                  horas=0;
                  minutos=0;
                  segundos=0;
              }
          }
      }
  }
    document.getElementById("dias").innerHTML=dias;
    document.getElementById("horas").innerHTML=horas;
    document.getElementById("minutos").innerHTML=minutos;
    document.getElementById("segundos").innerHTML=segundos;
    
    localStorage.setItem("dias", dias);
    localStorage.setItem("horas", horas);
    localStorage.setItem("minutos", minutos);
    localStorage.setItem("segundos", segundos);
}

var myVar = setInterval(myTimer, 1000);