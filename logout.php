<?php
session_start();
echo "Session before destruction:<pre>";
print_r($_SESSION);
echo "</pre>";

session_unset();
session_destroy();

echo "Session after destruction:<pre>";
print_r($_SESSION);
echo "</pre>";

header("Location: index.php");
exit();
?>