<?php
require_once 'connect.php'; // подключаем скрипт
// подключаемся к серверу
$link = mysqli_connect($host, $user, $password, $database) 
        or die("Ошибка " . mysqli_error($link)); 
     
// если запрос POST 
if(isset($_POST['pattern']) && isset($_POST['name']) && isset($_POST['id_model'])){
 
    $id = htmlentities(mysqli_real_escape_string($link, $_POST['id_model']));
    $pattern = htmlentities(mysqli_real_escape_string($link, $_POST['pattern']));
    $name = htmlentities(mysqli_real_escape_string($link, $_POST['name']));
     
    $query ="UPDATE model SET pattern='$pattern', name='$name' WHERE id_model='$id'";
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
 
    if($result)
        echo "<span style='color:blue;'>Данные обновлены</span>";
}
 
// если запрос GET
if(isset($_GET['id']))
{   
    $id = htmlentities(mysqli_real_escape_string($link, $_GET['id']));
     
    // создание строки запроса
    $query ="SELECT * FROM model WHERE id_model = '$id'";
    // выполняем запрос
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
    //если в запросе более нуля строк
    if($result && mysqli_num_rows($result)>0) 
    {
        $row = mysqli_fetch_row($result); // получаем первую строку
        $name = $row[1];
        $company = $row[2];
         
        echo "<h2>Изменить модель</h2>
            <form method='POST'>
            <input type='hidden' name='id_model' value='$id' />
            <p>Введите модель:<br> 
            <input type='text' name='pattern' value='$pattern' /></p>
            <p>Производитель: <br> 
            <input type='text' name='name' value='$name' /></p>
            <input type='submit' value='Сохранить'>
            </form>";
         
        mysqli_free_result($result);
    }
}
// закрываем подключение
mysqli_close($link);
?>
<?php
session_start();
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
.form-admin{
width:20%;
padding:20px;
}
.menu{background:#6d48b7;}
</style>
</head>
<body>
<div class="menu">
<ul>
<li><a href="user.php">Профиль</a></li>
<li><a href="order.php">Сделать заказ</a></li>
<li><a href="view.php">Просмотр</a></li>
<li><h3>Редактировать</h3></li>
<li><a href="delete.php">Отменить</a></li>
</ul>
</div>
<div align="center">
<div class="form-admin">
<p>id модели<br> 
<input class="field" type="text" name="id_model" /></p>
<form action="edit.php" method="POST">
<p>Название <br> 
<input class="field" type="text" name="name" /></p>
<p>Выкройка<br> 
<input class="field" type="text" name="pattern" /></p>
<input class="button-admin" type="submit" value="Изменить">
</form>
</div>
</div>
</body>
</html>
END;
}
else{
    header("location:index.php");
}
?>