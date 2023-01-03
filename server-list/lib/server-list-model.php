<?php
class ServerListModel
{
    /**
     * The server list from the master server
     *
     * @var object $serverList
     */
    protected $serverList = null;

    public function __construct()
    {
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
     * Get the server list from the master server
     * 
     * @return object $serverList
     */
    public function getServerList () {
        $this->updateServerList();
        
        return $this->serverList;
    }
}
?>