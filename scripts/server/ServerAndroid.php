<?php
/**
 * Created by IntelliJ IDEA.
 * User: entaro
 * Date: 17.03.19
 * Time: 21:55
 */

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

$server = new Server();
$method = $_GET['method'];
if ($method == "Enter"){
    $email = $_POST["email"];
    $password = $_POST["password"];
    $result = $server->checkAccount($email, $password);
    echo $result;
}
elseif ($method == "Register"){
    $email = $_GET["email"];
    $password = $_GET["password"];
    $backupMail = $_GET["backupMail"];
    $phone = $_GET["phone"];
    $result = $server->createAccount($email, $password, $backupMail, $phone);
    if ($result == true){
	    echo "true";
    }
    else{
	    echo "false";
    }
}
