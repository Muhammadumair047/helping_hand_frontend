
//Form Validation
//Password Validation
function verifyPassword() {
  var pw1 = document.getElementById("pswd1").value;
  var pw2 = document.getElementById("pswd2").value; 
  //check empty password field
  if(pw1 == "") {
     document.getElementById("message").innerHTML = "**Fill the password please!";
     return false;
  }
 
 //minimum password length validation
  if(pw1.length < 8) {
     document.getElementById("message").innerHTML = "**Password length must be atleast 8 characters";
     return false;
  }
 //Password and Confirm Password Validation
  if(pw1 != pw2) {  
    document.getElementById("message2").innerHTML = "**Passwords are not same";  
    return false;  


  } else {
     alert("Registred Sucessfully");
  }
}

//Display JS
$(document).ready(function(){

   $('.readMoreBtn').click(function(){
       var targetId = $(this).data('target');
       var fullText = $(this).data('full-text');
       
       if ($('#'+targetId).text().length <= 100) {
           $('#'+targetId).text(fullText);
       } else {
           $('#'+targetId).text(fullText.substring(0, 100));
       }

       $(this).text(function(i, text){
           return text === "Read more" ? "Read less" : "Read more";
       });
   });
});


//Contact form validation
function validateForm() {
  var name = document.getElementById("name").value;
  var email = document.getElementById("email").value;
  var message = document.getElementById("message").value;

  // Basic form validation
  if (name.trim() === "" || email.trim() === "" || message.trim() === "") {
      alert("All fields must be filled out");
      return false;
  }

  
  return true;
}