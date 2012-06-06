<?php
include 'CalendarClass.php';
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<!--        <title>Главная страница</title>-->
        <link href="default.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div class="header">
            <h2>Календарь</h2>
        </div>

        <div class="content">

            <div class="registr">

                <?php
                if (isset($_SESSION["login"]))
                    echo "Hello, " . $_SESSION["login"] . "!" . "<br>";
                ?>
                <a href='index.php'>Главная страница</a>
            </div>
            <div class="chat">

<?php
if (!isset($_SESSION["Calendar"])) {
    $c = new Calendar();
    $c->setCalendar(date(Y));
    $_SESSION["Calendar"] = $c;
}
else
    $c = $_SESSION["Calendar"];


if (!isset($_GET['month'])) {
    $c->showMonth(date(n) - 1);
    $_SESSION['month'] = date(n) - 1;
} else {
    $_SESSION['month'] = $_GET['month'];
    $c->showMonth($_GET['month']);
}
if (isset($_GET['date'])) {
    $_SESSION['year'] = $c->getYear();
    $_SESSION['day'] = $_GET['date'];
    $_SESSION['month']++;
    ?>
                    <table align ="center">
                        <tr>
                            <form method="Post">
                                <td>
    <?php echo $_SESSION['day'] . "." . $_SESSION['month'] . "." . $_SESSION['year']; ?>

                                </td> 
                                <td>
                                    <p>Добавить заметку:   <input type="text" name="message" /></p>
                                </td>
                                <td>
                                    <p><input id="inputsubmit1" type="submit" value="Добавить"  /></p>
                                </td>
                            </form>
                        </tr>
                    </table>
    <?php
}

$_SESSION['year'] = $c->getYear();

if (isset($_POST['message'])) {
    $_SESSION['message'] = $_POST['message'];
    include 'DBUse.php';
}

if (isset($_GET['open'])) {
    include 'DBUse.php';
}
?>
            </div>
        </div>
    </body>
</html>