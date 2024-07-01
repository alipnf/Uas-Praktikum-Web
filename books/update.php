<?php include '../components/header.php'; ?>
<?php include '../config/database.php'; ?>

<div class="container mt-5">
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
            echo '<div id="alert" class="alert alert-success mt-4">Buku berhasil diperbarui</div>';
            echo '<script>
                    setTimeout(function() {
                        document.getElementById("alert").style.display = "none";
                        window.location.href = "../index.php";
                    }, 2000); // Hide alert after 2 seconds and redirect
                  </script>';
        } else {
            echo '<div class="alert alert-danger mt-4">Error: ' . $sql . '<br>' . $conn->error . '</div>';
        }
    }
    ?>

    <h2 class="mb-4">Edit Buku</h2>
    <form action="" method="POST" class="needs-validation" novalidate>
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <div class="mb-3">
            <label for="title" class="form-label">Judul:</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo $row['title']; ?>" required>
            <div class="invalid-feedback">Silakan masukkan judul buku.</div>
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Penulis:</label>
            <input type="text" class="form-control" id="author" name="author" value="<?php echo $row['author']; ?>" required>
            <div class="invalid-feedback">Silakan masukkan nama penulis.</div>
        </div>
        <div class="mb-3">
            <label for="published_year" class="form-label">Tahun Terbit:</label>
            <input type="number" class="form-control" id="published_year" name="published_year" value="<?php echo $row['published_year']; ?>" required>
            <div class="invalid-feedback">Silakan masukkan tahun terbit.</div>
        </div>
        <button type="submit" name="update" class="btn btn-primary">Update Buku</button>
    </form>
</div>

<?php include '../components/footer.php'; ?>
