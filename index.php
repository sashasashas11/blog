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



echo '�� ����� �� ���� - '.$current_date. " �: ". $current_time; 


if ($_FILES["filename"]["size"] > 1024 * 20 * 1024) {
    echo ("������ ����� ��������� ��� ���������");
    exit;
}
// ��������� �������� �� ����
if (is_uploaded_file($_FILES["filename"]["tmp_name"])) {
    /// ���� ���� �������� �������, ���������� ���
    // �� ��������� ���������� � ��������
     move_uploaded_file($_FILES["filename"]["tmp_name"], "/home/sasha380/domains/sashasashas11.xres.org/public_html/file/".$_FILES["filename"]["name"]);
//    move_uploaded_file($_FILES["filename"]["tmp_name"], "/home/localhost/www/Blog/file/" . $_FILES["filename"]["name"]);
//    echo '<a href="index.php"><img width="100" title="�����������" alt="�����" src="file/' . $_FILES["filename"]["name"] . '" border="0"></a>';
//    $message = mysql_query("INSERT INTO `board` SET `text`='" . trim($_FILES["filename"]["name"]) . "', `user_id`=(SELECT id FROM users WHERE `login`='".$_SESSION["login"] . "')") or die("Not Insert");
    $file=$_FILES["filename"]["name"];
    echo $file;
} else {
//      echo("������ �������� �����");
}
if (isset($_POST["message"])) {
    $message = $_POST["message"];
    $login = $_SESSION["login"];
    DBHelper::addMessage($message, $login, $current_time, $current_date, $file  );
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
    // ���� �����, �� �� �� ������� ������
//    echo "�� ����� �� ����, ��� �����<br><a href='#'>��� ������  �������� ������ ������������������ �������������</a>";
} else {
    ?>
                            <form id="form2" method="post" action="111.php">
                                <input id="inputsubmit2" type="submit" value="�����">
                            </form>
               
                            <?php } ?>
<!--                        <br>-->

                        <!--**** ������ �� �����������, ���� ���-�� �� ������ ����� ���� �������� ***** --> 
                        <a id="inputtext3" href="reg.php">������������������</a> 
                        </div>

                </div>
               <div class="chat"> 
                <br>
<?php
// ���������, ����� �� ���������� ������ � id ������������
if (empty($_SESSION['login']) or empty($_SESSION['id'])) {
    // ���� �����, �� �� �� ������� ������
    echo "�� ����� �� ����, ��� �����<br><a href='#'>��� ������  �������� ������ ������������������ �������������</a>";
} else {

    // ���� �� �����, �� �� ������� ������
    echo "�� ����� �� ����, ��� " . '<b>' . $_SESSION['login'] . '</b>' . "<br><a  href='Calendar.php'><h3>������� ���������</h3></a>";
    ?>

                    <!--    <form method="Post" enctype="multipart/form-data">-->
                    <form  method="Post" enctype="multipart/form-data">
                        <p>������ ���������:</br> 
                            <textarea name="message" placeholder="������ ���������" rows="5" cols="40" resize: none> </textarea>
        <!--        <input type="file" name="filename"><br> -->
                           
                        </p>
                        <input type="submit" value="���������"  /> 
                         <input type="file" name="filename"><br> 
                    </form>

<!--                <form  method="post" enctype="multipart/form-data">
                    <input type="file" name="filename"><br> 
                    <input type="submit" value="���������"><br>
                </form>-->
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
                                Time
                            </th>
                            <th>
                                Action
                            </th>
                        </tr>
    <?php
    $result = DBHelper::getUserMessage();
    while ($row = mysql_fetch_array($result)) {
        ?>
                            <tr class="table">
                                <td>

        <?php echo '<img width="100" title="�����������" alt="�����" src="file/' . $row["avatar"] . '" border="0">';
        ; ?>
                                </td>
                                <td>
                            <?php echo $row["login"]; ?>
                                </td>
                                <td>
                            <?php echo $row["text"]; ?>
                                </td>
                                <td id="time">
                            <?php echo $row["date"].'</br>'. $row["time"]; ?>
                                </td>
                            <?php //    echo '<a href="index.php"><img width="100" title="�����������" alt="�����" src="file/' . $row["file"] . '" border="0"></a>'; ?>
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

                            <?php } ?>
                <!--   action="upload.php"-->
                
            </div>
        </div> 

        <div class="footer">
   <!--        	<p>��� ������������� ���������� ����� �������� ������ �� ��� ���� �����������.</p>-->
            <ul>
                        	
            </ul>
        </div> 
    </div> 
</body>
</html>