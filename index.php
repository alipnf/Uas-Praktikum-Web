<?php include 'components/header.php'; ?>
<?php include 'config/database.php'; ?>

<?php if(!isset($_SESSION['username'])): ?>
    <p>Please <a href="auth/login.php">login</a> to manage the library books.</p>
<?php else: ?>
    <div class="container">
        <h2>Book List</h2>
        <?php
        $sql = "SELECT * FROM buku";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Title</th><th>Author</th><th>Published Year</th><th>Actions</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["title"] . "</td>";
                echo "<td>" . $row["author"] . "</td>";
                echo "<td>" . $row["published_year"] . "</td>";
                echo "<td>";
                echo "<a href='books/update.php?id=" . $row["id"] . "'>Edit</a> | ";
                echo "<a href='books/delete.php?id=" . $row["id"] . "'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
    </div>
<?php endif; ?>

<?php include 'components/footer.php'; ?>
