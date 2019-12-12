<?php
require_once '../connect.php'; // подключаем скрипт
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
		$sql = $con->query("SELECT id_admin, password FROM admin WHERE login='$login'");
		
		if ($sql->num_rows > 0) {
		    $data = $sql->fetch_array();
		    if (password_verify($password, $data['password'])) {
		    	$_SESSION['admin']=$_POST['login'];
		        header("location:admin.php");	
            } else
			     header("location:index.php?Empty= Не правильный пароль");
        } else
             header("location:index.php?Empty= не правильный логин");
            }
	}
	else{
		echo"что то пошло не так";
	}
?>