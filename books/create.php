<?php include '../components/header.php'; ?>
<?php include '../config/database.php'; ?>

<div class="container">
    <h2>Add New Book</h2>
    <form action="" method="POST">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
        <br>
        <label for="author">Author:</label>
        <input type="text" id="author" name="author" required>
        <br>
        <label for="published_year">Published Year:</label>
        <input type="number" id="published_year" name="published_year" required>
        <br>
        <input type="submit" name="submit" value="Add Book">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $author = $_POST['author'];
        $published_year = $_POST['published_year'];

        $sql = "INSERT INTO buku (title, author, published_year) VALUES ('$title', '$author', '$published_year')";

        if ($conn->query($sql) === TRUE) {
            echo "New book added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    $conn->close();
    ?>
</div>

<?php include '../components/footer.php'; ?>
