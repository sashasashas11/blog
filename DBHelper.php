<?php

class DBHelper {

    private static $connection_identifier;
    private static $identifier_db;

    public static function createServerConnection() {
//          DBHelper::$connection_identifier = @mysql_connect("localhost", "sasha380_11", "B76R9312") or die("Could not connect to MySQL server!");
        DBHelper::$connection_identifier = @mysql_connect("localhost", "root", "") or die("Could not connect to MySQL server!");
    }

    public static function connectToDB() {
//        DBHelper::$identifier_db = mysql_select_db("sasha380_12", DBHelper::$connection_identifier) or die("Could not select `calendar` database!");
        DBHelper::$identifier_db = mysql_select_db("blog1", DBHelper::$connection_identifier) or die("Could not select `calendar` database!");
    }

    public static function addRecord($year, $month, $day, $text, $user) {
//        $month = $month+1;
        $add = mysql_query("INSERT INTO `record` SET `year`='" . $year . "', `mounth`='" . $month . "', `day`='" . $day . "', `message`='" . $text . "',`user_id`=(SELECT id FROM users WHERE `login`='" . $user . "')") or die("Error Insert");
    }

    public static function deleteRecord($id) {
        $delete = mysql_query("DELETE FROM `record` WHERE `id`='" . $id . "'");
    }

    public static function getMessage($month, $year) {
        $month++;
        return $res = mysql_query("SELECT u.login, r.message,r.day, r.id FROM record r JOIN users u ON r.user_id = u.id where mounth='" . $month . "' AND `year`='" . $year . "'");
    }

//     public static function getMessageyear($month, $year) {
//        return $res = mysql_query("SELECT `id`, `message`,`day`,`mounth` FROM `record` WHERE `year`='" . $month . "' AND `year`='" . $year . "'");
//                    }
    public static function getDayMessage($day, $year) {
        return $res = mysql_query("SELECT u.login, r.message,r.day, r.id FROM record r JOIN users u ON r.user_id = u.id where day='" . $day . "' AND `year`='" . $year . "'");
    }

    public static function addMessage($message, $login, $time, $date, $file, $articles) {
        $add = mysql_query("INSERT INTO `Board` SET `text`='" . $message . "', `time`='" . $time . "', `date`='" . $date . "', `file`='" . $file . "', `articles`='" . $articles . "', `user_id`=(SELECT id FROM users WHERE `login`='" . $login . "')") or die("Error Insert");
    }

    public static function deleteMessage($id) {
        $delete = mysql_query("delete from Board where id='" . $id . "'");
    }

    public static function getUserMessage($articles) {
        return $res = mysql_query("SELECT u.login, b.text, b.id, u.avatar, b.time, b.articles, b.date, b.file FROM Board b JOIN users u ON b.user_id = u.id where b.articles='".$articles."'");
    }

    public static function getUserLogin($login) {
        return $res = mysql_query("SELECT id FROM users WHERE login='". $login . "'");
    }
public static function addUser($login, $password, $avatar) {
        $add = mysql_query("INSERT INTO `users` SET  `login`='" . $login . "', `password`='" . $password . "', `avatar`='" . $avatar . "'") or die("Error Insert");
    }
     public static function getUser($login) {
        return $res = mysql_query("SELECT *  FROM users WHERE login='". $login . "'" );
    }
    public static function getCategory() {
        return $res = mysql_query("SELECT *  FROM Category ");
    }
     public static function addArticl($title, $imege, $day, $description, $text, $user, $category) {
        $add = mysql_query("INSERT INTO `articles` SET `title`='" . $title . "', `imege`='" . $imege . "', `date`='" . $day . "', `description`='" . $description . "', `text`='" . $text . "',`user_id`=(SELECT id FROM users WHERE `login`='" . $user . "'), `category`=(SELECT id FROM Category WHERE `name`='" . $category . "')") or die("Error Insert");
    }
      public static function getArticlesAll() {
        return $res = mysql_query("SELECT u.login, a.title, a.description, a.id, a.imege,  a.date  FROM articles a JOIN users u ON a.user_id = u.id");
    }
     public static function getArticles($id) {
        return $res = mysql_query("SELECT u.login, a.title, a.text, a.id, a.imege,  a.date, a.description FROM articles a JOIN users u ON a.user_id = u.id where a.id='" . $id."'");
    }
    public static function deleteArticles($id) {
        $delete = mysql_query("delete from articles where id='" . $id . "'");
    }
    public static function getIdentifier() {
        return DBHelper::$connection_identifier;
    }

}

?>