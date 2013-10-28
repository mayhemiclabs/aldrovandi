<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/libs/db.inc.php');

$requested_bug = strip_tags($_REQUEST['BUG_REQUESTED']);

$query = $sql->prepare("SELECT bug_name FROM bugs_created WHERE bug_name=?");
$query->bind_param("s", $requested_bug);
$query->execute() or die("Error");
$query->store_result();

if ($query->num_rows > 0){
    $insert_query = $sql->prepare("INSERT INTO captured_events(first_seen, bug_name, captured_ip, captured_rdns, captured_useragent, captured_headers) VALUES (NOW(), ?, ?, ?, ?, ?)");
    $insert_query->bind_param("sssss", $requested_bug, strip_tags($_REQUEST['BUG_REMOTE_ADDR']),  strip_tags($_REQUEST['BUG_REMOTE_HOST']),  strip_tags($_REQUEST['BUG_USER_AGENT']),  strip_tags($_REQUEST['BUG_HEADERS']));
    $insert_query->execute();

    $email_query = $sql->prepare("SELECT email FROM users WHERE rx_alerts=1") or die (parent::$sql->error);
    $email_query->execute() or die("Error");
    $email_query->bind_result($email);

    while($email_query->fetch()){

        $message = "Web Bug Accessed!\n\n";
        $message .= 'The "' . $requested_bug . '" was accessed ' .  date(DATE_RFC2822) . " by the following host:\n\n";
        $message .= '* ' . strip_tags($_REQUEST['BUG_REMOTE_HOST']) . " (" . strip_tags($_REQUEST['BUG_REMOTE_ADDR']) . ")\n\n";
        $message .= "User Agent: " . strip_tags($_REQUEST['BUG_USER_AGENT']);

        mail($email, "Aldrovandi Alert - " . $requested_bug , $message, "From: Aldrovandri Web Bug System <" . $config["ALERT_ADDR"] . ">");

    }
}else{

    openlog("aldrovandi", LOG_PID, LOG_LOCAL0);
    syslog(LOG_WARNING, "Error: Invalid webbug '$requested_bug' from " . strip_tags($_REQUEST['BUG_REMOTE_ADDR']) . " User Agent: '" . strip_tags($_REQUEST['BUG_USER_AGENT']) . "'");
    closelog();

}

?>
