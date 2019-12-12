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
.menu{background:#6d48b7;}
#link{
color:blue;
}
#link:hover{
text-decoration:none;
}
</style>
</head>
<body>
<div class="menu">
<ul>
<li><h3>Профиль</h3></li>
<li><a href="order.php">Сделать заказ</a></li> 
<li><a href="view.php">Просмотр</a></li>
<li><a href="edit.php">Редактировать</a></li>
<li><a href="delete.php">Отменить</a></li>
</ul>
</div>
<div align="center">
<div class="form-admin">
<h2>Здравствуйте</h2>    
</div>
</div> 
<div align="center"> <a id="link" href="exit.php?exit">Выход</a></div>
</form>
</div> 
</div>
</body>
</html>
END;
}
else{
  header('location:index.php');
}
?>