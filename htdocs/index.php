<?php
require_once 'connect.php'; // подключаем скрипт
session_start();//начало сессиии

	if (isset($_POST['submit'])) {
		if(empty($_POST['login']) || empty($_POST['password'])){
            header("location:index.php?Empty= Заполните пустые поля");
        }
        else{
		//подключение к базе
		$con = new mysqli($host, $user, $password, $database);
        $login = $con->real_escape_string($_POST['login']);
        $password = $con->real_escape_string($_POST['password']);
		$sql = $con->query("SELECT id_user, password FROM user WHERE login='$login'");
		
		if ($sql->num_rows > 0) {
		    $data = $sql->fetch_array();
		    if (password_verify($password, $data['password'])) {
		    	$_SESSION['user']=$_POST['login'];
		        header("location:user.php");	
            } else
			     header("location:index.php?Empty= Не правильный пароль");
        } else
             header("location:index.php?Empty= не правильный логин");
            }
	}
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Вход</title>
 	<link href="/css/bootstrap.min.css" rel="stylesheet">
 	<link href="/css/style.css" rel="stylesheet">
 	<style type="text/css">
   body{
background: url(/images/grad.png);
background-size: 100%;

   }
  </style>

</head>
<body>
	<div align="center">
	<div class="form">
				<form method="post" action="index.php" class="form-main">
					<?php 
                        if(@$_GET['Empty']==true)
                        {
                    ?>
                        <div class="alert-light text-danger text-center py-3"><?php echo $_GET['Empty'] ?></div>                                
                    <?php
                        }
                    ?>
					<h2>Вход</h2>
					<p><input class="field" name="login" type="login" placeholder="Логин..."><br></p>
					<p><input class="field"	minlength="5" name="password" type="password" placeholder="Пароль..."><br></p>
					<p><input class="button-main"	name="submit" type="submit" value="Войти"><br></p>
                    <a href="register.php">Регистрация</a>
				</form>
	</div>
</div>
</body>
</html>