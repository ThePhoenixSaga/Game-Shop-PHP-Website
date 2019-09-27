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
<title>Login</title>
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
<script src="./styles/respond.min.js"></script>
<?php include $_SERVER['DOCUMENT_ROOT'].'/assignment1_website/includes/scripts.php';?>
<?php include $_SERVER['DOCUMENT_ROOT'].'/assignment1_website/includes/formValidation.php';?>
</head>
<body>
<div class="gridContainer clearfix">
  <!--Logo-->
  <?php include $_SERVER['DOCUMENT_ROOT'].'/assignment1_website/includes/logo.php';?>

  <div id="header">
    <h1>
      Login
    </h1>
  </div>
  
  <!--Nav-->
  <?php include $_SERVER['DOCUMENT_ROOT'].'/assignment1_website/includes/nav.php';?>
  
  <!--Body-->
  <div id="body">
    
    <h2>Login</h2>
      <form name="registration" action="index.php" method="POST" > <!--javascript:alert('Add login SQL codes, dumbass!')-->
        <label for= 'username'>Username: </label>
        <br/>
        <input type="text" name="username" pattern="\w{5,255}" title="Username is invalid, please enter a new different one." required/>
        <br/>
        
        <label for= 'password'>Password: </label>
        <br/>
        <input type="password" name="password" pattern="^(?=.*\d)(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$" title="Password is invalid, remember, must be at least 8 characters long with a number and a capital letter." required/>
        <br/>

        <input id="submit" type="submit" value="Login" onClick="validateForm();"></input>
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

      $form = $_POST;
      $Username = htmlentities($form['username'],ENT_QUOTES,'UTF-8',TRUE);
      $Password  = htmlentities($form['password'],ENT_QUOTES,'UTF-8',TRUE);

      $AccessLevel = null; //pull access level out of table, and add to session.
      
      if(!preg_match("/\w{5,255}/", $Username) || !preg_match("/^(?=.*\d)(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/", $Password))
      {
        header("Location: ../loginFailed/index.php");
      }
      else
      {

         //Encrypt password
        require $_SERVER['DOCUMENT_ROOT'].'/assignment1_website/includes/passwordHashing.php'; //Contains $HashedPassword variable.

        $SQL = "SELECT * FROM users WHERE username = :username";

        $Query = $Con -> prepare($SQL);
        $Query -> bindParam(':username', $Username);
        $Query -> execute();

        $Result = $Query -> fetch(PDO::FETCH_ASSOC);

        if($Result === false)
        {
          //User accout does not exist
          header("Location: ../loginFailed/index.php");
        }
        else
        {
          // User account exists

          //Compare password entered by user with stored password for that account.
          $ValidPassword = password_verify($Password, $Result['password']);

          //If Password match returns true, login
          if($ValidPassword)
          {
            $_SESSION['UserID'] = $Result['id'];
            $_SESSION['Username'] = $Result['username'];
            $_SESSION['AccessLevel'] = $Result['access_level'];

            //Re-direct user
            header ("Location: loginThank.php");
          }
          else //Password match returns false, don't login.
          {
            header("Location: ../loginFailed/index.php");
          }
        }
      }
    }
      catch(PDOException $e)
      {
        //echo "Error:".$e->getMessage();
        header("Location: ../loginFailed/index.php");
      }

      $Con = null;
    }

?>
