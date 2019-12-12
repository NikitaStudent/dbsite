<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Вход в Админ панель</title>
 	<link href="/css/bootstrap.min.css" rel="stylesheet">
 	<link href="/css/style.css" rel="stylesheet">
 	<style type="text/css">
   body{
background: url(/images/blue-grad.png);
background-size: 100%;

   }
  </style>

</head>
<body>
	<div align="center">
				
	<div class="form">

				<form method="post" action="auth.php" class="form-main">
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
                  
				</form>
	</div>
</div>
</body>
</html>