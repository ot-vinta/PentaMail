<?php
/**
 * Created by IntelliJ IDEA.
 * User: entaro
 * Date: 15.03.19
 * Time: 10:49
 */

class Server
{
    private $link = "";

    #constructor
    function __construct()
    {
        $localhost = "localhost";
        $db = "PentaMailDB";
        $user = "admin";
        $password = "admin";

        $this->link = mysqli_connect($localhost, $user, $password) or
                      trigger_error(mysql_error(),E_USER_ERROR);

        mysqli_set_charset($this->link, "utf8");

        mysqli_query($this->link, "SET NAMES utf8;") or die(mysql_error());
        mysqli_query($this->link, "SET CHARACTER SET utf8;") or die(mysql_error());

        mysqli_select_db($this->link, $db);
    }

    #verify account
    function checkAccount($email, $password){
        if(($email) &&($password))
        {
            $query = "SELECT * FROM Пользователи WHERE Email = '$email' 
                                                 AND Пароль = '$password'";
            $send_query = mysqli_query($this->link, $query);
            $count = mysqli_num_rows($send_query);
            if ($count > 0) {
                return "true";
            }
            else {
                return "false";
            }
        }
    }

    #create new account
    function createAccount($email, $password, $backupMail, $phone){
        $open_key = 1;
        $secret_key = 1;
        $query = "INSERT INTO Пользователи (Email, Пароль, Резервная_почта, Телефон, Открытый_ключ, Закрытый_ключ, Уровень_доступа) 
                  VALUES('$email', '$password', '$backupMail', '$phone', '$open_key', '$secret_key', 'u')";
        $result = mysqli_query($this->link, $query);
        $folderNewResult = $this->createFolder("Новые", $email);
        $folderGotResult = $this->createFolder("Прочитанные", $email);
        $folderSentResult = $this->createFolder("Отправленные", $email);
        $folderSpamResult = $this->createFolder("Спам", $email);
        $name="Новые";
        $query = "SELECT Id FROM Папки WHERE Email_пользователя = '$email' AND Название = '$name'";
        $folderResult = mysqli_query($this->link, $query);
        $folderId = mysqli_fetch_array($folderResult);
        $welcomeMessageResult = $this->createMessage("Добро пожаловать!",
                                                    "Рады приветствовать вас в нашей Пента.Почте",
                                                            $email,
                                                 "Администрация Пента.Почты",
                                                            $folderId['Id'],
                                                       "1111111");
        return $result;
    }

    #create new folder
    function createFolder($name, $email){
        $query = "INSERT INTO Папки (Id, Название, Email_пользователя) VALUES (NULL, '$name', '$email')";
        $result = mysqli_query($this->link, $query);
        return $result;
    }

    #create new message
    function createMessage($name, $content, $receiverEmail, $senderEmail, $folderId, $EDS){
        echo $name;
        echo $content;
        echo $receiverEmail;
        echo $senderEmail;
        echo $folderId;
        $query = "INSERT INTO Сообщения (Id, Заголовок, Содержимое, Дата_отправления, Получатель, Отправитель, id_папки, ЭЦП)
                         VALUES(NULL, '$name', '$content', NOW(), '$receiverEmail', '$senderEmail', '$folderId', '$EDS')";
        $result = mysqli_query($this->link, $query);
        return $result;
    }
}