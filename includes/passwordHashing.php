<?php
  
$options = [
    'cost' => 12,
];
  $HashedPassword = password_hash($Password, PASSWORD_BCRYPT, $options); //Refer to $HashedPassword to store in database. not $Password.

?>