<?php

class scraperClass
{
    var $DB = null;
    var $proxyList = null;
    var $proxyUsed = 0;


    function __construct($db_host = null, $db_user = null, $db_pass = null, $db_name = null)
    {
        if ($db_host !== null) {
            $this->DB = @new mysqli($db_host, $db_user, $db_pass, $db_name);
            // Check connection
            if ($this->DB->connect_error) {
                throw new Exception('Connection failed: ' . $this->DB->connect_error);
            }
        } 
    }


    private function getUrlFromCache($url)
    {
        if ($result = $this->DB->query("select html from cache where url='" . $this->DB->real_escape_string($url) . "' LIMIT 1")) {
            if ($result->num_rows == 1) {
                return $result->fetch_object()->html;
            } else {
                return false;
            }
        }
    }
    private function setUrlFromCache($url, $html)
    {
        $this->DB->query("insert into cache (url,html) values ('" . $this->DB->real_escape_string($url) . "','" . $this->DB->real_escape_string($html) . "')");
    }

    function getUrl($url = "")
    {
        if ($this->DB !== null) {
            $cache = $this->getUrlFromCache($url);
            if ($cache !== false) {
                return $cache;
            }
        }

        $data = file_get_contents($url, 0, stream_context_create(
            array(
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                ),
            )
        ));
        if ($this->DB !== null) $this->setUrlFromCache($url, $data);
        return $data;
    }

    function getUrlByProxy($url, $maxProxyTrys = 3)
    {
        if ($this->DB !== null) {
            $cache = $this->getUrlFromCache($url);
            if ($cache !== false) {
                return $cache;
            }
        }

        if ($this->proxyList === null) {
            $proxy = $this->getUrl("https://api.proxyscrape.com/v2/?request=displayproxies&protocol=http&timeout=1000&country=all&ssl=all&anonymity=all");
            $this->proxyList = explode("\n", $proxy);
            $this->proxyUsed = rand(0, sizeof($this->proxyList));
        }

        do {
            $cxContext = stream_context_create([
                'http' => array(
                    'proxy'           => 'tcp://' . $this->proxyList[$this->proxyUsed],
                    'request_fulluri' => true,
                    'timeout' => 5,
                    'follow_location' => true
                ),
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                ),
            ]);

            $data = @file_get_contents($url, False, $cxContext);
            if ($data !== false) {
                if ($this->DB !== null) $this->setUrlFromCache($url, $data);
                return $data;
            } else {
                $maxProxyTrys--;
                $this->proxyUsed = ($this->proxyUsed + 1) % sizeof($this->proxyList);
            }
        } while ($maxProxyTrys > 0);
        throw new Exception('Reached maximum trys!',101);
    }
}
