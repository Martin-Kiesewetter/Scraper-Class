# Scraper-Class
Scraping Class to get Url-Content by  public Proxys
Look demo.php on how to use.

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
