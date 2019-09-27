<!--Check Login--> <!--Change to require if page requires user account-->
<?php include $_SERVER['DOCUMENT_ROOT'].'/assignment1_website/includes/checkLogin.php';?>
<?php
if(!isset($_SESSION['Username']))
{
  header("Location: updateProdError.php");
}
else
  {
  if($_SESSION['AccessLevel'] == 1 || $_SESSION['AccessLevel'] == 2)
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
<title>Delete product comfirmation</title>
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
      Delete product comfirmation
    </h1>
  </div>
  
  <!--Nav-->
  <?php include $_SERVER['DOCUMENT_ROOT'].'/assignment1_website/includes/nav.php';?>
  
  <!--Body-->
  <div id="body">
    
    <h2>Are you sure you want to delete the product?</h2>
    <form name="registration" action="index.php" method="POST" > <!--javascript:alert('test OK')-->
        <label for= 'prod_Id'>Product ID: </label>
        <br/>
        <input type="text" name="prod_Id" value="<?php echo($Prod_ID = htmlentities($_REQUEST['prod_ID'],ENT_QUOTES,'UTF-8',TRUE));?>" readonly/>
      <input type="submit" name="submit" value="Delete">
    </form>
        <?php
   try{
      include $_SERVER['DOCUMENT_ROOT'].'/assignment1_website/includes/dbLogin.php';
     
      $stmt = $Con -> prepare("DELETE FROM prod_games WHERE prod_id=:prod_Id");

      $stmt ->bindParam(':prod_Id', $Prod_ID);

      $Prod_ID = htmlentities($_REQUEST['prod_ID'],ENT_QUOTES,'UTF-8',TRUE);

      $stmt -> execute();
     
     if($stmt)
     {
       header("Location: deleteThank.php");
     }

     }
    catch(PDOException $e)
    {
      //echo "Error:".$e->getMessage(); //debug purposes, comment out when done, then enable line of code below, so user is given a friendly error message, rather than the standard SQL.
      header ("Location: deleteError.php");
    }
    $Con = null;
    }
  }
  //If user is logged in but does not have appropiate privilages
  else
  {
    header("Location: deleteError.php");
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