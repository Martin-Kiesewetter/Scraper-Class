# Scraper-Class
Very basic scraping-class to get Url-Content by  public Proxys
Look demo.php on how to use.

## Install
+ Download Code
+ Include to your Code
+ if you want to use Cache: add database schema: cache.sql to your MySQL Server and insert credentials as construcor-parameters.

## Basic Usage
```php
$Scraper=new scraperClass();
echo $Scraper->getUrlByProxy("https://kies-media.de/");
```
## Basic Usage Cache
```php
$Scraper=new scraperClass("localhost","root","","test");
echo $Scraper->getUrlByProxy("https://kies-media.de/");
```

Known Problems:
* Cache not deleteable right now
