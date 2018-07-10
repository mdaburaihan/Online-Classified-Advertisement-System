
/////restrciting input alphabets in phone number field///////
$(document).ready(function() {
    $("#phone").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
             (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
             (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
             return;
         }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
});
/////restrciting input alphabets in phone number field///////

/////restrciting input alphabets in pin field///////
$(document).ready(function() {
    $("#pin").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
             (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
             (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
             return;
         }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
});
/////restrciting input alphabets in pin field///////

function validateName()
{
	//var name=obj.value;
    var name=document.getElementById("name").value;
    var regex = /^[A-Za-z\s]+$/;

    if(name=="")
    {
        $('#name').css("border",'');
    }
    else if(!regex.test(name))
    {
     $('#name').css({"border":"1px solid red"});
         //confirm("Name should contain only alphabets.");
         document.getElementById("nameerrormsg").innerHTML="Name should contain only alphabets.";
         return false;

     }
     else
     {
        $('#name').css("border",'');
        document.getElementById("nameerrormsg").innerHTML="";
        return true;
    }
}

function validateEmail(){
 	//var email=obj.value;
    var email=document.getElementById("email").value;

    var positionOfAtTheRate=email.indexOf("@");
    var positionOfDot=email.lastIndexOf(".");
    if(email=="")
    {
       $('#email').css("border",'');
       document.getElementById("emailerrormsg").innerHTML="";
       return true;
   }
   if(positionOfAtTheRate<2 || positionOfAtTheRate+2>email.length || positionOfDot+2>email.length || positionOfAtTheRate<0 || positionOfDot<1||positionOfDot<positionOfAtTheRate)
   {
     $('#email').css({"border":"1px solid red"});
         //confirm("Name should contain only alphabets.");
         document.getElementById("emailerrormsg").innerHTML="Invalid email.";
         return false;
     }
     // if(email!="")
     // {
     //     $.ajax({
     //       url:"check_email_available.php",
     //       method:"POST",
     //       data:{email:email},
     //         //datatype:"text",
     //         success:function(data){
     //            var responsedata = $.trim(data);
     //            $('#emailerrormsg').text(responsedata);


     //        if(responsedata=="Email is not available.")
     //        {
     //         return false;
     //        }
     //       else
     //       {
     //         return true;
     //       } 
     //    }

     // });

     // }
   else
   {
       $('#email').css("border",'');
       document.getElementById("emailerrormsg").innerHTML="";
       return true;
   }
}

function validatePhone(){

    //var phone=obj.value;
    var phone=document.getElementById("phone").value;
    
    if(phone==""){
        $('#email').css("border",'');
        document.getElementById("phoneerrormsg").innerHTML="";
        return true;
    }
    else if(phone.length === 10){
        $('#phone').css("border",'');
        document.getElementById("phoneerrormsg").innerHTML="";
        return true;
    }
    else{
      $('#phone').css({"border":"1px solid red"});
      document.getElementById("phoneerrormsg").innerHTML="Please enter 10 digit phone number.";
      return false;
  }
}

function validatePin(){

    //var pin=obj.value;
    var pin=document.getElementById("pin").value;
    
    if(pin==""){
     $('#pin').css("border",'');
     document.getElementById("pinerrormsg").innerHTML="";
     return true;
 }
 else if(pin.length === 6){
    $('#pin').css("border",'');
    document.getElementById("pinerrormsg").innerHTML="";
    return true;
}
else{
  $('#pin').css({"border":"1px solid red"});
  document.getElementById("pinerrormsg").innerHTML="Please enter 6 digit pin code.";
  return false;
}
}


/////Checking all the input fields on submit in register page////
function validateInputs(){
    return validateName() && validateEmail() && validatePhone() && validatePin();
}
/////Checking all the input fields on submit in register page////

/////Checking name input fields on submit button click in edit profile page////
// function validateInputs(){
//     return validateName();
// }
/////Checking name input fields on submit button click in edit profile page////
