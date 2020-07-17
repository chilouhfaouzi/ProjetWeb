<?php
   
   include "connect.php";  //include connect to database
  // Routes (lmassarat) 
  $pathprojet="C:/wamp64/www/Projet_tp4/";
  $fnc ="includes/functions/";  //Functions Directory
  $tpl ="includes/templates/";  //templates Directory
  $css ="layout/css/";  //css Directory
  $js="layout/js/"  ;//js Directory
  include $fnc.'Functions.php';
  
  
  include $tpl.'header.php'; 
 


  if(!isset($nonavbar)) {
    include $tpl.'navbar.php'; 
  }
  
?>