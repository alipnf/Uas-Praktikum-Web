<?php
include '../config/database.php';

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];  // Mengamankan input ID dengan casting ke integer

    $sql = "DELETE FROM buku WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo '<div class="alert alert-success">Buku berhasil dihapus</div>';
    } else {
        echo '<div class="alert alert-danger">Error: ' . $sql . '<br>' . $conn->error . '</div>';
    }
} else {
    echo '<div class="alert alert-warning">ID buku tidak ditemukan.</div>';
}
$conn->close();
?>
