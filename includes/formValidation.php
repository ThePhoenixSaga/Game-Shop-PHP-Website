<script type="text/javascript"> 
  
  var usernameCheck;
  var passwordCheck;
  var firstNamecheck;

  var submit = document.getElementById('submit');
  
    
  /*function isHover(e) 
  {
    return (e.parentElement.querySelector(':hover') === e);
  }*/
  
  function validateUsername(node)  
  {
    var RegExp = /\w{5,255}/; //must be between 5 and 255 characters
    var Str = node.value;
    if(RegExp.test(Str))
       {
          return true;
          submit.disabled = false;
       }
    /*else if (isHover(submit)) {
      submit.disabled = true;
      alert("Username is invalid, please enter a new different one.");
    } else {
       submit.disabled = true;
    }*/
    /*else
      {
        alert("Username is invalid, please enter a new different one.");
        return false;
      }*/
  }
  
  function validatePassword(node)  
  {
    var RegExp = /^(?=.*\d)(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/gm //
    var Str = node.value;
    if(RegExp.test(Str))
       {
          return true;
       }
    else
      {
        alert("Password is invalid, remember, must be at least 8 characters long with a number and a capital letter.");
        return false;
      }
  }
  
  function validateFirstName(node)  
  {
    var RegExp = /([A-Z|a-z])\w+/
    var Str = node.value;
    if(RegExp.test(Str))
       {
          return true;
       }
    else
      {
        alert("First name invalid, please avoid punctuations and numbers. Please refrain from entering single letters.");
        return false;
      }
  }
  
  function validateLastName(node)  
  {
    
  }
  
  function validateEmail(node)  
  {
    
  }
  
  function validateAddress(node) 
  {
    
  }

  
  /*function validateForm()
  {
      validateUsername(document.registration.elements[0]);
      validatePassword(document.registration.elements[1]);
      validateFirstName(document.registration.elements[2]);
      validateLastName(document.registration.elements[3]);
      validateEmail(document.registration.elements[4]);
      validateAddress(document.registration.elements[5]);

     if(validateUsername == true)
         {
          usernameCheck = true;
         }
      else
      {
        usernameCheck= false;
      }

      if(validatePassword == true)
         {
          passwordCheck = true;
         }
      else
      {
        passwordCheck= false;
      }

          if(validateFirstName == true)
         {
          firstNamecheck = true;
         }
      else
      {
        firstNamecheck= false;
      }

      if(usernameCheck == true && passwordCheck == true && validateFirstName == true)
      {
        return validateUsername();
        return validatePassword();
        return validateFirstName();
        //return validateLastName();
        //return validateEmail();
        //return validateAddress();
        

      }
    else{
      return false;
        document.getElementById("submit").addEventListener("click", function(event){ event.preventDefault() });
      document.getElementById("submit").disabled;
      
    }
  }*/

</script>