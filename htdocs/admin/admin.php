<?php
session_start();

if(isset($_SESSION['admin'])){
  $admin =$_SESSION['admin'];
  echo <<<END
    <!DOCTYPE html>
    <html>
    <head>
    <title>Админ Панель</title>
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
    #link{
    color:blue;
    }
    #link:hover{
    text-decoration:none;
    }
    </style>
    </head>
    <body>
    <div class="menu-admin">
    <ul>
    <li><h3>Профиль</h3></li>
    <!-- <li><a href="add.php">Добавить</a></li> -->
    <li><a href="view.php">Просмотр</a></li>
    <li><a href="edit.php">Редактировать</a></li>
    <li><a href="delete.php">Удалить</a></li>
    </ul>
    </div>
    <div align="center">
    <div class="form-admin">
    <h2>Здравствуйте $admin </h2>
    </div>
    </div>
    <div align="center"> <a id="link" href="exit.php?exit">Выход</a></div>
    </body>
    </html>
  END;
}
else{
  header("location:index.php");
}
?>
