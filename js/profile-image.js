$(document).ready(function(){
    $("#ppicsubmit").hide();  
    $("#pimage").on("change", function(){
        $("#ppicsubmit").show();
        $("#pimage").show(); 
    })
});
$(document).ready(function(){
    $("#cpicsubmit").hide();  
    $("#cimage").on("change", function(){
        $("#cpicsubmit").show();
        $("#cimage").show(); 
    })
});