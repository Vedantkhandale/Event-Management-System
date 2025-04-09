<?php
session_start();
session_destroy();
header("Location: index.php");
exit();
?>
<?php
session_start();
session_destroy();
header("Location: admin_login.php");
exit();
?>

