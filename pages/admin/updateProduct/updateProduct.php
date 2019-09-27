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
    if(!empty($_POST)) //DIsplays form page while post is empty, after user submits the ELSE clause re-directs back to this page after user submits, but shows different view of page.
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
<title>Update Product</title>
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
      Update Product
    </h1>
  </div>
  
  <!--Nav-->
  <?php include $_SERVER['DOCUMENT_ROOT'].'/assignment1_website/includes/nav.php';?>
  
  <!--Body-->
  <div id="body">
        <?php
  try
    {
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
        include $_SERVER['DOCUMENT_ROOT'].'/assignment1_website/includes/dbLogin.php';

        $form = $_POST;
        $ProdID = htmlentities($form[ 'prod_ID' ],ENT_QUOTES,'UTF-8',TRUE);
        $ProdImage = htmlentities($form[ 'prod_Image' ],ENT_QUOTES,'UTF-8',TRUE);
        $ProdName  = htmlentities($form[ 'prod_Name' ],ENT_QUOTES,'UTF-8',TRUE);
        $ProdDesc = htmlentities($form[ 'prod_Desc' ],ENT_QUOTES,'UTF-8',TRUE);
        $ProdDeveloper = htmlentities($form[ 'prod_Developer' ],ENT_QUOTES,'UTF-8',TRUE);
        $ProdPublisher = htmlentities($form[ 'prod_Publisher' ],ENT_QUOTES,'UTF-8',TRUE);
        $ProdStock = htmlentities($form[ 'prod_Stock' ],ENT_QUOTES,'UTF-8',TRUE);
        $ProdPrice = htmlentities($form[ 'prod_Price' ],ENT_QUOTES,'UTF-8',TRUE);
      
        $SQL = "UPDATE prod_games SET prod_image= :Prod_Image, prod_name= :Prod_Name, prod_desc= :Prod_Desc, prod_developer= :Prod_Developer, prod_publisher= :Prod_Publisher, prod_stock= :Prod_Stock, prod_price= :Prod_Price WHERE prod_id= :Prod_ID";
        $Query = $Con -> prepare($SQL);
        $Query -> bindParam(':Prod_ID', $ProdID);
        $Query -> bindParam(':Prod_Image', $ProdImage);
        $Query -> bindParam(':Prod_Name', $ProdName);
        $Query -> bindParam(':Prod_Desc', $ProdDesc);
        $Query -> bindParam(':Prod_Developer', $ProdDeveloper);
        $Query -> bindParam(':Prod_Publisher', $ProdPublisher);
        $Query -> bindParam(':Prod_Stock', $ProdStock);
        $Query -> bindParam(':Prod_Price', $ProdPrice);

        $Query->execute();

        if($Query)
        {
          header("Location: updateThank.php");
        } else {
          header("Location: index.php");
        }
    }
    
    catch(PDOException $e)
    {
      //echo "Error:".$e->getMessage(); //debug purposes, comment out when done, then enable line of code below, so user is given a friendly error message, rather than the standard SQL.
      header("Location: updateProdError.php");
    }
    $Con = null;
  }
  else
  {
    header("Location: updateProdError.php");
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
    header("Location: updateProdError.php");
  }
}
?>