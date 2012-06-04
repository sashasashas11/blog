<?php

include 'CalendarClass.php';

session_start();

echo '<h1>Календарь</h1>';
if (isset($_SESSION["login"]))
   
    echo "Hello, ".$_SESSION["login"]."!"."<br>";

echo "<a href='index.php'>Главная страница</a>";
if (!isset($_SESSION["Calendar"])) {
    $c = new Calendar();
    $c->setCalendar(date(Y));
    $_SESSION["Calendar"] = $c;
}
else
    $c=$_SESSION["Calendar"];


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
    echo '<table align ="center">';
    echo '<tr>';
    echo '<form method="Post">';
    echo '<td>';
    echo $_SESSION['day'] . "." . $_SESSION['month'] . "." . $_SESSION['year'];
    echo '</td>';
    echo '<td>';
    echo '<p>Добавить сообщение:   <input type="text" name="message" /></p>';
    echo '</td>';
    echo '<td>';
    echo '<p><input type="submit" value="Добавить"  /></p>';
    echo '</td>';
    echo '</form>';
    echo '</tr>';
    echo '</table>';
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
