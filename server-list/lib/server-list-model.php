<?php
include_once '../../config.php';
include_once RSERVERLISTPATH.'/lib/ip-to-region-model.php';
include_once RLIBPATH.'/cache-model.php';

class ServerListModel
{
    /**
     * Ip to region model
     *
     * @var object $ipToRegionModel
     */
    private $ipToRegionModel;

    /**
     * The server list from the master server
     *
     * @var object $serverList
     */
    protected $serverList = null;

    /**
     * Cache model
     * 
     * @var object $cache
     */
    private $cache;

    public function __construct()
    {
        var_dump(RCACHEPATH);
        $this->cache = new CacheModel([
            'name' => __CLASS__, // Set the cache name to the class name
            'path' => RCACHEPATH.'/',
            'extension' => '.json'
        ]);
        $this->ipToRegionModel = new IpToRegionModel();
        $this->updateServerList();
    }

    /**
     * Update the server list from the master server
     *
     * @return void
     */
    private function updateServerList () {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://ms.r5reloaded.com/servers");
        curl_setopt($ch, CURLOPT_POST, 1);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, "key=1234567890");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $serverList = curl_exec($ch);
        curl_close($ch);
        $this->serverList = json_decode($serverList);
    }

    /**
     * Set the server list
     *
     * @param string $servers
     * @param object $value
     */
    public function __set($servers, $value) {
        $this->serverList->servers = $value;
    }

    /**
     * Get the server list
     *
     * @param string $servers
     * @return void
     */
    public function __get($servers) {
        return $this->serverList->servers;
    }

    /**
     * Convert the server IPs to regions
     *
     * @return void
     */
    private function convertServerIpsToRegions () {
        $servers = $this->servers;

        foreach ($servers as $key => $server) {
            $servers[$key]->region = $this->ipToRegionModel->getContinent($server->ip);
            $servers[$key]->regionName = $this->ipToRegionModel->getContinent($server->ip, true);

            // Remove the IP from the server list
            unset($servers[$key]->ip);
        }
        
        $this->servers = $servers;
    }

    /**
     * Cache the server list for 2 seconds
     *
     * @param [type] $serverList
     * @return void
     */
    private function cacheServerList ($serverList) {
        $this->cache->store('server-list', $serverList, 2);
    }

    private function getServerListFromCache () {
        $this->cache->eraseExpired();
        return $this->cache->retrieve('server-list');
    }

    /**
     * Get the server list from the master server
     * 
     * @return object $serverList
     */
    public function getServerList () {

        // If the server list is cached, return the cached value
        if (!is_null($this->getServerListFromCache())) {
            $cachedserverList = $this->getServerListFromCache();
            $cachedserverList->cached = true;
            return $cachedserverList;
        }
        
        $this->updateServerList();
        $this->convertServerIpsToRegions();

        $serverList = $this->serverList;

        // Cache the server list
        $this->cacheServerList($serverList);
            
        $serverList->cached = false;

        return $serverList;
    }
}

?>