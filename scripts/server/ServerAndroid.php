<?php
/**
 * Created by IntelliJ IDEA.
 * User: entaro
 * Date: 17.03.19
 * Time: 21:55
 */
$server = new Server();
$method = $_POST['method'];
if ($method == "Enter"){
    $email = $_POST["email"];
    $password = $_POST["password"];
    $result = $server->checkAccount($email, $password);
}
elseif ($method == "Register"){
    $email = $_POST["email"];
    $password = $_POST["password"];
    $backupMail = $_POST["backupMail"];
    $phone = $_POST["phone"];
    $result = $server->createAccount($email, $password, $backupMail, $phone);
    echo $result;
}