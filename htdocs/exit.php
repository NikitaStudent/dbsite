<?php 
    session_start();
    if(isset($_GET['exit']))
    {
        session_destroy();
        header("location:index.php");
    }
 
?>