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
        $user = "root";
        $password = "asdVBNjkl465";

        $this->link = mysqli_connect($localhost, $user, $password) or
                      trigger_error(mysql_error(),E_USER_ERROR);

        mysqli_query($this->link, "SET NAMES utf8;") or die(mysql_error());
        mysqli_query($this->link, "SET CHARACTER SET utf8;") or die(mysql_error());

        mysqli_select_db($this->link, $db);
    }

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

    function createAccount($email, $password, $backupMail, $phone){
        $open_key = 1;
        $secret_key = 1;
        $query = "INSERT INTO Пользователи (Email, Пароль, Резервная_почта, Открытый_ключ, Закрытый_ключ, Уровень_доступа, Телефон) 
                  VALUES('$email', '$password', '$backupMail', '$open_key', '$secret_key', 'u', '$phone')";
        $result = mysqli_query($this->link, $query);
        return $result;
    }
}