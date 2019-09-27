<!--Check Login--> <!--Change to require if page requires user account-->
<?php include $_SERVER['DOCUMENT_ROOT'].'/assignment1_website/includes/checkLogin.php';?>
<?php
  if(empty($_POST)) //DIsplays form page while post is empty, after user submits the ELSE clause re-directs back to this page after user submits, but shows different view of page.
  {
?>
<!doctype html>
<!--[if lt IE 7]> <html class="ie6 oldie"> <![endif]-->
<!--[if IE 7]>    <html class="ie7 oldie"> <![endif]-->
<!--[if IE 8]>    <html class="ie8 oldie"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="">
<!--<![endif]-->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Registration</title>
<link href="/assignment1_website/styles/boilerplate.css" rel="stylesheet" type="text/css">
<link href="/assignment1_website/styles/MainStyle.css" rel="stylesheet" type="text/css">
<!-- 
To learn more about the conditional comments around the html tags at the top of the file:
paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/

Do the following if you're using your customized build of modernizr (http://www.modernizr.com/):
* insert the link to your js here
* remove the link below to the html5shiv
* add the "no-js" class to the html tags at the top
* you can also remove the link to respond.min.js if you included the MQ Polyfill in your modernizr build 
-->
<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script src="/assignment1_website/styles/respond.min.js"></script>
<?php include $_SERVER['DOCUMENT_ROOT'].'/assignment1_website/includes/scripts.php';?>
<?php //include '/home/cabox/workspace/assignment1_website/includes/formValidation.php';?>
  
<!--Ajax to check if username already is in use or not-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">

function checkUsername(username) {
if (username.length==0) {
document.getElementById("usernameResult").innerHTML=""; //Get user input from form input.
return;
}
if (window.XMLHttpRequest) {
// code for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp=new XMLHttpRequest();
} else { // code for IE6, IE5
xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange=function() {
if (this.readyState==4 && this.status==200)
{
document.getElementById("usernameResult").innerHTML=this.responseText; //Display returned results if username available or not.
}
}
xmlhttp.open("GET","../../includes/checkUsername.php?username_query="+username,true); //Gets results from checkUsername script.
xmlhttp.send();
}

</script>
  
</head>
<body>
<div class="gridContainer clearfix">
  <!--Logo-->
  <?php include $_SERVER['DOCUMENT_ROOT'].'/assignment1_website/includes/logo.php';?>

  <div id="header">
    <h1>
      Registration
    </h1>
  </div>
  
  <!--Nav-->
  <?php include $_SERVER['DOCUMENT_ROOT'].'/assignment1_website/includes/nav.php';?>
  
  <!--Body-->
  <div id="body">
    <p> Required: </p>
    <p> Username no smaller than 5 characters and no longer than 255 characters </p>
    <p> Password must be at least 8 characters long and contain 1 number and a capatial </p>  
    <p>  </p>  
  
    <h2>Registration</h2>
      <form name="registration" action="/assignment1_website/pages/registration/index.php" method="POST" > <!--javascript:alert('test OK')-->
        <label for= 'username'>Username: </label>
        <br/>
        <input type="text" name="username" pattern="\w{5,255}" title="Username is invalid, please enter a new different one." onBlur="checkUsername(this.value)" required/>
        <span id="usernameResult">
          <?php
             if(isset($_SESSION["availableResult"]))
             {
               echo($_SESSION["availableResult"]);
             }
          ?>
        </span>
        <br/>
        
        <label for= 'password'>Password: </label>
        <br/>
        <input type="password" name="password" pattern="^(?=.*\d)(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$" title="Password is invalid, remember, must be at least 8 characters long with a number and a capital letter." required/>
        <!--
          (?=.*\d) - not sure
          (?=.*[A-Z]) - must have one uppercase
          (?=.*[a-zA-Z]) - must have lower and uppercase letters
          .{8,}$ - 8 or more characters
        -->
        <br/>
        
        <label for= 'first_name'>First name: </label>
        <br/>
        <input type="text" name="first_name" pattern="([A-Z|a-z])\w+" title="First name invalid, please avoid punctuations and numbers. Please refrain from entering single letters." required/>
        <br/>
        
        <label for= 'last_name'>Last name: </label>
        <br/>
        <input type="text" name="last_name" pattern="([A-Z|a-z])\w+" title="Last name is invalid, please avoid punctuations and numbers. Please refrain from entering single letters." required/>
        <br/>
        
        <label for= 'email'>Email: </label>
        <br/>
        <input type="text" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,6}$" title="Email invalid." required/>
        <!--
          [a-z0-9._%+-]+ - Word, number or selected symbols.
          +@[a-z0-9.-] - plus @ followed by Word or number after dot.
          +\.[a-z]{2,6}$ - plus dot followed by word or number, but limited between 2 and 6.
        -->
        <br/>
        
        <label for= 'address'>Address: </label>
        <br/>
        <input type="text" name="address" title="Please enter an address" required/>
        <br/>
        
        <input id="submit" name="submit" type="submit" value="Register Account"></input>
       </form>
    
  </div>
  
  <!--Footer-->
  <?php include $_SERVER['DOCUMENT_ROOT'].'/assignment1_website/includes/footer.php';?>
</div>
</body>
</html>
<?php
  } else {
    try{
      include $_SERVER['DOCUMENT_ROOT'].'/assignment1_website/includes/dbLogin.php';

      //htmlentities is part of server side validation, coz it removes quotes which could have been used for injection attacks.
      
      $form = $_POST;
      $Username = htmlentities($form[ 'username' ],ENT_QUOTES,'UTF-8',TRUE);
      $Password  = htmlentities($form[ 'password' ],ENT_QUOTES,'UTF-8',TRUE);
      $FirstName = htmlentities($form[ 'first_name' ],ENT_QUOTES,'UTF-8',TRUE);
      $LastName = htmlentities($form[ 'last_name' ],ENT_QUOTES,'UTF-8',TRUE);
      $Email = htmlentities($form[ 'email' ],ENT_QUOTES,'UTF-8',TRUE);
      $Address = htmlentities($form[ 'address' ],ENT_QUOTES,'UTF-8',TRUE);
      $AccessLevel = 3; //default access level for all accounts except for web admin
      
      // !filter_var($email, FILTER_VALIDATE_EMAIL)
      //!preg_match("", $Password) || !preg_match("", $FirstName) || !preg_match("", $LastName) ||
      
      //server side regex validation
      if(!preg_match("/\w{5,255}/", $Username) || !preg_match("/^(?=.*\d)(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/", $Password) || !preg_match("/([A-Z|a-z])\w+/", $FirstName) || !preg_match("/([A-Z|a-z])\w+/", $LastName) || !preg_match("/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,6}$/", $Email))
      {
        include 'regError.php';
      }
      else
      {
        //Encrypt password
        require $_SERVER['DOCUMENT_ROOT'].'/assignment1_website/includes/passwordHashing.php'; //Contains $HashedPassword variable.

        $SQL = "INSERT INTO users (username, password, first_name, last_name, email, address, access_level) 
        VALUES(:username, :password, :first_name, :last_name, :email, :address, :access_level)";
        $Query = $Con->prepare($SQL);
        $Result = $Query->execute(array(':username'=>$Username, ':password'=>$HashedPassword, ':first_name'=>$FirstName, ':last_name'=>$LastName, ':email'=>$Email, ':address'=>$Address, ':access_level'=>$AccessLevel));

        if($Result)
        {
           include 'regThank.php';
        } else {
          header("Location: index.php");
        }
      }
      

    }
      catch(PDOException $e)
      {
        //echo "Error:".$e->getMessage(); //debug purposes, comment out when done, then enable line of code below, so user is given a friendly error message, rather than the standard SQL.
        include 'regError.php';
      }

      $Con = null;
    }

?>
