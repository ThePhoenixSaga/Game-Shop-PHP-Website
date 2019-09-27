<!--Check Login--> <!--Change to require if page requires user account-->
<?php require $_SERVER['DOCUMENT_ROOT'].'/assignment1_website/includes/checkLogin.php';?>
<?php
if(!isset($_SESSION['Username']))
{
  header("Location: prodError.php");
}
else
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
<title>Product Added</title>
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
      Product Added
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
      echo "<form name=\"registration\" action=\"productAdd.php\" method=\"POST\">";
      foreach ($result as $row)
      {
        echo "<label for= \'username\'>Username: </label>";
        echo "<input type=\"text\" name=\"username\" value=\"".$_SESSION['Username']."\" readonly/>";
        
        echo "<label for= \'prod_ID\'>Product ID: </label>";
        echo "<input type=\"text\" name=\"prod_ID\" value=\"".$row['prod_id']."\" readonly/>";
        
        //quantity
        echo "<label for= \'quantity\'>quantity: </label>";
        echo "<input type=\"text\" name=\"quantity\" id=\"quantity\" value=\"1\" readonly/>";
        
        //total price
        echo "<label for= \'total_price\'>Total Price: </label>";
        echo "<input type=\"text\" name=\"total_price\" id=\"total_price\" value=\"".$row['prod_price']."\" readonly/>";
      }
        echo "<input type=\"submit\" name=\"addOrder\" value=\"Add to Orders\">";
      echo "</form>";

     }

    /*
    id
    username
    prod_id
    quantity
    total price
    */
    }
    catch(PDOException $e)
    {
      //echo "Error:".$e->getMessage(); //debug purposes, comment out when done, then enable line of code below, so user is given a friendly error message, rather than the standard SQL.
      include 'prodError.php';
    }
    $Con = null;
  } 
  else 
  {
      try
      {
          include $_SERVER['DOCUMENT_ROOT'].'/assignment1_website/includes/dbLogin.php';

          $form = $_POST;
          $Username = htmlentities($form['username'],ENT_QUOTES,'UTF-8',TRUE);
          $ProdID = htmlentities($form['prod_ID'],ENT_QUOTES,'UTF-8',TRUE);
          $Quantity = htmlentities($form['quantity'],ENT_QUOTES,'UTF-8',TRUE);
          $TotalPrice = htmlentities($form['total_price'],ENT_QUOTES,'UTF-8',TRUE);

          //Get product details
          $Con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $Con -> prepare("SELECT * FROM prod_games WHERE prod_id='".$ProdID."'");
          $stmt -> execute();

          $result = $stmt -> fetchAll();

          foreach ($result as $row)
          {
             $ProdStock = $row['prod_stock'];
          }

          if(!$ProdStock <= 0)
          {
            
          $NewProdStock = --$ProdStock;
          //Take one away from product stock
          $SQL = "UPDATE prod_games SET prod_stock= :ProdStock WHERE prod_id= :ProdID";
          $Query = $Con -> prepare($SQL);
          $Query -> bindParam(':ProdID', $ProdID);
          $Query -> bindParam(':ProdStock', $NewProdStock);
          $Query -> execute();
          
          //Bring up product details
          $Con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $Con -> prepare("SELECT * FROM prod_games WHERE prod_id='".$ProdID."'");
          $stmt -> execute();

          $result = $stmt -> fetchAll();

          foreach ($result as $row)
          {
             $ProdStock = $row['prod_stock'];
          }
            
            //Add to orders
            
            $SQL = "INSERT INTO orders (username, prod_id, quantity, total_price) 
            VALUES(:username, :prod_id, :quantity, :total_price)";
            $Query = $Con->prepare($SQL);
            $Result = $Query->execute(array(':username'=>$Username, ':prod_id'=>$ProdID, ':quantity'=>$Quantity, ':total_price'=>$TotalPrice));

            if($Result)
            {
              header("Location: prodThank.php");
            } else {
              include 'prodError.php';
            }
          }
        }

        catch(PDOException $e)
        {
          //echo "Error:".$e->getMessage(); //debug purposes, comment out when done, then enable line of code below, so user is given a friendly error message, rather than the standard SQL.
          include 'prodError.php';
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
?>