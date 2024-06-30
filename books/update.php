<?php include '../components/header.php'; ?>
<?php include '../config/database.php'; ?>

<div class="container">
    <h2>Edit Book</h2>

    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "SELECT * FROM buku WHERE id=$id";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    }

    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $author = $_POST['author'];
        $published_year = $_POST['published_year'];

        $sql = "UPDATE buku SET title='$title', author='$author', published_year='$published_year' WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            echo "Book updated successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    ?>

    <form action="" method="POST">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?php echo $row['title']; ?>" required>
        <br>
        <label for="author">Author:</label>
        <input type="text" id="author" name="author" value="<?php echo $row['author']; ?>" required>
        <br>
        <label for="published_year">Published Year:</label>
        <input type="number" id="published_year" name="published_year" value="<?php echo $row['published_year']; ?>" required>
        <br>
        <input type="submit" name="update" value="Update Book">
    </form>
</div>

<?php include '../components/footer.php'; ?>
