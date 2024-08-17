<?php

$url = parse_url($_SERVER['REQUEST_URI'])['path'];

   $route = 
   [
      '/' => 'controller/report.php',
      '/manageuser' => 'controller/manageuser.php',
      '/manageunits' => 'controller/manageunits.php',
      //'managedepartment' => 'controller/'
      '/manageproduct' => 'controller/manageproduct.php',
      '/adduser' => 'controller/adduser.php',
      '/managedepartment' => 'controller/managedepartment.php'
   ];

   function routeToController($url, $route){
      if(array_key_exists($url, $route)){
         require $route[$url];
      }else{
         abort();
      }
   }
   
   function abort($code = 404){
      http_response_code($code);
      require "views/{$code}.php";
      die();
   }
   routeToController($url, $route);