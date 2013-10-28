<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/libs/db.inc.php');

    if (!is_numeric($_REQUEST['num'])){
        $limit = 5;
    }elseif ($_REQUEST['num'] > 25){
        $limit = 5;
    }else{
        $limit = $_REQUEST['num'];
    }

    $query = $sql->prepare("SELECT first_seen,bug_name,captured_ip,captured_useragent FROM captured_events ORDER BY first_seen DESC LIMIT ?") or die (parent::$sql->error);
    $query->bind_param("i",$limit);
    $query->execute() or die("Error");
    $query->bind_result($first_seen, $bug_name, $captured_ip, $captured_useragent);
?>

                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Date & Time</th>
                                                <th>IP Address</th>
                                                <th>Document Accessed</th>
                                                <th>Office Version</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php
    while($query->fetch()){

        if (strpos($captured_useragent, 'ms-office; MSOffice 15)') !== false){
            $version = 'Office 2013';
        }else{
            $version = 'Unknown';
        }
?>
                                            <tr>
                                                <td><?php print $first_seen;?></td>
                                                <td><?php print $captured_ip;?></td>
                                                <td><?php print $bug_name;?></td>
                                                <td><?php print $version;?></td>
                                            </tr>
<?php
    }
?>
                                        </tbody>
                                    </table>
