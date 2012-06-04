<?php
if ($_FILES["filename"]["size"] > 1024 * 20 * 1024) {
    echo ("Размер файла превышает 20 мегабайта");
    exit;
}
// Проверяем загружен ли файл
if (is_uploaded_file($_FILES["filename"]["tmp_name"])) {
    /// Если файл загружен успешно, перемещаем его из временной директории в конечную
//    move_uploaded_file($_FILES["filename"]["tmp_name"], "/home/sasha380/domains/sashasashas11.xres.org/public_html/file/" . $_FILES["filename"]["name"]);
    move_uploaded_file($_FILES["filename"]["tmp_name"], "/home/localhost/www/Blog/file/" . $_FILES["filename"]["name"]);
//    echo '<a href="index.php"><img width="100" title="Изображение" alt="Текст" src="file/' . $_FILES["filename"]["name"] . '" border="0"></a>';
//    $message = mysql_query("INSERT INTO `board` SET `text`='" . trim($_FILES["filename"]["name"]) . "', `user_id`=(SELECT id FROM users WHERE `login`='".$_SESSION["login"] . "')") or die("Not Insert");
    $file = $_FILES["filename"]["name"];
    echo $file;
} else {
//      echo("Ошибка загрузки файла");
}
?>
<html>
    <body>
        <form  method="Post" enctype="multipart/form-data">
            <p>Ввести сообщения:</br> 
                <textarea name="message" placeholder="Коментарий..." rows="5" cols="40" > </textarea>
<!--        <input type="file" name="filename"><br> -->

            </p>
            <input type="submit" value="Отправить"  /> 
            <input type="file" name="filename"><br> 
        </form>


        <table border="1" cellpadding="5" cellspacing="5">
            <tr>
                <th>
                    Avatar
                </th>
                <th>
                    Name
                </th>
                <th>
                    Text
                </th>
                <th>
                    File
                </th>

                <th>
                    Action
                </th>
            </tr>
            <?php
            $result = DBHelper::getUserMessage($_GET['article']);
            while ($row = mysql_fetch_array($result)) {
                ?>
                <tr class="table">
                    <td>

                        <?php echo '<img width="100" title="Изображение" alt="Текст" src="file/' . $row["avatar"] . '" border="0">';
                        ;
                        ?>
                    </td>
                    <td>
    <?php echo $row["login"]; ?>
                    </td>
                    <td>
                        <?php echo $row["text"] . '</br>'; ?>
    <?php echo '<a href="/blog/file/' . $row["file"] . '">' . $row["file"] . '</a>'; ?>
                    </td>
    
                    <td>
    <?php echo $row["date"] . '</br>' . $row["time"]; ?>
                    </td>

                    <td>
                        <?php
                        if ($row["login"] == $_SESSION["login"])

                        //echo '<a href ="baseViewer.php">Delete text</a>';
                            echo '<a href ="index.php?id=' . $row["id"] . '">' . delete . ' </a>';
                        ?>
                    </td>
                </tr>
                <?php
            }
            ?>

        </table>

<!--        }-->

    </body>
</html>