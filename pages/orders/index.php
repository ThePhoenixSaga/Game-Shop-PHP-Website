<!--Check Login--> <!--Change to require if page requires user account-->
<?php include $_SERVER['DOCUMENT_ROOT'].'/assignment1_website/includes/checkLogin.php';?>
<?php
if(!isset($_SESSION['Username']))
{
  header("Location: ordersError.php");
}
else
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
<title>Orders</title>
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
      Orders
    </h1>
  </div>
  
  <!--Nav-->
  <?php include $_SERVER['DOCUMENT_ROOT'].'/assignment1_website/includes/nav.php';?>
  
  <!--Body-->
  <div id="body">
  <?php
    //Tables
    echo "<table>";
    echo "<thead>";
    echo "<tr> <th>ID</th> <th>Username</th> <th>Product ID</th> <th>Quantity</th> <th>Total pirce</th> </tr>";
    echo "</thead>";

  // PDO login
  include $_SERVER['DOCUMENT_ROOT'].'/assignment1_website/includes/dbLogin.php';

try
{
  if($_SESSION['AccessLevel'] == 1 || $_SESSION['AccessLevel'] == 2)
  {
    $Con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $Con -> prepare("SELECT * FROM orders");
    $stmt -> execute();

    $result = $stmt -> fetchAll();
  }
  else
  {
    $Con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $Con -> prepare("SELECT * FROM orders WHERE username=\"".$_SESSION['Username']."\"");
    $stmt -> execute();

    $result = $stmt -> fetchAll();
  }

    if($result)
    {
      echo "<tbody>";
      foreach ($result as $row)
      {
        echo("<tr>");
        echo "<td>".$row['id']." </td>";
        echo "<td>".$row['username']." </td>";
        echo "<td>".$row['prod_id']." </td>";
        echo "<td>".$row['quantity']." </td>";
        echo "<td>".$row['total_price']." </td>";
        echo("</tr>");
      }
      echo "</tbody>";

    }
    else
    {
      echo("No orders have been found.");
    }
  }

catch(PDOException $e)
{
  //echo "Error:".$e->getMessage();
  header("Location: ordersError.php");
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
<?php } ?>