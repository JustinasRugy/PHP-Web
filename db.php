<?php
$con = mysqli_connect("eu-cdbr-west-02.cleardb.net","bc4808bd0923d3","ad199d07","heroku_68be1cca630a5bd");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>