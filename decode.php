<?php
   if(isset($_GET['surl'])){
      require_once('config.php');  // config file 
      require_once('base/shortner.class.php'); // Shortner class
      $shortner = new Shortner(); // an instance of Shortner class

      $short_url = $_GET['surl'];

      if($shortner->decodeURL($short_url)!=0){
         $url = $shortner->decodeURL($short_url)['url'];
         header("Location: $url");
      }else{
         //Redirect to a 404;
         //die("<script>location.href = '404.php'</script>");
      }
   }else{
      echo 'NO short URL submitted';
      //Redirect to a 404;
      //die("<script>location.href = '404.php'</script>");
   }