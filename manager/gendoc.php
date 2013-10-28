<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/libs/db.inc.php');

session_start();

if (!isset($_SESSION['username'])){
    exit();
}

$name = strip_tags($_REQUEST["name"]);
$description = strip_tags($_REQUEST["description"]);

$query = $sql->prepare("INSERT INTO bugs_created(bug_name, bug_type, bug_description, bug_createdby, bug_createdat) VALUES(?,'Word Document',?,?,NOW())");
$query->bind_param("sss", $name, $description, strip_tags($_SESSION['username']));
$query->execute() or die("Error");

header('Content-Type: application/msword');
header('Content-Disposition: attachment; filename="' . $name . '.doc"');
?>
<html>

<LINK REL="stylesheet" HREF="<?php print $config["BUGCATCHER_URL"];?><?php print $name; ?>/word.css">
Here is your <?php print $name; ?> document, please open a text editor to edit this text.
</html>

