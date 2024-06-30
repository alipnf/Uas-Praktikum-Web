<?php include '../components/header.php'; ?>
<?php include '../config/database.php'; ?>

<div class="container">
    <h2>Register</h2>
    <form action="" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <input type="submit" name="submit" value="Register">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $sql = "INSERT INTO user (username, password) VALUES ('$username', '$password')";
jksajdkaljk
        if ($conn->query($sql) === TRUE) {
            echo "User registered successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    $conn->close();
    ?>
</div>

<?php include '../components/footer.php'; ?>
