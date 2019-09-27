<!--Check Login--> <!--Change to require if page requires user account-->
<?php include $_SERVER['DOCUMENT_ROOT'].'/assignment1_website/includes/checkLogin.php';?>
<?php
if(!isset($_SESSION['Username']))
{
  header("Location: ../adminError/index.php");
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
<title>Update staff user account</title>
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
      Update staff user account
    </h1>
  </div>
  
  <!--Nav-->
  <?php include $_SERVER['DOCUMENT_ROOT'].'/assignment1_website/includes/nav.php';?>
  
  <!--Body-->
  <div id="body">
        <?php
   try{
      include $_SERVER['DOCUMENT_ROOT'].'/assignment1_website/includes/dbLogin.php';

      $Username = htmlentities($_REQUEST['username'],ENT_QUOTES,'UTF-8',TRUE);

      //Get product details
      $Con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $Con -> prepare("SELECT username, first_name, last_name, email, address, access_level FROM users WHERE username='".$Username."'");
      $stmt -> execute();

      $result = $stmt -> fetchAll();

      if($result)
      {
      echo "<form name=\"updateStaff\" action=\"updateStaff.php\" method=\"POST\">";
      foreach ($result as $row)
      {
        echo "<label for= \'Username\'>Username: </label>";
        echo "<input type=\"text\" name=\"Username\" value=\"".$row['username']."\" readonly/>";
        
        echo "<label for= \'First_Name\'>First Name: </label>";
        echo "<input type=\"text\" name=\"First_Name\" value=\"".$row['first_name']."\" required/>";
        
        echo "<label for= \'Last_Name\'>Last Name: </label>";
        echo "<input type=\"text\" name=\"Last_Name\" value=\"".$row['last_name']."\" required/>";
        
        echo "<label for= \'Email\'>Email: </label>";
        echo "<input type=\"text\" name=\"Email\" value=\"".$row['email']."\" required/>";
        
        echo "<label for= \'Address\'>Address: </label>";
        echo "<input type=\"text\" name=\"Address\" value=\"".$row['address']."\" required/>";
        
        echo "<label for= \'Access_Level\'>Access Level: </label>";
        echo "<input type=\"text\" name=\"Access_Level\" value=\"".$row['access_level']."\" required/>";
        
        /*
        id
        prod_id
        prod_image
        prod_name
        prod_desc
        prod_developer
        prod_publisher
        prod_stock
        prod_price
        */
        
      }
        echo "<input type=\"submit\" name=\"submit\" value=\"Update staff user account\">";
      echo "</form>";

     }

    }
    catch(PDOException $e)
    {
      //echo "Error:".$e->getMessage(); //debug purposes, comment out when done, then enable line of code below, so user is given a friendly error message, rather than the standard SQL.
      header("Location: ../adminError/index.php");
    }
    $Con = null;
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
  //If user is logged in but does not have appropiate privilages
  else
  {
    header("Location: ../adminError/index.php");
  }
}
?>