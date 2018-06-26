jQuery(function()
{
   // Set the date we're counting down to
var countDownDate = new Date();
countDownDate.setMinutes(countDownDate.getMinutes() + 5);
 var t = new Date("Sep 5, 2018 15:00:00").getTime();

// Update the count down every 1 second

 setInterval(function(){  }, 3000);

var x = setInterval(function() {   
    
    var t = new Date();
	
    
    // Find the distance between now an the count down date
    var distance = countDownDate - t;
    
    // Time calculations for days, hours, minutes and seconds
  
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    // Output the result in an element with id="demo"
    document.getElementById("demo").innerHTML = minutes + "m " + seconds + "s ";
    
    // If the count down is over, write some text 
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("demo").innerHTML = "EXPIRED";
    }
}, 1000);

});









