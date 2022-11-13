<?php
  //this makes it easier than always using required for everything 


  define('DB_HOST', 'localhost:3306');
  define('DB_USER', 'root');
  define('DB_PASS', '1234567');
  define('DB_NAME', 'resto');


  define('APPROOT', dirname(dirname(__FILE__)));
  
  define('URLROOT', 'http://localhost/myResto');

  define('SITENAME', 'myResto');

  $con = mysqli_connect('localhost','root','','resto');