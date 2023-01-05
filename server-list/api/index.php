<?php
    include_once '../../config.php';

    // Load the server list model
    require_once RLIBPATH."/server-list-model.php";

    // Get the server list
    $serverListModel = new ServerListModel();
    $serverList = $serverListModel->getServerList();

    // Return the server list as JSON
    header('Content-type: application/json');
    print json_encode($serverList);

?>