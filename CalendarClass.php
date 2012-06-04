<?php


session_start();

class Month {

    private $name;
    private $days;

    public function __construct($name, $days) {
        $this->name = $name;
        $this->days = $days;
    }

    public function getMonthName() {
        return $this->name;
    }

    public function getMonthDays() {
        return $this->days;
    }
}
class Calendar {

    private $massMonth;
    private $year;

    public function __construct() {
        ;
    }

    public function setCalendar($year) {
        $this->year = $year;
        $this->addMonth(new Month(January, 31));
        if ($year % 4 == 0)
            $this->addMonth(new Month(February, 29));
        else
            $this->addMonth(new Month(February, 28));
        $this->addMonth(new Month(March, 31));
        $this->addMonth(new Month(April, 30));
        $this->addMonth(new Month(May, 31));
        $this->addMonth(new Month(Junuary, 30));
        $this->addMonth(new Month(July, 31));
        $this->addMonth(new Month(August, 31));
        $this->addMonth(new Month(September, 30));
        $this->addMonth(new Month(Octovber, 31));
        $this->addMonth(new Month(November, 30));
        $this->addMonth(new Month(December, 31));
    }

    public function changeYear($y) {
        $this->year = $y;
        if ($y % 4 == 0)
            $this->massMonth[1] = new Month(February, 29);
        else
            $this->massMonth[1] = new Month(February, 28);
        $_SESSION['Calendar'] = $this;
    }

    public function addMonth($month) {
        $this->massMonth[] = $month;
    }

    public function showMonth($i) {
        if (isset($_GET['dec'])) {
            $this->changeYear($this->year - 1);
        }
        if (isset($_GET['inc'])) {
            $this->changeYear($this->year + 1);
        }
        if ($_GET['month']==11||$_GET['month']==0||$_GET['month']==1 ){
         echo '<table align ="center" bgcolor="#ffcc00" border="10" cellpadding="20" background="images/054.jpg" cellspacing="5">';   
        }
        elseif($_GET['month']==2||$_GET['month']==3||$_GET['month']==4 ){
         echo '<table align ="center" bgcolor="#ffcc00" border="10" cellpadding="20" background="images/abcd00041.jpg" cellspacing="5">';   
        }
       elseif($_GET['month']==5||$_GET['month']==6||$_GET['month']==7 ){
         echo '<table align ="center" bgcolor="#ffcc00" border="10" cellpadding="20" background="images/92505.jpg" cellspacing="5">';   
        } 
 else {
        echo '<table align ="center" bgcolor="#ffcc00" border="10" cellpadding="20" background="images/wallpaper_autumn008.jpg" cellspacing="5">';
 }
        echo "<caption>";
        if ($i == 0)
           echo '<a href ="Calendar.php?month=' . (11) . '&dec=1">' . '<img src="images/gb.gif" > '   . '</a>';
        else
            echo '<a href ="Calendar.php?month=' . ($i -1) . '">' . '<img src="images/gb.gif" > ' . '</a>';
        $name = $this->massMonth[$i]->getMonthName();
        echo '<a href="Calendar.php?month=' . $i . '&open=1">' . $name . '</a>' . ", <b>" . $this->year ."</b>  " ;
        if ($i == 11)
            echo '<a href ="Calendar.php?month=' . (0) . '&inc=1">' . '<img src="images/db.gif" > ' . '</a>';
        else
            echo '<a href ="Calendar.php?month=' . ($i + 1) . '">' . '<img src="images/db.gif" > ' . '</a>';
        echo "</caption>";

        echo '<tr>';
        for ($j = 1; $j <= $this->massMonth[$i]->getMonthDays(); $j++) {
            if ($j < 10)
                echo '<td>' . '<a href=Calendar.php?month=' . $i . '&date=' . ($j) . '>' . "$j" . '</a>' . '</td>';
            else
                echo '<td>' . '<a href=Calendar.php?month=' . $i . '&date=' . ($j) . '>' . "$j" . '</a>' . '</td>';
            if ($j % 7 == 0) {

                echo '</tr>';
            }
        }
        echo '</table>';
        $_GET['dec'] = null;
    }

    public function getYear() {
        return $this->year;
    }

}

?>
