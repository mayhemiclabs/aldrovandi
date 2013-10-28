<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/libs/db.inc.php');

    $query = $sql->prepare("SELECT bug_name,bug_type,bug_createdby,bug_createdat FROM bugs_created ORDER BY bug_createdat DESC LIMIT 5") or die (parent::$sql->error);
    $query->execute() or die("Error");
    $query->bind_result($bug_name,$bug_type,$bug_createdby,$bug_createdat);
?>

                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Type</th>
                                                <th>Created By</th>
                                                <th>Date & Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php
    while($bugs = $query->fetch()){
?>
                                            <tr>
                                                <td><?php print $bug_name;?></td>
                                                <td><?php print $bug_type;?></td>
                                                <td><?php print $bug_createdby;?></td>
                                                <td><?php print $bug_createdat;?></td>
                                            </tr>
<?php
    }
?>
                                        </tbody>
                                    </table>
