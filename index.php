<?php
session_start();
include 'DBHelper.php';

DBHelper::createServerConnection();
DBHelper::connectToDB();
$current_time = date("H:i:s");
$current_date = date("Y.m.d");

if (isset($_GET['id'])) {
    DBHelper::deleteMessage($_GET['id']);
}

echo 'Вы зашли на сайт - ' . $current_date . " в: " . $current_time;

if (isset($_POST["message"])) {
    $message = $_POST["message"];
    $login = $_SESSION["login"];
    DBHelper::addMessage($message, $login, $current_time, $current_date, $file, $_GET['article']);
}
?>
<html>
    <head>
        <title>Главная страница</title>
        <link href="default.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div class="wrapper">  

            <div class="header">
                <div class="timer">
                    <embed id="time" src=http://wallaby.ucoz.ru/clock/free-flash-clock-183.swf width=200 height=70 wmode=transparent type=application/x-shockwave-flash></embed><param name="movie" value="wallaby.ucoz.ru/clock/free-flash-clock-183.swf" type"/><param name="wmode" value="transparent"/><param name=allowFullScreen value="true"/></object>
                </div>
                <h2 >Главная страница</h2>


            </div> 
            <div class="content">   
                <div class="registr">
                    <h1 class="title">Client Account</h1>


                    <form id="form1" action="testreg.php" method="post">


                        <p class="login">
                            <label for="inputtext1">Ваш логин:<br></label>
                            <input id="inputtext2" name="login" type="text" size="15" maxlength="15">
                        </p>


                        <p class="login">
                            <label for="inputtext2">Ваш пароль:<br></label>
                            <input id="inputtext2" name="password" type="password" size="15" maxlength="15">
                        </p>

                        <div class="registr_sabmit">
                            <input id="inputsubmit1" type="submit" name="submit" value="Ввойти">
                            </form>
                            <?php
                            if (empty($_SESSION['login']) or empty($_SESSION['id'])) {
                                // Если пусты, то мы не выводим ссылку
//    echo "Вы вошли на сайт, как гость<br><a href='#'>Эта ссылка  доступна только зарегистрированным пользователям</a>";
                            } else {
                                ?>
                                <form id="form2" method="post" action="111.php">
                                    <input id="inputsubmit2" type="submit" value="Выход">
                                </form>

                            <?php } ?>
                            <!--                        <br>-->

                            <!--**** ссылка на регистрацию, ведь как-то же должны гости туда попадать ***** --> 
                            <a id="inputtext3" href="reg.php">Зарегистрироваться</a> 
                        </div>

                </div>
                <div class="chat"> 
                    <br>
                    <?php
// Проверяем, пусты ли переменные логина и id пользователя
                    if (empty($_SESSION['login']) or empty($_SESSION['id'])) {
                        // Если пусты, то мы не выводим ссылку
                        echo "Вы вошли на сайт, как гость<br><a href='#'>Эта ссылка  доступна только зарегистрированным пользователям</a>";
                    } else {

                        // Если не пусты, то мы выводим ссылку
                         ?>
                    <div class="calendar"> 
                         Вы вошли на сайт, как   <b>  <?php echo $_SESSION['login'] ?>  </b> 
                            <a   href='Calendar.php'><h1>Заметки календаря</h1></a> 
                       </div>
                        <?php
                        if (isset($_GET['article'])) {
                            echo "<a href='index.php'>Все статьи</a>";
                            $row1 = mysql_fetch_array(DBHelper::getArticles($_GET['article']));
                            echo '<a href="index.php?article=' . $row1["id"] . '"> <h3>' . $row1["title"] . '</h3></a>';
                            echo '<p>';
                            echo '<img class="leftimg" width="100" height="100" title="Изображение" alt="Текст" src="img/' . $row1["imege"] . '" border="0">';
                            echo $row1["description"] . '</p>';
                            echo $row1["text"];
                            include 'Coment.php';
                        } 
                        else {
                            ?>
                            <div class="Post">
                                 <?php
                                  if ($_SESSION["login"]==admin) {
                           echo   '  <a href="Articles.php"> <h3>Добавить статью</h3></a> ' ;
                                  }
                            $result = DBHelper::getArticlesAll();
                            while ($row = mysql_fetch_array($result)) {
                                 echo '<a  href="index.php?article=' . $row["id"] . '"> <h3>' . $row["title"] . '</h3></a>' ;
                                 if ($_SESSION["login"]==admin) {
                                      echo '<a id="inputtext4"  href ="index.php?id=' . $row["id"] . '">' . delete . ' </a>';
                                 }
                                echo '<p class="articles">';
                                echo ' <a href="index.php?article=' . $row["id"] . '"><img class="leftimg" width="100" height="100" title="Изображение" alt="Текст" src="img/' . $row["imege"] . '" border="0"></a> ';
                                echo $row["description"];
                                echo '<a href="index.php?article=' . $row["id"] . '">Читаль дальше</a>';
                                ?>
                                </p>
                                <div class="Status">
                                Добавлено:  <?php echo $row["date"];  ?>
                                </div>
                                            <?php     }
                        }
                        ?>
                        </div>


    <?php
//                        include 'Coment.php';
    ?>

                    </div>
                </div> 
<?php } ?>
            <div class="footer">
       <!--        	<p>При использовании материалов сайта активная ссылка на наш сайт обязательна.</p>-->

            </div> 
        </div> 
    </body>
</html>