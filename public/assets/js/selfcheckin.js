$(document).ready(function(){
    
    var current_fs, next_fs, previous_fs; //fieldsets
    var opacity;
    var current = 1;
    var steps = $("fieldset").length;

    
    setProgressBar(current);
    
    $(".next").click(function(){
        
        current_fs = $(this).parent();
        next_fs = $(this).parent().next();
        
        //Add Class Active
        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
        
        //show the next fieldset
        next_fs.show(); 
        
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function(now) {
                // for making fielset appear animation
                opacity = 1 - now;
    
                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                next_fs.css({'opacity': opacity});
            }, 
            duration: 500
        });
        setProgressBar(++current);
    });
    
    $(".previous").click(function(){
        
        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();
        
        //Remove class active
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
        
        //show the previous fieldset
        previous_fs.show();
    
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function(now) {
                // for making fielset appear animation
                opacity = 1 - now;
    
                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                previous_fs.css({'opacity': opacity});
            }, 
            duration: 500
        });
        setProgressBar(--current);
    });
    
    function setProgressBar(curStep){
        var percent = parseFloat(100 / steps) * curStep;
        percent = percent.toFixed();
        $(".progress-bar")
          .css("width",percent+"%")   
    }
    
    $(".submit").click(function(){
        return false;
    })
        
    });
   
   var input = document.querySelector("#phoneno"),
   errorMsg = document.querySelector("#error-msg"),
   validMsg = document.querySelector("#valid-msg");

// The index maps to the error code returned from getValidationError 
var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];


// initialise plugin
var iti = window.intlTelInput(input, {
   separateDialCode: true,
   preferredCountries:["ke"],
hiddenInput: "full",
 utilsScript: "{{ asset('assets/plugins/intl-tel-input/js/utils.js') }}"
});


var reset = function() {
 input.classList.remove("error");
 errorMsg.innerHTML = "";
 errorMsg.classList.add("hide");
 validMsg.classList.add("hide");
};

// on blur: validate
input.addEventListener('blur', function() {
 reset();
 var phone_number = iti.getNumber();
 if (input.value.trim()) {
   if (iti.isValidNumber()) {
     validMsg.classList.remove("hide");
     document.getElementById('phoneno').value = phone_number;
     return true;

   } else {
     input.classList.add("error");
     var errorCode = iti.getValidationError();
     errorMsg.innerHTML = errorMap[errorCode];
     errorMsg.classList.remove("hide");
   }
 }
});

// on keyup / change flag: reset
input.addEventListener('change', reset);
input.addEventListener('keyup', reset);

$("form").submit(function() {
var number = $("#phoneno").intlTelInput("getNumber");
});

    
    