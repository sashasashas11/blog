<html>
    <head>
          <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Регистрация</title>
    </head>
    <body>
    <h2>Регистрация</h2>
    <form action="save_user.php" method="post" enctype="multipart/form-data"> 
    
<p>
    <label>Ваш логин:<br></label>
    <input name="login" type="text" size="15" maxlength="15">
    </p>

<p>
    <label>Ваш пароль:<br></label>
    <input name="password" type="password" size="15" maxlength="15">
    </p>
    <h2><p><b> Форма для загрузки файлов </b></p></h2>
    <input type="file" name="filename"><br> 

<p>
    <input type="submit" name="submit" value="Зарегистрироваться">

</p></form>
      
    </body>
    </html>