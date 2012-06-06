<?php

include 'DBHelper.php';
session_start();

DBHelper::createServerConnection();
DBHelper::connectToDB();
;
if (isset($_SESSION['message'])) {
    DBHelper::addRecord($_SESSION['year'], $_SESSION['month'], $_SESSION['day'], $_SESSION['message'],$_SESSION["login"] );
    $_SESSION['message'] = null;
}
if (isset($_GET['del'])) {
    DBHelper::deleteRecord($_GET['del']);
}
if (isset($_GET['open'])) {
    
    $result = DBHelper::getMessage($_SESSION['month'], $_SESSION['year']);
    
    echo '<table align ="center" border="1" cellpadding="5" cellspacing="5">';
    echo "<caption>";
    echo "<h1> Все записи месяца </h1>";
    echo "</caption>";
    $_SESSION['month']=$_SESSION['month']+1;
    while ($mass = mysql_fetch_array($result)) {
        echo '<tr>';
       
        echo '<td>';
        
        echo $mass["day"] . "." . $_SESSION['month'] . "." . $_SESSION['year'];
        echo '</td>';

        echo '<td>';
        echo $mass["message"];
        echo '</td>';
        if ($mass["login"]==$_SESSION["login"]){
        echo '<td>';
        echo '<b>'. $mass["login"].'</b>';
        echo '</td>';
        }
        else {
     echo '<td>';
        echo $mass["login"];
        echo '</td>';
 }
        if ($mass["login"]==$_SESSION["login"]){
        echo '<td>';
         echo '<a href="Calendar.php?open=1&month=' . $_SESSION['month'] . '&del=' . $mass['id'] . '">' . Delete . '</a>';
        echo '</td>';
        }
        echo '</tr>';
    }
    echo '</table>';
}
?>
