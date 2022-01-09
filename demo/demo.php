<?php
require_once "scraperClass.php";



try{
    //Use ure Credentials
    $Scraper=new scraperClass("localhost","root","","test");
}catch(Exception $e){
    die("ERROR: ".$e->getMessage());
}



try{
    // echo $Scraper->getUrl("https://kies-media.de/");
    echo $Scraper->getUrlByProxy("https://kies-media.de/",10);

}catch(Exception $e){
    die("ERROR: ".$e->getMessage());
}