<?php
 include 'DBHelper.php';
 include 'addFile.php';
    DBHelper::createServerConnection();
    DBHelper::connectToDB();
    if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} } //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
    if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} }
    //заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную
 if (empty($login) or empty($password)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
    {
     echo '<a href="index.php?reg">Назад</a>';
    exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
    
    }
    
    Addfile(images);


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
        echo '<a href="index.php?reg">Назад</a>';
    exit ("Извините, введённый вами логин уже зарегистрирован. Введите другой логин.");
     }
 // если такого нет, то сохраняем данные
    $avatar=$_FILES["filename"]["name"];
    $result2 =  DBHelper::addUser($login, $password, $avatar);
    echo "Вы успешно зарегистрированы! Теперь вы можете зайти на сайт. <a href='index.php'>Главная страница</a>";
    ?>
