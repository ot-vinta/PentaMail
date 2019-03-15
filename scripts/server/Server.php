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
        $localhost = "OtVinta";
        $db = "PentaMailDB";
        $user = "admin";
        $password = "admin";

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
                return true;
            }
            else {
                return false;
            }
        }
    }
}