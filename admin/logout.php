<?php
setcookie('admin_token', '', time() - 3600, '/');
header('Location: login.php');
exit;
?>
