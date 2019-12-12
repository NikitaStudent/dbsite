<?php
require_once 'connect.php'; // подключаем скрипт
 
$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link)); 
$query ="SELECT * FROM model";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
?>
<?php
require_once 'connect.php'; // подключаем скрипт
session_start();
if(isset($_POST['id_model'])){
$link = mysqli_connect($host, $user, $password, $database) 
            or die("Ошибка " . mysqli_error($link)); 
    $id = mysqli_real_escape_string($link, $_POST['id_model']);
    $query ="DELETE FROM model WHERE id_model = '$id'";
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
    mysqli_close($link);
    // перенаправление на скрипт index.php
}
if(isset($_GET['id']))
{   
    $id = htmlentities($_GET['id']);
    echo "<h2>Удалить модель?</h2>
        <form method='POST'>
        <input type='hidden' name='id_model' value='$id' />
        <input type='submit' value='Удалить'>
        </form>";
}

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
    <li><a href="view.php">Просмотр</a></li>
    <li><a href="edit.php">Редактировать</a></li>
    <li><h3>Отменить</h3></li>
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
if(isset($_SESSION['user'])){
echo <<<END
    <div align="center">
    <form class="form-admin" action="delete.php" method="POST">
    <p>id модели <br> 
    <input class="field" type="text" name="id_model" /></p>
    <input class="button-admin" type="submit" value="Удалить">
    </form>
    </div>
    </body>
    </html>
END;
}
else{
    header("location:index.php");
}
?>