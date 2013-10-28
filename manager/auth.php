<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/libs/PasswordHash.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/libs/db.inc.php');

session_start();

if (isset($_SESSION['username'])){
   header('Location: /') ;
}

$pwdHasher = new PasswordHash(8, FALSE);

$username = $sql->real_escape_string($_REQUEST["username"]);
$password = $sql->real_escape_string($_REQUEST["password"]);

$passhash = $pwdHasher->HashPassword($password);

if ($stmt = mysqli_prepare($sql, "SELECT password FROM users WHERE username=?")) {

    $stmt->bind_param("s", $username);
    $stmt->execute();

    $stmt->bind_result($storedhash);
    $stmt->fetch();

    $stmt->close();

    // $hash would be the $hashed stored in your database for this user
    if($pwdHasher->CheckPassword($password, $storedhash)){
        $_SESSION['username'] = $username;
    }

    header('Location: /') ;
}


?>
