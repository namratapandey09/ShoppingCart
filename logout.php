<?php
session_start();

// Destroy all session data
session_unset();
session_destroy();

// Redirect to signin page
header("Location: signin.php");
exit();
?>
