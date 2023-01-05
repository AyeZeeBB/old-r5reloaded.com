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
        // TODO: change it so it doesn't use file_get_contents but curl instead
        $data = file_get_contents(
            "http://ip-api.com/json/{$ip}?fields=continentCode,continentName,continent"
        );

        // If the API returns an error, return an empty object
        return json_decode(
            $data ? $data : '{}'
        );
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