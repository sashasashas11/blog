<?php
session_start();
include 'DBHelper.php';

DBHelper::createServerConnection();
DBHelper::connectToDB();
$current_time = date("H:i:s");
$current_date = date("Y.m.d");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
            <title></title>
    </head>
    <body>
        <a href='index.php'>������� ��������</a>
        <h1>���������� ������</h1>
        <form id="form1" action="#" method="post" enctype="multipart/form-data">
            <p class="login">
                <label for="inputtext1">��������<br></label>
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
                <label for="inputtext1">������� ��������:<br></label>
                <textarea name="description" placeholder="������� ��������:" rows="5" cols="40"> </textarea>
            </p>

            <p class="login">
                <label for="inputtext1">������ ��������:<br></label>
                <textarea name="text" placeholder="�����" rows="5" cols="40"> </textarea>
            </p>
            <input type="file" name="filename"><br> 
                    <input type="submit" value="���������"  /> 
                    </form>
                    
                    <?php
                    if ($_POST["description"] == ' ' or $_POST["title"] == '' or $_POST["text"] == ' ') {
                        echo '�� ��� ���� ���������';
                        
                    } 
                    else {
                        if ($_FILES["filename"]["size"] > 1024 * 20 * 1024) {
                            echo ("������ ����� ��������� 20 ���������");
                            exit;
                        }
                        //               ��������� �������� �� ����
                        if (is_uploaded_file($_FILES["filename"]["tmp_name"])) {
                            /// ���� ���� �������� �������, ���������� ��� �� ��������� ���������� � ��������
                            move_uploaded_file($_FILES["filename"]["tmp_name"], "/home/localhost/www/Blog/img/" . $_FILES["filename"]["name"]);
                            $file = $_FILES["filename"]["name"];
                            echo $file;
                        } else {
                            echo("������ �������� �����");
                        }
                        DBHelper::addArticl($_POST["title"], $file, $current_date, $_POST["description"], $_POST["text"], $_SESSION["login"], $_POST["myselect"]);
                    }
                    ?>
                    </body>
                    </html>
