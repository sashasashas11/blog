<?php
 include 'DBHelper.php';
    DBHelper::createServerConnection();
    DBHelper::connectToDB();
    if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} } //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
    if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} }
    //заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную
 if (empty($login) or empty($password)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
    {
    exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
    }
//     if (isset($_POST["filename"])){
//    DBHelper::addMessage($_POST["message"],$_SESSION["login"]);
//}
  if($_FILES["filename"]["size"] > 1024*20*1024)
   {
     echo ("Размер файла превышает 20 мегабайта");
     exit;
   }
   
   // Проверяем загружен ли файл
   if(is_uploaded_file($_FILES["filename"]["tmp_name"]))
   {
     // Если файл загружен успешно, перемещаем его
     // из временной директории в конечную
//        move_uploaded_file($_FILES["filename"]["tmp_name"], "/home/localhost/www/Blog/images/" . $_FILES["filename"]["name"]);
     move_uploaded_file($_FILES["filename"]["tmp_name"], "/home/sasha380/domains/sashasashas11.xres.org/public_html/file/".$_FILES["filename"]["name"]);
//     echo '<a href="index.php"><img width="100" title="Изображение" alt="Текст" src="file/'.$_FILES["filename"]["name"].'" border="0"></a>'.'</br>';
    
    } else {
//      echo("Ошибка загрузки файла");
   }   

//если логин и пароль введены,то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
    $login = stripslashes($login);
    $login = htmlspecialchars($login);
 $password = stripslashes($password);
    $password = htmlspecialchars($password);
 //удаляем лишние пробелы
    $login = trim($login);
    $password = trim($password);
 // подключаемся к базе
 // проверка на существование пользователя с таким же логином
    $result = DBHelper::getUserLogin($login);
    $myrow = mysql_fetch_array($result);
    if (!empty($myrow['id'])) {
    exit ("Извините, введённый вами логин уже зарегистрирован. Введите другой логин.");
    }
 // если такого нет, то сохраняем данные
    $avatar=$_FILES["filename"]["name"];
    $result2 =  DBHelper::addUser($login, $password, $avatar);
    echo "Вы успешно зарегистрированы! Теперь вы можете зайти на сайт. <a href='index.php'>Главная страница</a>";
    ?>
