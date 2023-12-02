<?php
session_start();
session_destroy();

header("Location: /seiran/view/book/info.php");
?>
