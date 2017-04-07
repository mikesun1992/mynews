<?php
session_start();//开启SESSION
$_SESSION['user']=null;//清空SESSION
header('location:../AdPPT.php');
?>>