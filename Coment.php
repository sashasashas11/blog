<?php



?>
<html>
    <body>
        <form  method="Post" enctype="multipart/form-data">
            <h1 class="H1">Коментарии:</h1>
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
                       
                        <?php echo '<a href="/ public_html/file/' . $row["file"] . '">' . $row["file"] . '</a>'; ?>
    <?php // echo '<a href="/blog/file/' . $row["file"] . '">' . $row["file"] . '</a>'; ?>
                    </td>
    
                    <td>
    <?php echo $row["date"] . '</br>' . $row["time"]; ?>
                    </td>

                    <td>
                        <?php
                        if ($row["login"] == $_SESSION["login"])

                        //echo '<a href ="baseViewer.php">Delete text</a>';
                           echo '<a href ="index.php?article=' . $row["articles"] .'&id=' . $row["id"] . '">' . delete . ' </a>';
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