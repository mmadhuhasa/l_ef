// JavaScript Document
//jQuery(document).ready(function () {
//	jQuery('.mobile-nav nav').meanmenu();	     
//  });
//  
//      function setClock(){	
//              var currentTime = new Date(); 
//              var week = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
//              var month = ["JAN","FEB","MAR","ARP","MAY","JUN","JUL","AUG","SEP","OCT","NOV","DEC"];        
//              var timeString  = ("0"+ currentTime.getUTCHours()).slice(-2);        
//              timeString = timeString + ":";        
//              timeString = timeString + ("0"+ currentTime.getUTCMinutes()).slice(-2);        
//              timeString = timeString + ":";        
//              timeString = timeString + ("0"+ currentTime.getUTCSeconds()).slice(-2);        
//              timeString = timeString + " UTC ";  
//              timeString = timeString + "&nbsp;&nbsp;";              
//              timeString = timeString + week[currentTime.getUTCDay()];        
//              timeString = timeString + ", ";  var dd = currentTime.getUTCDate();        
//              if(dd < 10)        {            dd = '0'+dd;        }        
//              timeString = timeString + dd;        
//              timeString = timeString + " ";        
//              timeString = timeString + month[currentTime.getUTCMonth()];        
//              $("#timeTM").html(timeString);    }

//
//    $(document).ready(function () {
//	window.setInterval(setClock,1000);
//        
//    });  

function alpha(e) {
    var regex = new RegExp("^[a-zA-Z]+$");
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
        return true;
    }
    e.preventDefault();
    return false;
}
function number(e) {
    var regex = new RegExp("^[0-9]+$");
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
        return true;
    }
    e.preventDefault();
    return false;
}

function C_Char(e) {
    var regex = new RegExp("^[cC]+$");
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
        return true;
    }
    e.preventDefault();
    return false;
}