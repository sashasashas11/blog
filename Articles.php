<?php
session_start();
include 'DBHelper.php';
include 'addFile.php';
DBHelper::createServerConnection();
DBHelper::connectToDB();
$current_time = date("H:i:s");
$current_date = date("Y.m.d");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
            <title></title>
    </head>
    <body>
        <a href='index.php'>Главная страница</a>
        <h1>Добавление статьи</h1>
        <form id="form1" action="#" method="post" enctype="multipart/form-data">
            <p class="login">
                <label for="inputtext1">Название<br></label>
                <input id="inputtext2" name="title" type="text" size="50" maxlength="50">
            </p>

            <SELECT NAME="myselect">
                <?php
                $result = DBHelper::getCategory();
                while ($row = mysql_fetch_array($result)) {
                    echo '<OPTION >' . $row["name"] . '</option>';
                }
                ?>
            </select>

            <p class="login">
                <label for="inputtext1">Краткое описания:<br></label>
                <textarea name="description" placeholder="Краткое описания:" rows="5" cols="40"> </textarea>
            </p>

            <p class="login">
                <label for="inputtext1">Полное описания:<br></label>
                <textarea name="text" placeholder="Текст" rows="5" cols="40"> </textarea>
            </p>
            <input type="file" name="filename"><br> 
                    <input type="submit" value="Отправить"  /> 
                    </form>
                    
                    <?php
                    if ($_POST["description"] == ' ' or $_POST["title"] == '' or $_POST["text"] == ' ') {
                        echo 'не все поля заполнены';
                        
                    } 
                    else {
                        Addfile(img);
                        DBHelper::addArticl($_POST["title"], $_FILES["filename"]["name"], $current_date, $_POST["description"], $_POST["text"], $_SESSION["login"], $_POST["myselect"]);
                    }
                    ?>
                    </body>
                    </html>
