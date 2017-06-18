<?php
   require_once('config.php');  // config file 
   require_once('base/dbConnection.class.php'); // Database connection class
   require_once('base/shortner.class.php'); // Shortner class

   $shortner = new Shortner(); // an instance of Shortner class
   
   $shortner->init();
   $shortner->set_short_url_length(12); 

   $url = "http://www.raadyo.com/about";

   $shortner->shortURL($url);//calling function to shorten url
   echo $shortner->get_short_url($url); // Showing options