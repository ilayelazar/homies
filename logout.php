<html><body>
<?php
session_start();
session_destroy();
header("Location: homepage.php");
?>
</body></html>