<!--Check Login--> <!--Change to require if page requires user account-->
<?php require $_SERVER['DOCUMENT_ROOT'].'/assignment1_website/includes/checkLogin.php';?>
<?php
  if(!isset($_SESSION['Username']))
{
  header("Location: addError.php");
}
else
  {
  if($_SESSION['AccessLevel'] == 1)
  {
    if(empty($_POST)) //Displays form page while post is empty, after user submits the ELSE clause re-directs back to this page after user submits, but shows different view of page.
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
<title>Staff listing</title>
  <!--Games-->
<link href="/assignment1_website/styles/boilerplate.css" rel="stylesheet" type="text/css">
<link href="/assignment1_website/styles/MainStyle.css" rel="stylesheet" type="text/css">
  
<link href="/assignment1_website/styles/staffListingTable.css" rel="stylesheet" type="text/css">
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
      Staff accounts listing
      
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
    echo "<tr> <th>ID</th> <th>Username</th> <th>First name</th> <th>Last name</th> <th>Email</th> <th>Address</th> <th>Access level</th> <th></th> <th></th> </tr>";
    echo "</thead>";

  // PDO login
  include $_SERVER['DOCUMENT_ROOT'].'/assignment1_website/includes/dbLogin.php';
try
{
  $Con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $Con -> prepare("SELECT id, username, first_name, last_name, email, address, access_level FROM users WHERE access_level='2'");
  $stmt -> execute();
  
  $result = $stmt -> fetchAll();
  
  if($result)
  {
    echo "<tbody>";
    foreach ($result as $row)
    {
      echo("<tr>");
      echo "<td>".$row['id']." </td>";
      echo "<td>".$row['username']." </td>";
      echo "<td>".$row['first_name']." </td>";
      echo "<td>".$row['last_name']." </td>";
      echo "<td>".$row['email']." </td>";
      echo "<td>".$row['address']." </td>";
      echo "<td>".$row['access_level']." </td>";
      echo "<td style=\"padding: 60px 0; text-align:center;\">"."<a id=\"button\" href=\"../updateStaffUser/index.php?username=".urlencode($row['username'])."\"> Edit </a>"."</td>";
      echo "<td style=\"padding: 60px 0; text-align:center;\">"."<a id=\"button\" href=\"../deleteStaffUser/index.php?username=".urlencode($row['username'])."\"> Remove </a>"."</td>";
      
      echo("</tr>");
    }
    echo "</tbody>";
    
  }
  else
  {
    echo("No users found in table");
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
<?php
  }
  }
  else
  {
    header("Location: ../adminError/index.php");
  }
  }
?>