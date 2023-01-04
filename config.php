<?php
    // this is the array of development urls
    $developmentUrls = array(
        'localhost',
        '127.0.0.1',
        '::1'
    );

    // check if address is using https or http
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
        $urlPrefix = 'https://';
    } else {
        $urlPrefix = 'http://';
    }
    
    // check if the server is running on localhost
    if (in_array($_SERVER['SERVER_NAME'], $developmentUrls)) {
        // this is localhost website url
        define('SERVERPATH', $urlPrefix . $_SERVER['SERVER_NAME'] . '/r5reloaded.com');
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
?>