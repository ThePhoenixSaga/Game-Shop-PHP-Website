<?php
session_start();
//Displays username at top if user is logged in.
if(isset($_SESSION['Username']))
{
?>  
<div id="username">
  <?php 
    echo("<b>".$_SESSION['Username']."</b>"); //Display username at the top.
  ?>
</div>
<?php
  }
else
{
  $_SESSION['UserID'] = null;
  $_SESSION['Username'] = null;
  $_SESSION['AccessLevel'] = null; 
}
?>