![Shorty](https://github.com/asadadams/Shorty/blob/master/logo.png)

# Shorty v 0.0.1
shorty is a PHP URL shortner. This program was designed to help shorten long URLs to shorter ones . Shorty is built in PHP. 

## Overview
This is a progam is made/designed to shorten long URLs into short urls. This program is divided into two parts:
* **part to shorten long URLs into shorter URLs**
* **part to provide to original URLs from shorter ones** 

## Getting Started
   You will need a server running APACHE and MYSQL database. Configure database in the *config.php*
   ```
      <?php
         define("DB_HOST","localhost"); //Databse host name 
         define("DB_USERNAME","root"); // Database username , mostly root on localhost 
         define("DB_PASSWORD","");  //Databse password
         define("DB_NAME","shortit");  //Database name 

   ```

## Usage
Shorty works by first initializing the program from a function *init* in the Shorty Class

```
   $shortner->init(); //initializing class
   $shortner->shortURL($url);//calling function to shorten url

```

### Example of usage
#### Shortning URL

```
   <?php
      require_once('config.php');  // config file 
      require_once('base/dbConnection.class.php'); // Database connection class
      require_once('base/shortner.class.php'); // Shortner class

      $shortner = new Shortner(); // an instance of Shortner class
      
      $shortner->init(); //Shorty must always be initialized first
      $shortner->set_short_url_length(12);
      $shortner->set_custom_domain_name('co');  

      $url = "http://www.raadyo.com/about"; 

      $shortner->shortURL($url);//calling function to shorten url
      echo $shortner->get_short_url($url); // Showing options

```
### Getting original URL
Getting shortend url in a get request 

```
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

```

### Functions
Shorty have these functions  
* **init** - initialize Shorty (init have two optional parameters,url_length(int) and custom_domain_name(string))
* **set_short_url_length** - set the length for short url to be produced
* **set_custom_domain_name** - set the domain at the end of the short url (eg. com)
* **getOptions** - get properties:url length and domain name currently set
* **get_short_url** - get short URL after shortning
* **ShortURL** - to short URL
* **decodeURL** - get original URL


## Developers
If you are a developer feel free to contribute the project by providing bug fixes, new ideas and suggestions. 
Will 
*NB: Shorty is a program i wrote out of boredom on a sunday afternoon in a few minutes, :laughing: :stuck_out_tongue_winking_eye: (needed something to do). So will like it if y'all can contribute and add more features*

## Me
Want to say hi? Will be happy to hear from you
* [Twitter](http:///www.twitter.com/asadadams)
* [Facebbok](http://www.facebook.com/asad.adams)
* [Instagram](http://www.instagram.com/asadadams)
* [Linkedin](http://www.linkedin.com/in/asad-adams-7548a4104/)
* [Mail](clarkpeace.adams@gmail.com)
