<?php
 include 'DBHelper.php';
    DBHelper::createServerConnection();
    DBHelper::connectToDB();
    if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} } //������� ��������� ������������� ����� � ���������� $login, ���� �� ������, �� ���������� ����������
    if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} }
    //������� ��������� ������������� ������ � ���������� $password, ���� �� ������, �� ���������� ����������
 if (empty($login) or empty($password)) //���� ������������ �� ���� ����� ��� ������, �� ������ ������ � ������������� ������
    {
    exit ("�� ����� �� ��� ����������, ��������� ����� � ��������� ��� ����!");
    }
//     if (isset($_POST["filename"])){
//    DBHelper::addMessage($_POST["message"],$_SESSION["login"]);
//}
  if($_FILES["filename"]["size"] > 1024*20*1024)
   {
     echo ("������ ����� ��������� 20 ���������");
     exit;
   }
   
   // ��������� �������� �� ����
   if(is_uploaded_file($_FILES["filename"]["tmp_name"]))
   {
     // ���� ���� �������� �������, ���������� ���
     // �� ��������� ���������� � ��������
//        move_uploaded_file($_FILES["filename"]["tmp_name"], "/home/localhost/www/Blog/images/" . $_FILES["filename"]["name"]);
     move_uploaded_file($_FILES["filename"]["tmp_name"], "/home/sasha380/domains/sashasashas11.xres.org/public_html/file/".$_FILES["filename"]["name"]);
//     echo '<a href="index.php"><img width="100" title="�����������" alt="�����" src="file/'.$_FILES["filename"]["name"].'" border="0"></a>'.'</br>';
    
    } else {
//      echo("������ �������� �����");
   }   

//���� ����� � ������ �������,�� ������������ ��, ����� ���� � ������� �� ��������, ���� �� ��� ���� ����� ������
    $login = stripslashes($login);
    $login = htmlspecialchars($login);
 $password = stripslashes($password);
    $password = htmlspecialchars($password);
 //������� ������ �������
    $login = trim($login);
    $password = trim($password);
 // ������������ � ����
 // �������� �� ������������� ������������ � ����� �� �������
    $result = DBHelper::getUserLogin($login);
    $myrow = mysql_fetch_array($result);
    if (!empty($myrow['id'])) {
    exit ("��������, �������� ���� ����� ��� ���������������. ������� ������ �����.");
    }
 // ���� ������ ���, �� ��������� ������
    $avatar=$_FILES["filename"]["name"];
    $result2 =  DBHelper::addUser($login, $password, $avatar);
    echo "�� ������� ����������������! ������ �� ������ ����� �� ����. <a href='index.php'>������� ��������</a>";
    ?>
