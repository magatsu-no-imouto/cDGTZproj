<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    if (basename($_SERVER['PHP_SELF']) !== 'gate.php') {
        header("Location: /dgcentre/admin/gate.php");
        exit;
    }
}
?>