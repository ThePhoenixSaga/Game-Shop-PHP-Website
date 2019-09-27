<!--Check Login--> <!--Change to require if page requires user account-->
<?php include $_SERVER['DOCUMENT_ROOT'].'/assignment1_website/includes/checkLogin.php';?>
<?php
if(!isset($_SESSION['Username']))
{
  header("Location: addError.php");
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
<title>Add Product</title>
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
      Add Product
    </h1>
  </div>
  
  <!--Nav-->
  <?php include $_SERVER['DOCUMENT_ROOT'].'/assignment1_website/includes/nav.php';?>
  
  <!--Body-->
  <div id="body">
    
    <form name="updateProduct" action="index.php" method="POST">
        <label for='prod_ID'>Product ID: </label>
        <input type="text" name="prod_ID" value="" title="Field required" required/>
        
        <label for='prod_Image'>Product Image: </label>
        <input type="text" name="prod_Image" value="" title="Field required" required/>
        
        <label for='prod_Name'>Product Name: </label>
        <input type="text" name="prod_Name" value="" title="Field required" required/>
        
        <label for='prod_Desc'>Product Description: </label>
        <input type="text" name="prod_Desc" value="" title="Field required" required/>
        
        <label for='prod_Developer'>Product Developer: </label>
        <input type="text" name="prod_Developer" value="" title="Field required" required/>
        
        <label for= 'prod_Publisher'>Product Publisher: </label>
        <input type="text" name="prod_Publisher" value="" title="Field required" required/>
        
        <label for='prod_Stock'>Product Stock: </label>
        <input type="text" name="prod_Stock" value="" title="Field required" required/>
        
        <label for='prod_Price'>Product Price: </label>
        <input type="text" name="prod_Price" value="" title="Field required" required/>
        
        <input type="submit" name="submit" value="Add product">
      </form>
    
    <?php
    }else{ 
      try{
     include $_SERVER['DOCUMENT_ROOT'].'/assignment1_website/includes/dbLogin.php';

     $Prod_ID = htmlentities($_REQUEST['prod_ID'],ENT_QUOTES,'UTF-8',TRUE);
     $Prod_Image = htmlentities($_REQUEST['prod_Image'],ENT_QUOTES,'UTF-8',TRUE);
     $Prod_Name = htmlentities($_REQUEST['prod_Name'],ENT_QUOTES,'UTF-8',TRUE);
     $Prod_Desc = htmlentities($_REQUEST['prod_Desc'],ENT_QUOTES,'UTF-8',TRUE);
     $Prod_Developer = htmlentities($_REQUEST['prod_Developer'],ENT_QUOTES,'UTF-8',TRUE);
     $Prod_Publisher = htmlentities($_REQUEST['prod_Publisher'],ENT_QUOTES,'UTF-8',TRUE);
     $Prod_Stock = htmlentities($_REQUEST['prod_Stock'],ENT_QUOTES,'UTF-8',TRUE);
     $Prod_Price = htmlentities($_REQUEST['prod_Price'],ENT_QUOTES,'UTF-8',TRUE);

     //Get product details
     $Con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

     $SQL = "INSERT INTO prod_games (prod_id, prod_image, prod_name, prod_desc, prod_developer, prod_publisher, prod_stock, prod_price) 
     VALUES(:prod_Id, :prod_Image, :prod_Name, :prod_Desc, :prod_Developer, :prod_Publisher, :prod_Stock, :prod_Price)";
     $Query = $Con->prepare($SQL);
     $stmt = $Query->execute(array(':prod_Id'=>$Prod_ID, ':prod_Image'=>$Prod_Image, ':prod_Name'=>$Prod_Name, ':prod_Desc'=>$Prod_Desc, ':prod_Developer'=>$Prod_Developer, ':prod_Publisher'=>$Prod_Publisher, ':prod_Stock'=>$Prod_Stock, ':prod_Price'=>$Prod_Price));



      if($stmt)
      {
        header("Location: addThank.php");
      }
    }
    catch(PDOException $e)
    {
      echo "Error:".$e->getMessage(); //debug purposes, comment out when done, then enable line of code below, so user is given a friendly error message, rather than the standard SQL.
      header("Location: addError.php");
    }
    $Con = null;
    }
  }
  else //If user is logged in but does not have appropiate privilages
  {
    header("Location: addError.php");
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