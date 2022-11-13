<?php
  session_start();


  

    function redirect($page){
    header('location: ' . URLROOT . '/' . $page);
  }

  function isLoggedIn(){
    if(isset($_SESSION['user_id'])){
      return true;
    } else {
      return false;
    }
  }
