# Scraper-Class
Very basic scraping-class to get Url-Content by  public Proxys
Look demo.php on how to use.
The main advantage is, that 
* u dont need to search for proxy-lists. Its done by the Class itself.
* https makes no problems

## Prerequisite
* file_get_contents is active on your webserver (normaly the case)
 
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

# Known Problems
* Cache not deleteable right now

# Thanks
to proxyscrape.com for providing public proxy-list
