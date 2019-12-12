<?php
require_once 'connect.php'; // подключаем скрипт
 session_start();
$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link)); 
$query ="SELECT * FROM model";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 

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
    .form-admin{
    text-align: center;
    padding: 20px;
    border:none;
    }
    </style>
    </head>
    <body>
    <div class="menu">
    <ul>
    <li><a href="user.php">Профиль</a></li>
    <li><a href="order.php">Сделать заказ</a></li>
    <li><h3>Просмотр</h3></li>
    <li><a href="edit.php">Редактировать</a></li>
    <li><a href="delete.php">Отменить</a></li>
    </ul>
    </div>
    END;
    if($result)
    {
    $rows = mysqli_num_rows($result); // количество полученных строк
    echo <<<END
    <div align="center"><table><tr><th>Id</th><th> Выкройка</th><th>Размер</th><th>Расходный материал</th><th>Время выполнения</th><th>Имя</th></tr></div>
    END;
    for ($i = 0 ; $i < $rows ; ++$i)
    {
        $row = mysqli_fetch_row($result);
        echo "<tr>";
            for ($j = 0 ; $j < 6 ; ++$j) echo "<td>$row[$j]</td>";
        echo "</tr>";
    }
    echo "</table>";
    // очищаем результат
    mysqli_free_result($result);
    }
    mysqli_close($link);
}
else{
    header("locator:index.php");
}
?>