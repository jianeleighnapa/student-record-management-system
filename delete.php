<?php
session_start();
include 'db.php';

if (!isset($_SESSION['teacher'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM students WHERE id=?");
$stmt->execute([$id]);

echo "<i class='fa-solid fa-trash'></i> Deleted Successfully";

header("Location: dashboard.php");
exit();
?>