<?php
class Config {
    /**
     * This is the array of development urls
     * 
     * @var array
     */
    public $developmentUrls = array(
        'localhost',
        '127.0.0.1',
        '::1'
    );

    /**
     * This is the array of frontend scripts
     * to include at the bottom of the body
     * 
     * @var array
     */
    public $frontendScripts = array();


    public function __construct() {

        // check if address is using https or http
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
            $urlPrefix = 'https://';
        } else {
            $urlPrefix = 'http://';
        }

        // check if the server is running on localhost
        if (in_array($_SERVER['SERVER_NAME'], $this->developmentUrls)) {

            // get the url suffix for the local hosting
            // example: http://localhost/{suffix}/r5reloaded.com
            $url = $_SERVER['REQUEST_URI'];
            $urlChunks = explode('/', $url);

            $urlSuffix = '';

            foreach ($urlChunks as $chunk) {
                // skip if the chunk is empty
                if ($chunk == '') {
                    continue;
                }

                // break if the chunk is the website name
                if ($chunk == 'r5reloaded.com') {
                    break;
                }

                // add the chunk to the url suffix
                $urlSuffix .= '/' . $chunk;
            }

            // this is a local website url
            define('SERVERPATH', $urlPrefix . $_SERVER['SERVER_NAME'] . $urlSuffix . '/r5reloaded.com');
        } else {
            // this is the website url
            define('SERVERPATH', $urlPrefix . $_SERVER['SERVER_NAME']);
        }

        // this is the path to the root folder
        define('ROOTPATH', dirname(__FILE__));

        // this is url to the public folder
        define('PUBLICPATH', SERVERPATH . '/public');
        // this is the path to the public folder
        define('RPUBLICPATH', ROOTPATH . '/public');

        // this is url to the components folder
        define('COMPONENTSPATH', SERVERPATH . '/components');
        // this is the path to the components folder
        define('RCOMPONENTSPATH', ROOTPATH . '/components');

        // this is url to the styles folder
        define('STYLESPATH', SERVERPATH . '/styles');
        // this is the path to the styles folder
        define('RSTYLESPATH', ROOTPATH . '/styles');

        // this is url to the lib folder
        define('LIBPATH', SERVERPATH . '/lib');
        // this is the path to the lib folder
        define('RLIBPATH', ROOTPATH . '/lib');

        // this is url to the cache folder
        define('CACHEPATH', SERVERPATH . '/.cache');
        // this is the path to the cache folder
        define('RCACHEPATH', ROOTPATH . '/.cache');

        // this is url to the logs folder
        define('LOGPATH', SERVERPATH . '/log');
        // this is the path to the logs folder
        define('RLOGPATH', ROOTPATH . '/log');


        // Modules ----------------------------------------

        //this is url to the server-list module
        define('SERVERLISTPATH', SERVERPATH . '/server-list');
        // this is the path to the server-list module
        define('RSERVERLISTPATH', ROOTPATH . '/server-list');

        // Setters ----------------------------------------

        // Create log folder if it doesn't exist
        if (!file_exists(RLOGPATH)) {
            mkdir(RLOGPATH, 0777, true);
        }
    }

    /**
     * This function adds a frontend script to the array
     * 
     * @param string $scriptPath
     * @return void
     */
    public function addFrontendScript($scriptPath) {
        $this->frontendScripts[] = $scriptPath;
    }

    /**
     * This function returns the array of frontend scripts
     * 
     * @return array
     */
    public function getFrontendScripts() {
        return $this->frontendScripts;
    }
}

$CONFIG = new Config();

?>