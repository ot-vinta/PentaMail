<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <h1 align="center">Hello</h1>
        <?php
            $result = shell_exec("python ../server/python/test.py");
            echo $result;
        ?>
    </body>
</html>