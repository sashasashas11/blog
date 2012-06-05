<?php
session_start();
include 'DBHelper.php';
include 'addFile.php';
DBHelper::createServerConnection();
DBHelper::connectToDB();
$current_time = date("H:i:s");
$current_date = date("Y.m.d");

Addfile(file);

if (isset($_GET['id'])) {
    DBHelper::deleteMessage($_GET['id']);
}

echo '�� ����� �� ���� - ' . $current_date . " �: " . $current_time;

if (isset($_POST["message"])) {
      DBHelper::addMessage($_POST["message"], $_SESSION["login"], $current_time, $current_date, $_FILES["filename"]["name"], $_GET['article']);
   $_POST["message"]=null;
      unset ($_POST["message"]) ;
      
}
 if ($_SESSION["login"] == admin) {
  if (isset($_GET['articles'])) {
    DBHelper::deleteArticles($_GET['articles']);
}   
 }

?>
<html>
    <head>
        <title>������� ��������</title>
        <link href="default.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div class="wrapper">  

            <div class="header">
                <div class="timer">
                    <embed id="time" src=http://wallaby.ucoz.ru/clock/free-flash-clock-183.swf width=200 height=70 wmode=transparent type=application/x-shockwave-flash></embed><param name="movie" value="wallaby.ucoz.ru/clock/free-flash-clock-183.swf" type"/><param name="wmode" value="transparent"/><param name=allowFullScreen value="true"/></object>
                </div>
                <h2 >������� ��������</h2>


            </div> 
            <div class="content">   
                <div class="registr">
                    <h1 class="title">Client Account</h1>


                    <form id="form1" action="testreg.php" method="post">


                        <p class="login">
                            <label for="inputtext1">��� �����:<br></label>
                            <input id="inputtext2" name="login" type="text" size="15" maxlength="15">
                        </p>


                        <p class="login">
                            <label for="inputtext2">��� ������:<br></label>
                            <input id="inputtext2" name="password" type="password" size="15" maxlength="15">
                        </p>

                        <div class="registr_sabmit">
                            <input id="inputsubmit1" type="submit" name="submit" value="������">
                            </form>
                            <?php
                            if (empty($_SESSION['login']) or empty($_SESSION['id'])) {
                                
                            } else {
                                ?>
                                <form id="form2" method="post" action="111.php">
                                    <input id="inputsubmit2" type="submit" value="�����">
                                </form>

<?php } ?>
                            <a id="inputtext3" href="reg.php">������������������</a> 
                        </div>

                </div>
                <div class="chat"> 
                    <br>
                    <?php
                    if (empty($_SESSION['login']) or empty($_SESSION['id'])) {
                        // ���� �����, �� �� �� ������� ������
                        echo "�� ����� �� ����, ��� �����<br><a href='#'>��� ������  �������� ������ ������������������ �������������</a>";
                    } else {
                        ?>
                        <div class="calendar"> 
                            �� ����� �� ����, ���   <b>  <?php echo $_SESSION['login'] ?>  </b> 
                            <a   href='Calendar.php'><h1>������� ���������</h1></a> 
                        </div>
                    <div class="FullPost"> 
 <?php
     
    if (isset($_GET['article'])) {
        echo "<a href='index.php'>��� ������</a>";
        $row1 = mysql_fetch_array(DBHelper::getArticles($_GET['article']));
        echo '<a href="index.php?article=' . $row1["id"] . '"> <h3>' . $row1["title"] . '</h3></a>';
        echo '<p id="text">';
        echo '<img class="leftimg" width="100" height="100" title="�����������" alt="�����" src="img/' . $row1["imege"] . '" border="0">';
        echo $row1["description"] ;
        echo  $row1["text"] . '</p>';
        include 'Coment.php';
    } else {
        ?>
          </div>  
                        <div class="Post">
                            <?php
                            if ($_SESSION["login"] == admin) {
                                echo '  <a href="Articles.php"> <h3>�������� ������</h3></a> ';
                            }
                            $result = DBHelper::getArticlesAll();
                            while ($row = mysql_fetch_array($result)) {
                                echo '<a  href="index.php?article=' . $row["id"] . '"> <h3>' . $row["title"] . '</h3></a>';
                                if ($_SESSION["login"] == admin) {
                                    echo '<a id="inputtext4"  href ="index.php?articles=' . $row["id"] . '">' . delete . ' </a>';
                                }
                                echo '<p class="articles">';
                                echo ' <a href="index.php?article=' . $row["id"] . '"><img class="leftimg" width="100" height="100" title="�����������" alt="�����" src="img/' . $row["imege"] . '" border="0"></a> ';
                                echo $row["description"];
                                echo '<a href="index.php?article=' . $row["id"] . '">������ ������</a>';
                                ?>
                                    </p>
                                    <div class="Status">
                                        ���������:  <?php echo $row["date"]; ?>
                                    </div>
        <?php
        }
    }
    ?>
                        </div>

                    </div>
                </div> 
<?php } ?>               	
            <div class="footer">
               	<p>����: ���������� �������</p>

            </div> 
        </div> 
    </body>
</html>