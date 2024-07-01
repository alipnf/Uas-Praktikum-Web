<?php include '../components/header.php'; ?>
<?php include '../config/database.php'; ?>

<div class="container mt-5">
    <?php
    // Mengecek apakah ID buku ada dalam parameter URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];  // Mendapatkan ID buku dari parameter URL

        // Query untuk mendapatkan data buku berdasarkan ID
        $sql = "SELECT * FROM buku WHERE id=$id";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();  // Mengambil data buku sebagai array asosiatif
    }

    // Mengecek apakah form untuk update buku sudah disubmit
    if (isset($_POST['update'])) {
        $id = $_POST['id'];  // Mendapatkan ID buku dari input hidden form
        $title = $_POST['title'];  // Mendapatkan judul buku dari input form
        $author = $_POST['author'];  // Mendapatkan penulis buku dari input form
        $published_year = $_POST['published_year'];  // Mendapatkan tahun terbit buku dari input form

        // Query untuk mengupdate data buku
        $sql = "UPDATE buku SET title='$title', author='$author', published_year='$published_year' WHERE id=$id";

        // Mengeksekusi query dan mengecek apakah berhasil
        if ($conn->query($sql) === TRUE) {
            echo '<div id="alert" class="alert alert-success mt-4">Buku berhasil diperbarui</div>';
            // Menampilkan pesan sukses jika buku berhasil diperbarui
            echo '<script>
                    setTimeout(function() {
                        document.getElementById("alert").style.display = "none";
                        window.location.href = "../index.php";
                    }, 2000); // Hide alert after 2 seconds and redirect
                  </script>';
            // Mengarahkan kembali ke halaman index setelah 2 detik
        } else {
            echo '<div class="alert alert-danger mt-4">Error: ' . $sql . '<br>' . $conn->error . '</div>';
            // Menampilkan pesan error jika query gagal
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
