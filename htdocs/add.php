<?php
session_start();
require_once 'connect.php'; // подключаем скрипт
 //var_dump($_POST);
if(isset($_POST['pattern']) && isset($_POST['size']) && isset($_POST['em']) && isset($_POST['et']) && isset($_POST['name'])){
 
    // подключаемся к серверу
    $link = mysqli_connect($host, $user, $password, $database) 
        or die("Ошибка " . mysqli_error($link)); 

    // экранирования символов для mysql
    $pattern = htmlentities(mysqli_real_escape_string($link, $_POST['pattern']));
    $size = htmlentities(mysqli_real_escape_string($link, $_POST['size']));
    $em = htmlentities(mysqli_real_escape_string($link, $_POST['em']));
    $et = htmlentities(mysqli_real_escape_string($link, $_POST['et']));
    $name = htmlentities(mysqli_real_escape_string($link, $_POST['name']));
    $imagename= htmlentities(mysqli_real_escape_string($link,$_FILES["myimage"]["name"]));
        //Получаем содержимое изображения и добавляем к нему слеш
    $imagetmp=addslashes(file_get_contents($_FILES['myimage']['tmp_name']));
    // создание строки запроса
    $query ="INSERT INTO model VALUES(NULL, '$pattern','$size','$em','$et','$name','$imagename')";
     
    // выполняем запрос
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
    if($result)
    {
        echo "<span style='color:blue;'>Данные добавлены</span>";

    } 
    // закрываем подключение
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <link href="/css/style.css" rel="stylesheet">
<style>
    ul {
  list-style: none; /*убираем маркеры списка*/
  margin: 0; /*убираем верхнее и нижнее поле, равное 1em*/
  padding-left: 15px; /*убираем левый отступ, равный 40px*/
}
li {display: inline-block;}
a {text-decoration: none; color:white;/*убираем подчеркивание текста ссылок*/}
 a:hover { 
    text-decoration: line-through; /* Добавляем подчеркивание 
                                   при наведении курсора мыши на ссылку */
   }
</style>
</head>
<body>
<div class="menu-admin">
<ul>
<li><a href="profile_admin.php">Профиль</a></li>
<li><h3>Добавить</h3></li>
<li><a href="view.php">Просмотр</a></li>
<li><a href="edit.php">Редактировать</a></li>
<li><a href="delete.php">Удалить</a></li>
</ul>
</div>
<div align="center">
<div class="form-admin">
<h2>Добавить новую модель</h2>
    <form action="add.php" method="POST" enctype='multipart/form-data'>
    <p>Выкройка:<br> 
<input class="field" type="text" name="pattern" /></p>
<p>Размер: <br> 
<input class="field" type="text" name="size" /></p>
<p>Расходный материал: <br> 
<input class="field" type="text" name="em" /></p>
<p>Время выполнения: <br> 
<input class="field" type="data" name="et" /></p>
<p>Название: <br> 
<input class="field" type="text" name="name" /></p>
<p>Изображение<br>
    <input type="file"name="myimage">
</p>
<input class="button-admin" type="submit" value="Добавить">
</form>
</div>
</div>
</body>
</html>
