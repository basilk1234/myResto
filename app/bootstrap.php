<?php

  require_once 'config/config.php';

  // require_once 'extras/url_helper.php';
  require_once 'extras/extras.php';

  // Autoload Core Libraries
  spl_autoload_register(function($className){
    require_once 'libraries/' . $className . '.php';
  });
  
