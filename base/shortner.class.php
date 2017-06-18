<?php
   require_once('dbConnection.class.php');
   class Shortner{
      private $link; 
      private $short_url_length;
      private $custom_domain_name;

      //constructor connecting to database
      public function __construct(){
         $dbConnection = new dbConnection();
         $this->link = $dbConnection->connect();   
         return $this->link;
      }

      //function creating table 
      private function createTable(){
         try { 
            $query = $this->link->query("CREATE TABLE IF NOT EXISTS `shortner`(`id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,`url` TEXT, `short_url` VARCHAR(18))");
         }catch(Exception $ex) {
            return $ex->getMessage();
         }
      }

      //function to initialize system
      public function init($short_url_length=9,$custom_domain_name='adams'){
         $this->set_short_url_length($short_url_length);
         $this->set_custom_domain_name($custom_domain_name);
         $this->createTable(); // Creating table
      }

      //function for setting short url length
      public function set_short_url_length($length=9){
         if(strlen($length)>15)
            echo 'Short url can\'t be greater than 18';
         else
            $this->short_url_length = $length;
      }

      /**
       * [getOptions getting available options]
       * @return {string} [printing options]
       */
      public function getOptions(){
         echo 'Custom domain name: '.$this->custom_domain_name.'</br>';
         echo 'Short url length: '.$this->short_url_length;
      }

      /**
       * [set_custom_domain_name For setting custom domain]
       * @param {string} $custom_domain [custom vision name]
       */
      public function set_custom_domain_name($custom_domain='adams'){
         $this->custom_domain_name = $custom_domain;
      }

      /**
       * [decodeURL To get real url]
       * @param  {string} $short_url [The short url]
       * @return {string|0}           [url is returned when query is not 0]
       */
      public function decodeURL($short_url){
          try { 
            $query = $this->link->query("SELECT url FROM `shortner` WHERE `short_url`='$short_url'");
            if($query->rowCount()==0)
               return 0;
            else
               return $query->fetch(PDO::FETCH_ASSOC);
         }catch(Exception $ex) {
            return $ex->getMessage();
         }
      }

      /**
       * [get_short_url To get short url after shortening]
       * @param  {string} $url [the url]
       * @return {string}      [the short url if successful]
       */
      public function get_short_url($url){
         try { 
            $query = $this->link->query("SELECT short_url FROM `shortner` WHERE `url`='$url'");
            if($query->rowCount()==0)
               return 0;
            else
               return $query->fetch(PDO::FETCH_ASSOC)['short_url'];
         }catch(Exception $ex) {
            return $ex->getMessage();
         }
      }

      /**
       * [validateURL checking if URL is entered or if a valid URL was entered]
       * @param  {url} $url [the url]
       * @return {boolean}      
       */
      private function validateURL($url){
         if(strlen($url) != 0 ){
            if(filter_var($url,FILTER_VALIDATE_URL))
               return true;
            else
               return false;
         }else{
            return false;
         }
      }

      /**
       * [URLExist Checking if url already have been shortned]
       * @param  {string} $url [The url]
       * @return {boolean}      [Returns true if url exist,false when doesn't exist]
       */
      private function URLExist($url){
         try { 
            $query = $this->link->query("SELECT url FROM `shortner` WHERE `url`='$url'");
            if($query->rowCount())
               return true;
            else
               return false;
         }catch(Exception $ex) {
            return $ex->getMessage();
         }
      }
      
      /**
       * [generate_short_url Genrates short url from by shuffling chars]
       * @param  {string} $url [the url]
       * @return {string}      [the short url]
       */
      private function generate_short_url($url){
         $chars  =  '0123456789abcdefghijklmnopqrxyzABCDEFGHIJKLMNOPQRXYZiizzxx';
         if(strlen($this->custom_domain_name) > 0)
            return substr(str_shuffle($chars),3,$this->short_url_length).'.'.$this->custom_domain_name; 
         else
            return substr(str_shuffle($chars),3,$this->short_url_length);
      }

      /**
       * function to store url
       *@param {string} $url [url that must be shortned]
       *@return {null} [returns nothing, insert url and short url into table `shortner`]
       */
      private function storeURL($url,$short_url){
         try { 
            $query = $this->link->prepare("INSERT INTO `shortner`(url,short_url) VALUES(?,?)");
            $values = array($url,$short_url);
            $query->execute($values);
         }catch(Exception $ex) {
            return $ex->getMessage();
         }
      }

      /**
       * Function to called to short url
       * @param  {string} $url [url that must be shortned]
       * @return {string}      [Message]
       */
      public function shortURL($url){
         if(!$this->URLExist($url)){
            if($this->validateURL($url)){
               $short_url = $this->generate_short_url($url);
               $this->storeURL($url,$short_url);
            }else
               echo 'No URL has been submitted yet or an invalid URL is subitted</br>';
         }else
            echo 'URL has already been shortend</br>';
      }


   }
?>
