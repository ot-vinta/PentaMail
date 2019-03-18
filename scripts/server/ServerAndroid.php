<?php
/**
 * Created by IntelliJ IDEA.
 * User: entaro
 * Date: 17.03.19
 * Time: 21:55
 * method=Register&email=apan.kirill@penta.ru&password=admin&backupMail=apan.kirill@yandex.ru&phone=111111
 * method=Enter&email=test@penta.ru&password=admin
 */

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

$server = new Server();
$method = $_POST['method'];
if ($method == "Enter"){
    $email = $_POST["email"];
    $password = $_POST["password"];
    $result = $server->checkAccount($email, $password);
    echo $result;
}
elseif ($method == "Register"){
    $email = $_POST["email"];
    $password = $_POST["password"];
    $backupMail = $_POST["backupMail"];
    $phone = $_POST["phone"];
    $result = $server->createAccount($email, $password, $backupMail, $phone);
    if ($result == true){
	    echo "true";
    }
    else{
	    echo "false";
    }
}
