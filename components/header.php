<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management</title>
    <link rel="stylesheet" href="path/to/your/css/file.css">
</head>
<body>
    <header>
        <h1>Library Management</h1>
    </header>
    <nav>
        <ul>
            <li><a href="/Uas-Praktikum-Web/index.php">Home</a></li>
            <li><a href="/Uas-Praktikum-Web/books/create.php">Add Book</a></li>
            <?php if(isset($_SESSION['username'])): ?>
                <li><a href="/Uas-Praktikum-Web/auth/logout.php">Logout</a></li>
                <li><span>Welcome, <?php echo $_SESSION['username']; ?></span></li>
            <?php else: ?>
                <li><a href="/Uas-Praktikum-Web/auth/login.php">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>
