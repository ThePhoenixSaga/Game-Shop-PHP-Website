<!--Check Login--> <!--Change to require if page requires user account-->
<?php require $_SERVER['DOCUMENT_ROOT'].'/assignment1_website/includes/checkLogin.php';?>
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
<title>Products</title>
  <!--Games-->
<link href="/assignment1_website/styles/boilerplate.css" rel="stylesheet" type="text/css">
<link href="/assignment1_website/styles/MainStyle.css" rel="stylesheet" type="text/css">
  
<link href="/assignment1_website/styles/productTableStyle.css" rel="stylesheet" type="text/css">
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
      Products
      <!--Games-->
    </h1>
  </div>
  
  <!--Nav-->
  <?php include $_SERVER['DOCUMENT_ROOT'].'/assignment1_website/includes/nav.php';?>
  
  <!--Body-->
  <div id="body">
    <?php
    $AdminOnly = null; //Stops PHP erroring if user is not logged in as admin or staff
    if($_SESSION['AccessLevel'] == 1 || $_SESSION['AccessLevel'] == 2) {$AdminOnly = "<th></th> <th></th>";}
    //Tables
    echo "<table>";
    echo "<thead>";
    echo "<tr> <th>ID</th> <th>Product ID</th> <th>Product Image</th> <th>Product Name</th> <th>Description</th> <th>Developer</th> <th>Publisher</th> <th>Stock</th> <th>Price £</th> <th></th>".$AdminOnly."</tr>";
    echo "</thead>";

  // PDO login
  include $_SERVER['DOCUMENT_ROOT'].'/assignment1_website/includes/dbLogin.php';

try
{
  $Con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $Con -> prepare("select * from prod_games");
  $stmt -> execute();
  
  $result = $stmt -> fetchAll();
  
  if($result)
  {
    echo "<tbody>";
    foreach ($result as $row)
    {
      echo("<tr>");
      echo "<td>".$row['id']." </td>";
      echo "<td>".$row['prod_id']." </td>";
      echo "<td>"."<img src='../../images/productImages/".$row['prod_image'].".jpg'> </td>";
      echo "<td>".$row['prod_name']." </td>";
      echo "<td>".$row['prod_desc']." </td>";
      echo "<td>".$row['prod_developer']." </td>";
      echo "<td>".$row['prod_publisher']." </td>";
      echo "<td>".$row['prod_stock']." </td>";
      echo "<td>".$row['prod_price']." </td>";
      echo "<td style=\"padding: 60px 0; text-align:center;\">"."<a id=\"button\" href=\"productAdd.php?prod_ID=".urlencode($row['prod_id'])."\"> Buy </a>"."</td>";
      
      //Admin and staff only
      if($_SESSION['AccessLevel'] == 1 || $_SESSION['AccessLevel'] == 2)
      {
        echo "<td style=\"padding: 60px 0; text-align:center;\">"."<a id=\"button\" href=\"../admin/updateProduct/index.php?prod_ID=".urlencode($row['prod_id'])."\"> Update </a>"."</td>";
        echo "<td style=\"padding: 60px 0; text-align:center;\">"."<a id=\"button\" href=\"../admin/deleteProduct/index.php?prod_ID=".urlencode($row['prod_id'])."\"> Delete </a>"."</td>";
      }
      
      echo("</tr>");
    }
    echo "</tbody>";
    
  }
  else
  {
    echo("No products found in table");
  }
}

catch(PDOException $e)
{
  echo "Error:".$e->getMessage();
}
$Con = null;
echo"</table>"
    ?>
  </div>
  
  <!--Footer-->
  <?php include $_SERVER['DOCUMENT_ROOT'].'/assignment1_website/includes/footer.php';?>
</div>
</body>
</html>
