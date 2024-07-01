<?php include '../components/header.php'; ?> 
<?php include '../config/database.php'; ?> 
<div class="container mt-5"> 
    <?php
    if (isset($_POST['submit'])) {
        // Mengecek apakah form telah disubmit

        $title = $_POST['title'];
        $author = $_POST['author'];
        $published_year = $_POST['published_year'];
        // Mengambil data yang diinputkan user dari form

        $sql = "INSERT INTO buku (title, author, published_year) VALUES ('$title', '$author', '$published_year')";
        // Membuat query SQL untuk menambahkan data buku ke dalam tabel buku

        if ($conn->query($sql) === TRUE) {
            // Mengeksekusi query dan mengecek apakah berhasil
            
            echo '<div id="alert" class="alert alert-success mt-4">Buku baru berhasil ditambahkan</div>';
            // Menampilkan pesan sukses

            echo '<script>
                    setTimeout(function() {
                        document.getElementById("alert").style.display = "none";
                        window.location.href = "/Uas-Praktikum-Web/index.php";
                    }, 1000);
                  </script>';
            // Menyembunyikan pesan sukses setelah 2 detik dan mengalihkan ke halaman index.php
        } else {
            echo '<div class="alert alert-danger mt-4">Error: ' . $sql . '<br>' . $conn->error . '</div>';
            // Menampilkan pesan error jika query gagal
        }
    }
    ?>
    
    <h2 class="mb-4">Tambah Buku Baru</h2>
    <form action="" method="POST" class="needs-validation" novalidate>
        <div class="mb-3">
            <label for="title" class="form-label">Judul:</label>
            <input type="text" class="form-control" id="title" name="title" required>
            <div class="invalid-feedback">Silakan masukkan judul buku.</div>
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Penulis:</label>
            <input type="text" class="form-control" id="author" name="author" required>
            <div class="invalid-feedback">Silakan masukkan nama penulis.</div>
        </div>
        <div class="mb-3">
            <label for="published_year" class="form-label">Tahun Terbit:</label>
            <input type="number" class="form-control" id="published_year" name="published_year" required>
            <div class="invalid-feedback">Silakan masukkan tahun terbit.</div>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Tambah Buku</button>
    </form>
</div>

<?php include '../components/footer.php'; ?>
