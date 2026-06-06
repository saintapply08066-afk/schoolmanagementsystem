<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: admin/login.php");
    exit();
}
?>

<h2>Admin Dashboard</h2>

<p>Welcome <?php echo $_SESSION['fullname']; ?></p>

<p>Role: <?php echo $_SESSION['role']; ?></p>

<a href="../logout.php">Logout</a>
