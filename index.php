<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username'])) {
    header("Location: auth/login.php");
    exit;
}

include 'components/header.php';
include 'config/database.php';
?>

<div class="container mt-5">
    <h2>Daftar Buku</h2>
    <div id="alert-container"></div>
    <a href="books/create.php" class="btn btn-primary mb-3">Tambah Buku</a>
    <?php
    $sql = "SELECT * FROM buku";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<table class="table">';
        echo '<thead><tr><th>ID</th><th>Judul</th><th>Penulis</th><th>Tahun Terbit</th><th>Aksi</th></tr></thead><tbody>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row["id"] . '</td>';
            echo '<td>' . $row["title"] . '</td>';
            echo '<td>' . $row["author"] . '</td>';
            echo '<td>' . $row["published_year"] . '</td>';
            echo '<td>';
            echo '<a href="books/update.php?id=' . $row["id"] . '" class="btn btn-warning btn-sm">Edit</a> ';
            echo '<button class="btn btn-danger btn-sm delete-book" data-id="' . $row["id"] . '">Hapus</button>';
            echo '</td>';
            echo '</tr>';
        }
        echo '</tbody></table>';
    } else {
        echo '<div class="alert alert-info">Tidak ada hasil</div>';
    }
    $conn->close();
    ?>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin ingin menghapus buku ini?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-danger" id="confirmDelete">Hapus</button>
      </div>
    </div>
  </div>
</div>

<?php include 'components/footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
    var bookId;

    $('.delete-book').click(function() {
        bookId = $(this).data('id');
        $('#deleteModal').modal('show');
    });

    $('#confirmDelete').click(function() {
        $.ajax({
            url: 'books/delete.php',
            type: 'GET',
            data: { id: bookId },
            success: function(response) {
                $('#deleteModal').modal('hide');
                $('#alert-container').html(response);
                $('button[data-id="' + bookId + '"]').closest('tr').remove();
            },
            error: function(xhr, status, error) {
                $('#deleteModal').modal('hide');
                $('#alert-container').html('<div class="alert alert-danger">Terjadi kesalahan: ' + error + '</div>');
            }
        });
    });
});
</script>
