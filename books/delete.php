<?php include '../components/header.php'; ?>
<?php include '../config/database.php'; ?>

<div class="container">
    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "DELETE FROM buku WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            echo "Book deleted successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    $conn->close();
    ?>
</div>

<?php include '../components/footer.php'; ?>
