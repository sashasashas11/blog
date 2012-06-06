<?php

function Addfile($directory) {
    if ($_FILES["filename"]["size"] > 1024 * 20 * 1024) {
        echo ("Размер файла превышает 20 мегабайта");
        exit;
    }
    //               Проверяем загружен ли файл
    if (is_uploaded_file($_FILES["filename"]["tmp_name"])) {
        /// Если файл загружен успешно, перемещаем его из временной директории в конечную
//        move_uploaded_file($_FILES["filename"]["tmp_name"], "/home/sasha380/domains/sashasashas11.xres.org/public_html/".$directory."/" . $_FILES["filename"]["name"]);
        move_uploaded_file($_FILES["filename"]["tmp_name"], "/home/localhost/www/Blog/".$directory."/" . $_FILES["filename"]["name"]);
//      echo  $file = $_FILES["filename"]["name"];
         } else {
//        echo("Ошибка загрузки файла");
    }
}

?>
