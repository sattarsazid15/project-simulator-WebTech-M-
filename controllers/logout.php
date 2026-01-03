<?php
session_start();
session_destroy();

setcookie('status', 'true', time()-10, '/');
setcookie('admin_status', 'true', time()-10, '/');
setcookie('tech_status', 'true', time()-10, '/');

header("Location: ../views/home.php");
exit();
?>