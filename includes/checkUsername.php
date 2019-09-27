<?php
session_start(); //creates session to store the results of username availabilty.

include $_SERVER['DOCUMENT_ROOT'].'/assignment1_website/includes/dbLogin.php';
$Username = "";

$Username = $_REQUEST["username_query"];

$SQL = $Con->prepare("SELECT * FROM users WHERE username='".$Username."'");

$SQL->execute();

//Sets session to false if username is in use, or true if username is not found in database.
if(!empty($SQL->fetch()))
{
  if($_SESSION['Username'] == $Username)
  {
    $_SESSION["UsernameAvailable"]="True";
    echo("<h3><b>Username still available.</b></h3>");
    return false;
  }
  else
  {
    $_SESSION["UsernameAvailable"]="False";
    echo("<h3><b>Username is unavailable.</b></h3>");
    return true;
  }
}
else
{
  $_SESSION["UsernameAvailable"]="True";
  echo("<h3><b>Username available.</b></h3>");
  return false;
}
?>