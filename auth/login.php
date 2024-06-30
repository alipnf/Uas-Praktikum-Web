<?php include '../components/header.php'; ?>
<?php include '../config/database.php'; ?>

<div class="container">
    <h2>Login</h2>
    <form action="" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <input type="submit" name="submit" value="Login">
    </form>
    <p>Don't have an account? <a href="../user/register.php">Register here</a></p>

    <?php
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM user WHERE username='$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                header("Location: ../index.php");
            } else {
                echo "Invalid password";
            }
        } else {
            echo "No user found with that username";
        }
    }
    $conn->close();
    ?>
</div>

<?php include '../components/footer.php'; ?>
