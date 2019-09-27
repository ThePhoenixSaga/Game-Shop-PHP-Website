<!--Check Login--> <!--Change to require if page requires user account-->
<?php include $_SERVER['DOCUMENT_ROOT'].'/assignment1_website/includes/checkLogin.php';?>
<?php
if(!isset($_SESSION['Username']))
{
  header("Location: addError.php");
}
else
  {
  if($_SESSION['AccessLevel'] == 1)
  {
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
<title>Create staff user</title>
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
</head>
<body>
<div class="gridContainer clearfix">
  <!--Logo-->
  <?php include $_SERVER['DOCUMENT_ROOT'].'/assignment1_website/includes/logo.php';?>
  
  <div id="header">
    <h1>
      Create staff user
    </h1>
  </div>
  
  <!--Nav-->
  <?php include $_SERVER['DOCUMENT_ROOT'].'/assignment1_website/includes/nav.php';?>
  
  <!--Body-->
  <div id="body">
    <h2>Staff user Registration</h2>
      <form name="staffRegistration" action="index.php" method="POST" > <!--javascript:alert('test OK')-->
        <label for= 'username'>Username: </label>
        <br/>
        <input type="text" name="username" title="Please do not leave empty." required/>
        <br/>
        
        <label for= 'password'>Password: </label>
        <br/>
        <input type="password" name="password" title="Please do not leave empty." required/>
        <br/>
        
        <label for= 'first_name'>First name: </label>
        <br/>
        <input type="text" name="first_name" title="Please do not leave empty." required/>
        <br/>
        
        <label for= 'last_name'>Last name: </label>
        <br/>
        <input type="text" name="last_name" title="Please do not leave empty." required/>
        <br/>
        
        <label for= 'email'>Email: </label>
        <br/>
        <input type="text" name="email" title="Please do not leave empty." required/>
        <br/>
        
        <label for= 'address'>Address: </label>
        <br/>
        <input type="text" name="address" title="Please do not leave empty." required/>
        <br/>
        
        <label for= 'address'>Access level: </label>
        <br/>
        <input type="text" name="access_level" title="Please do not leave empty." required/>
        <br/>
        
        <input id="submit" name="submit" type="submit" value="Register Staff Account"></input>
       </form>
    
    <?php
    }else{ 
      try{
     include $_SERVER['DOCUMENT_ROOT'].'/assignment1_website/includes/dbLogin.php';

      $form = $_POST;
      $Username = htmlentities($form[ 'username' ],ENT_QUOTES,'UTF-8',TRUE);
      $Password  = htmlentities($form[ 'password' ],ENT_QUOTES,'UTF-8',TRUE);
      $FirstName = htmlentities($form[ 'first_name' ],ENT_QUOTES,'UTF-8',TRUE);
      $LastName = htmlentities($form[ 'last_name' ],ENT_QUOTES,'UTF-8',TRUE);
      $Email = htmlentities($form[ 'email' ],ENT_QUOTES,'UTF-8',TRUE);
      $Address = htmlentities($form[ 'address' ],ENT_QUOTES,'UTF-8',TRUE);
      $AccessLevel = htmlentities($form[ 'access_level' ],ENT_QUOTES,'UTF-8',TRUE);

     //Get product details
     $Con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

     //Encrypt password
     require $_SERVER['DOCUMENT_ROOT'].'/assignment1_website/includes/passwordHashing.php'; //Contains $HashedPassword variable.

        $SQL = "INSERT INTO users (username, password, first_name, last_name, email, address, access_level) 
        VALUES(:username, :password, :first_name, :last_name, :email, :address, :access_level)";
        $Query = $Con->prepare($SQL);
        $Result = $Query->execute(array(':username'=>$Username, ':password'=>$HashedPassword, ':first_name'=>$FirstName, ':last_name'=>$LastName, ':email'=>$Email, ':address'=>$Address, ':access_level'=>$AccessLevel));

        if($Result)
        {
           header("Location: createStaffThank.php");
        } else {
          header("Location: ../adminError/index.php");
        }
    }
    catch(PDOException $e)
    {
      echo "Error:".$e->getMessage(); //debug purposes, comment out when done, then enable line of code below, so user is given a friendly error message, rather than the standard SQL.
      header("Location: ../adminError/index.php");
    }
    $Con = null;
    }
  }
  else //If user is logged in but does not have appropiate privilages
  {
    header("Location: ../adminError/index.php");
  }
  ?>
  </div>
  
  <!--Footer-->
  <?php include $_SERVER['DOCUMENT_ROOT'].'/assignment1_website/includes/footer.php';?>
</div>
</body>
</html>
<?php
  }
?>