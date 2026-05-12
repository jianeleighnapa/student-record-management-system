<?php
session_start();
include 'db.php';

if (!isset($_SESSION['teacher'])) {
    header("Location: log_out.php");
    exit();
}

$pdo->query("DELETE FROM students");

header("Location: dashboard.php");
exit();
?>