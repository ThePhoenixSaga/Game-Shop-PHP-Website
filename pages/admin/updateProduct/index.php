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
   try{
      include $_SERVER['DOCUMENT_ROOT'].'/assignment1_website/includes/dbLogin.php';

      $Prod_ID = htmlentities($_REQUEST['prod_ID'],ENT_QUOTES,'UTF-8',TRUE);

      //Get product details
      $Con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $Con -> prepare("SELECT * FROM prod_games WHERE prod_id='".$Prod_ID."'");
      $stmt -> execute();

      $result = $stmt -> fetchAll();

      if($result)
      {
      echo "<form name=\"updateProduct\" action=\"updateProduct.php\" method=\"POST\">";
      foreach ($result as $row)
      {
        echo "<label for= \'prod_ID\'>Product ID: </label>";
        echo "<input type=\"text\" name=\"prod_ID\" value=\"".$row['prod_id']."\" readonly/>";
        
        echo "<label for= \'prod_Image\'>Product Image: </label>";
        echo "<input type=\"text\" name=\"prod_Image\" value=\"".$row['prod_image']."\" />";
        
        echo "<label for= \'prod_Name\'>Product Name: </label>";
        echo "<input type=\"text\" name=\"prod_Name\" value=\"".$row['prod_name']."\" />";
        
        echo "<label for= \'prod_Desc\'>Product Description: </label>";
        echo "<input type=\"text\" name=\"prod_Desc\" value=\"".$row['prod_desc']."\" />";
        
        echo "<label for= \'prod_Developer\'>Product Developer: </label>";
        echo "<input type=\"text\" name=\"prod_Developer\" value=\"".$row['prod_developer']."\" />";
        
        echo "<label for= \'prod_Publisher\'>Product Publisher: </label>";
        echo "<input type=\"text\" name=\"prod_Publisher\" value=\"".$row['prod_publisher']."\" />";
        
        echo "<label for= \'prod_Stock\'>Product Stock: </label>";
        echo "<input type=\"text\" name=\"prod_Stock\" value=\"".$row['prod_stock']."\" />";
        
        echo "<label for= \'prod_Price\'>Product Price: </label>";
        echo "<input type=\"text\" name=\"prod_Price\" value=\"".$row['prod_price']."\" />";
        
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
        echo "<input type=\"submit\" name=\"submit\" value=\"Update product\">";
      echo "</form>";

     }

    }
    catch(PDOException $e)
    {
      //echo "Error:".$e->getMessage(); //debug purposes, comment out when done, then enable line of code below, so user is given a friendly error message, rather than the standard SQL.
      header("Location: updateProdError.php");
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
    header("Location: updateProdError.php");
  }
}
?>