<!--Check Login--> <!--Change to require if page requires user account-->
<?php include $_SERVER['DOCUMENT_ROOT'].'/assignment1_website/includes/checkLogin.php';?>
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
<title>Accessories</title>
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
      Accessories
    </h1>
  </div>
  
  <!--Nav-->
  <?php include $_SERVER['DOCUMENT_ROOT'].'/assignment1_website/includes/nav.php';?>
  
  <!--Body-->
  <div id="body">
   <?php
    //Tables
    echo "<table style='border: solid 1px black;'>";
    echo "<tr> <th>ID</th> <th>First Name</th> <th>Last Name</th> <th>Email</th> <th>Gender</th> <th>ID Address</th> <th>Credit Card No.</th> </tr>";

  class TableRows extends RecursiveIteratorIterator
  {
    function __construct($it)
    {
      parent::__construct($it, self::LEAVES_ONLY);
    }

    function current()
    {
      return"<td style = 'width:150px; border:1px solid black;'>".parent::current()."</td>";
    }

    function beginChildren()
    {
      echo"<tr>";
    }

    function endChildren()
    {
      echo"</tr>"."\n";
    }
  }

  // PDO select
  include $_SERVER['DOCUMENT_ROOT'].'/assignment1_website/includes/dbLogin.php';

try
{
  $con = new PDO("mysql:host=$servername;dbname=$dbname", $username,$password);
  $con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $con -> prepare("select * from test_employees");
  $stmt -> execute();
  
  //Set the resulting array to associative
  $result = $stmt -> setFetchMode(PDO::FETCH_ASSOC);
  foreach(new TableRows(new RecursiveArrayIterator($stmt -> fetchAll())) as $k => $v)
  {
    echo $v;
  }
}

catch(PDOException $e)
{
  echo "Error:".$e->getMessage();
}
$con = null;
echo"</table>"
    ?>
  </div>
  
  <!--Footer-->
  <?php include $_SERVER['DOCUMENT_ROOT'].'/assignment1_website/includes/footer.php';?>
</div>
</body>
</html>

