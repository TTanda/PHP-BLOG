<?php
  ini_set( 'display_errors', 1 );
  ini_set( 'display_startup_errors', 1 );
  error_reporting( E_ALL );
  include './includes/Articles.Class.php';
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP BLOG</title>
</head>
<body>
  <h1>My Blog Output</h1>
  <?php
    $articles = new Articles( dirname( __FILE__ ) . '/data/oop-and-file.json' );
    $articles->output();
  ?>
  
</body>
</html>