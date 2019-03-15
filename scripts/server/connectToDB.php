<?php
/**
 * Created by IntelliJ IDEA.
 * User: entaro
 * Date: 15.03.19
 * Time: 10:57
 */

    $localhost = "OtVinta";
    $db = "PentaMailDB";
    $user = "admin";
    $password = "admin";

    $link = mysqli_connect($localhost, $user, $password) or
    trigger_error(mysql_error(),E_USER_ERROR);

    mysqli_query($link, "SET NAMES utf8;") or die(mysql_error());
    mysqli_query($link, "SET CHARACTER SET utf8;") or die(mysql_error());

    mysqli_select_db($link, $db);
