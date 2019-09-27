  <div id="nav">
    <ul class="topnav">
      <li><a href="/assignment1_website/">Home</a></li>
      <li><a href="/assignment1_website/pages/login/">Login</a></li>
      <li><a href="/assignment1_website/pages/registration/">Registration</a></li>
      <li><a href="/assignment1_website/pages/products/">Products</a></li>
      <li><a href="/assignment1_website/pages/orders/">Orders</a></li>
      <?php if(isset($_SESSION['Username'])) { ?>
      <li class="right" style="border-right: none;"><a href="/assignment1_website/pages/account/">Account</a></li>
      <?php } ?>
       <li class="right"><a href="./pages/logout/">Logout</a></li>
    </ul> 
  </div>

<?php

if(isset($_SESSION['Username']))
{
    if($_SESSION['AccessLevel'] == 1 || $_SESSION['AccessLevel'] == 2)
    {
      include $_SERVER['DOCUMENT_ROOT'].'/includes/adminNav.php';
    }
}
else
  {
    //Do nothing
  }


//<li><a href="/assignment1_website/pages/checkouts/">Checkouts</a></li>
?>
