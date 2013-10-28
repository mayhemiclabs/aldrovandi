<?php
    $aldrovandi_post = "http://yourmanagementserver.example.net/rx_bugcatcher.php";

    header('Content-type: text/html');

    $addl_headers = "";

    foreach($_SERVER as $h=>$v)
        if(ereg('HTTP_(.+)',$h,$hp))
            $addl_headers .= "$h = $v\n";

    $bug_data = array (
        "BUG_REMOTE_HOST" => $_SERVER['REMOTE_HOST'],
        "BUG_REMOTE_ADDR" => $_SERVER['REMOTE_ADDR'],
        "BUG_USER_AGENT" => $_SERVER['HTTP_USER_AGENT'],
        "BUG_REQUESTED" =>  $_REQUEST['id'],
        "BUG_REQUEST_URI" => $_SERVER['REQUEST_URI'],
        "BUG_HEADERS" => $addl_headers
    );


    $ch = curl_init ($aldrovandi_post);
    curl_setopt ($ch, CURLOPT_POST, true);
    curl_setopt ($ch, CURLOPT_POSTFIELDS, $bug_data);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);

    $data = curl_exec ($ch);

?>
