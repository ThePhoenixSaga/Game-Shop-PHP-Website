<?php
  $ServerName = "127.0.0.1:3307";
  $DBUserName = "root";
  $DBPassword = "usbw";
  $DBName = "ddw_assignment1";
  $Con = new PDO("mysql:host=$ServerName;dbname=$DBName", $DBUserName, $DBPassword);
  $Con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  //127.0.0.1:3307 - For use hwne running on a USBServer
  //127.0.0.1 - Should be useable on a dedicated web server, needs further testing on a dedicated web server
?>