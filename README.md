# Scraper-Class
Very basic scraping-class to get Url-Content by  public Proxys
Look demo.php on how to use.
The main advantage is, that 
* u dont need to search for proxy-lists. Its done by the Class itself.
* https makes no problems

## Prerequisite
* file_get_contents is active on your webserver (normaly the case)
 
## Install with Composer
```composer
composer require kies-media/scraper-class
```
if you want to use caching (and u should), then u have to create table from /src/cache.sql

## Basic Usage
```php
<?php
require __DIR__ . '/vendor/autoload.php';
$scraper=new \KiesMedia\ScraperClass\scraperClass();
try{
    echo $scraper->getUrlByProxy("https://kies-media.de/");
}catch(Exception $e){
    echo $e->getMessage();
}
```
## Basic Usage Cache
```php
<?php
require __DIR__ . '/vendor/autoload.php';
$scraper=new \KiesMedia\ScraperClass\scraperClass("localhost","root","pass","databasename");
try{
    echo $scraper->getUrlByProxy("https://kies-media.de/",10);
}catch(Exception $e){
    echo $e->getMessage();
}
```

# Known Issues / place for improvement
* Cache not deleteable right now
* no unittests at the moment

# Thanks
to proxyscrape.com for providing public proxy-list
