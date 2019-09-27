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
<title>Products</title>
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
      Products
    </h1>
  </div>
  
  <!--Nav-->
  <?php include $_SERVER['DOCUMENT_ROOT'].'/assignment1_website/includes/nav.php';?>
  
  <!--Body-->
  <div id="body">
    <div id="innerBody">
      <a href="/assignment1_website/pages/products/accessories/">
      <img src="/assignment1_website/images/pageImages/acces.png" alt="Accessories" id="innerBody">
      </a>
      <label> Accessories </label>
    </div>
    
    <div id="innerBody">
      <a href="/assignment1_website/pages/products/consoles/">
      <img src="/assignment1_website/images/pageImages/console.png" alt="Consoles" id="innerBody">
      </a>
      <label> Consoles </label>
    </div>
    
    <div id="innerBody">
      <a href="/assignment1_website/pages/products/games/">
      <img src="/assignment1_website/images/pageImages/game.png" alt="Games" id="innerBody">
      </a>
      <label> Games </label>
    </div>
  </div>
  
  <!--Footer-->
  <?php include $_SERVER['DOCUMENT_ROOT'].'/assignment1_website/includes/footer.php';?>
</div>
</body>
</html>
