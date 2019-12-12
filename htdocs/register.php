<?php
require_once 'connect.php'; // подключаем скрипт
	$msg = "";

	if (isset($_POST['submit'])) {

		if (empty($_POST['login']) && (empty($_POST['password']))) {
    		header("location:register.php?Empty= Пустые поля");
			}else{
		$con = new mysqli($host, $user, $password, $database);

		$password = $con->real_escape_string($_POST['password']);
		$fullname = $con->real_escape_string($_POST['fullname']);
		$login = $con->real_escape_string($_POST['login']);
		$hash = password_hash($password, PASSWORD_BCRYPT);
		$con->query("INSERT INTO user (password,fullname,login) VALUES ('$hash', '$fullname', '$login')");
			header("location:register.php?Empty= Вы зарегестрированы");
		}
	}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Регистрация</title>
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
				<form method="post" action="register.php" class="form-main">
					<?php 
                        if(@$_GET['Empty']==true)
                        {
                    ?>
                        <div class="alert-light text-danger text-center py-3"><?php echo $_GET['Empty'] ?></div>                                
                    <?php
                        }
                    ?>
					<h2>Регистрация</h2>
					<p><input class="field" minlength="3" name="fullname" placeholder="ФИО"><br></p>
					<p><input class="field" name="login" type="login" placeholder="Логин"><br></p>
					<p><input class="field" minlength="5" name="password" type="password" placeholder="Пароль"><br></p>
					<p><input class="button-main" name="submit" type="submit" value="Зарегестрироваться"><br></p>
					<a href="index.php">Вход</a>
				</form>
			</div>
		</div>
</body>
</html>