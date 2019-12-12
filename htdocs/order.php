<?php
require_once 'connect.php'; // подключаем скрипт
session_start();
if(isset($_SESSION['user'])){
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
      header("location:order.php?Empty= Данные добавлены");
    } 
    // закрываем подключение
    mysqli_close($link);
}
}
else{
  header('location:index.php');
}
?>
<?php
if(isset($_SESSION['user'])){
  echo <<<END
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
text-decoration: line-through; /* Добавляем подчеркивание при наведении курсора мыши на ссылку */
}
.menu{background:#6d48b7;}
</style>
</head>
<body>
<div class="menu">
<ul>
<li><a href="user.php">Профиль</a></li>
<li><h3>Сделать заказ</h3></li>
<li><a href="view.php">Просмотр</a></li>
<li><a href="edit.php">Редактировать</a></li>
<li><a href="delete.php">Отменить</a></li>
</ul>
</div>
<div align="center">
<div class="form-admin">
<h2>Добавить заказ</h2>
<form action="order.php" method="POST" enctype='multipart/form-data'>
END;
?>
<?php 
if(@$_GET['Empty']==true)
{
?>
<div style="color:green;" class="alert-light text-danger text-center py-3"><?php echo $_GET['Empty'] ?></div>                                
<?php
}
?>
<?php
echo <<<END
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
<!--<p>Изображение<br>
<input type="file"name="image">
</p>-->
<input class="button-admin" type="submit" value="Добавить">
</form>
</div>
</div>
</body>
</html>
END;
}
else{header('location:index.php');}
?>
