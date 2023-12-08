// Default tab
function validateEmail(email){
  var re = /\S+@\S+\.\S+/;
  return re.test(email);
}

function validateArabicOnly(text){
  document.querySelectorAll('input[type="text"]:not(.text-ignore-validation):not(.cardid)').forEach(function(input){
    input.addEventListener('input', function(){
      this.value = this.value.replace(/[^\u0600-\u06FF\s]+/g,'');
    });
  });
  return text.match(/^[\u0600-\u06FF\s]+/g);
}

function validateNumberPhon(input){
  document.querySelectorAll('input[type="tel"]').forEach(function(input){
    input.addEventListener('input', function(){
      this.value = this.value.replace(/[^\d\+]/g, '');
    });
  });
  return input.match(/^((\+|00)\d{1,3})?\s?[67]\d{8}$/g);
}

function cardid(input){
  document.querySelectorAll('.cardid').forEach(function(input){
    input.addEventListener('input', function(){
      return this.value = this.value.replace(/\D/g,'');
    });
  });
  return input.match(/^\d{11}$/);
}

$(document).ready(function() {
  validateArabicOnly();
});

$(document).ready(function() {
  cardid();
});


$(document).ready(function() {
  validateNumberPhon();
});


$(".tab").css("display", "none");
$("#tab-0").css("display", "block");

function run(hideTab, showTab){
  if(hideTab < showTab){ 
    var currentTab = 0;
    x = $('#tab-'+hideTab);
    y = $(x).find("input , select");
    for (i = 0; i < y.length; i++){
      if ((y[i].type == 'email' && !validateEmail(y[i].value))
          || ($(y[i]).hasClass('cardid') && !cardid(y[i].value))
          || ($(y[i]).hasClass('text-ignore-validation') && y[i].value == '')
          || (y[i].type == 'text' && !$(y[i]).hasClass('text-ignore-validation') && !$(y[i]).hasClass('cardid') && !validateArabicOnly(y[i].value))
          || (y[i].tagName == 'SELECT' && y[i].value == '')
          || (y[i].type == 'date' && y[i].value === '')
          || (y[i].type == 'password' && y[i].value.length < 8) 
          || (y[i].type == 'password' && y[i].id == "password-confirm" && y[i].value != $("#password").val()) 
          || (y[i].type == 'tel' && !validateNumberPhon(y[i].value))
      ){
        $(y[i]).css("border-color", "red");
        $(y[i]).focus();
        return false;
      } else {
        $(y[i]).css("border-color", "rgb(0, 179, 255)");
        // return true;
      }
    }
  }

  // Progress bar
  for (i = 0; i < showTab; i++){
    $("#step-"+i).css("opacity", "1");
  }

  // Switch tab
  $("#tab-"+hideTab).css("display", "none");
  $("#tab-"+showTab).css("display", "block");
  $("input").css("border-color", "");
}