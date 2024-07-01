<?php
include '../config/database.php';

if (isset($_GET['id'])) {
    // Mengecek apakah ID buku ada dalam parameter URL

    $id = (int) $_GET['id'];
    // Mengamankan input ID dengan casting ke tipe integer

    $sql = "DELETE FROM buku WHERE id=$id";
    // Membuat query SQL untuk menghapus data buku berdasarkan ID

    if ($conn->query($sql) === TRUE) {
        // Mengeksekusi query dan mengecek apakah berhasil

        echo '<div class="alert alert-success">Buku berhasil dihapus</div>';
        // Menampilkan pesan sukses jika buku berhasil dihapus
    } else {
        echo '<div class="alert alert-danger">Error: ' . $sql . '<br>' . $conn->error . '</div>';
        // Menampilkan pesan error jika query gagal
    }
} else {
    echo '<div class="alert alert-warning">ID buku tidak ditemukan.</div>';
    // Menampilkan pesan peringatan jika ID buku tidak ditemukan dalam parameter URL
}

$conn->close();
// Menutup koneksi ke database
?>

?>
