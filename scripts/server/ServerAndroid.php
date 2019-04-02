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
$method = $_POST['method'];
switch ($method) {
    case "Enter":
        $email = $_POST["email"];
        $password = $_POST["password"];
        $result = $server->checkAccount($email, $password);
        echo $result;
        break;
    case "Register":
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
        break;
    case "GetMessages":
        $email = $_POST['email'];
        $folder = $_POST['folder'];
        $server->getMessages($email, $folder);
        break;
    case "SendMessage":
        $title = $_POST['title'];
        $content = $_POST['content'];
        $sender = $_POST['sender'];
        $receiver = $_POST['receiver'];
        $result = $server->sendMessage($title, $content, $sender, $receiver);
        echo $result;
        break;
    case "AddFolder":
        $title = $_POST['title'];
        $email = $_POST['email'];
        $result = $server->addFolder($title, $email);
        echo $result;
        break;
    case "GetFolders":
        $email = $_POST['email'];
        $server->getFolders($email);
        break;
    default:
        break;
}
