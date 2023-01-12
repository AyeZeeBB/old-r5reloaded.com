<?php

require_once '../../config.php';
require_once RLIBPATH.'/cache-model.php';


/**
 * Ip to region model
 * 
 * @author dudematthew
 * @since 2023-01-05
 */
class IpToRegionModel {

    /**
     * Cache model
     *
     * @var object $cache
     */
    private $cache;

    public function __construct() {
        $this->cache = new CacheModel([
            'name' => __CLASS__, // Set the cache name to the class name
            'path' => RCACHEPATH.'/',
            'extension' => '.json'
        ]);
    }

    /**
     * Get region from ip address
     *
     * @param string $ip
     * @return void
     */
    private function getContinentFromApi ($ip) {
        // If the API is blocked, return an empty object

        if ($this->isApiBlocked()) {
            return json_decode('{}');
        }

        // Get the region from the API using curl
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://ip-api.com/json/{$ip}?fields=continentCode,continentName,continent");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        $response = curl_exec($ch);
        curl_close($ch);

        // Get the HTTP status code
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // Get the header
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($response, 0, $header_size);

        // Split the header into chunks
        $headerChunks = preg_split("@[\s+　]@u", trim($header));;

        // Get the position of the X-TTL and X-Rl headers
        $XrlPos = array_search('X-Rl:', $headerChunks);
        $XttlPos = array_search('X-Ttl:', $headerChunks);

        // X-Rl contains the number of requests remaining in the current minute
        $Xrl = $headerChunks[$XrlPos + 1] ?? 0;
        // X-Ttl contains the number of seconds until the current minute is over
        $Xttl = $headerChunks[$XttlPos + 1] ?? 0;

        // Get the data from the response
        $data = substr($response, $header_size);

        
        // If the API returns a 429 error, block the API for a minute
        if ($http_status === 429 || $Xrl == 0) {
            // Log the error
            error_log("IpToRegionModel: API blocked for {$Xttl} seconds\n", 3, RLOGPATH.'/warning.log');


            $this->cache->store('blocked', true, $Xttl);
            return json_decode('{}');
        }

        // If the API returns an error, return an empty object
        return json_decode(
            $data ? $data : '{}'
        );
    }

    /**
     * Check if the API is blocked
     * 
     * @return bool
     */
    public function isApiBlocked () {
        $this->cache->eraseExpired();
        return $this->cache->retrieve('blocked') ? true : false;
    }

    /**
     * Get region from ip address
     * 
     * @param string $ip
     * @param bool $fullName If true, return 
     * the full name of the region (default: false)
     * @return string $region
     */
    public function getContinent ($ip, $fullName = false) {

        // If the IP is invalid, return '?'
        if (ip2long($ip) === false) {
            return "?";
        }

        // If the IP is in the cache, set the region to the cached value
        if (!is_null($this->cache->retrieve($ip))) {
            $data = $this->cache->retrieve($ip);
        }
        else
            $data = $this->getContinentFromApi($ip);

        // If the API returns an empty data, return '?'
        if (!isset($data->continent, $data->continentCode)) {
            return "?";
        }

        $this->cacheContinent($ip, $data);

        return $fullName ? $data->continent : $data->continentCode;
    }

    /**
     * Cache region
     *
     * @param string $ip
     * @param object $region
     * @return void
     */
    private function cacheContinent ($ip, $data) {
        // Cache the region for 10 days
        $this->cache->store($ip, $data, 864000);
    }
}

?>