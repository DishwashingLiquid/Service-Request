<?php 

session_start();

session_unset();

session_destroy();

header("Location: ../../IMISS-System/index_two.php");

?>