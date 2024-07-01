<?php include '../config/database.php'; ?> <!-- Menghubungkan ke file konfigurasi database -->

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login/Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container mx-auto mt-5" style="width: 500px;">
    <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="tab-login" data-bs-toggle="pill" href="#pills-login" role="tab" aria-controls="pills-login" aria-selected="true">Login</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="tab-register" data-bs-toggle="pill" href="#pills-register" role="tab" aria-controls="pills-register" aria-selected="false">Register</a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
            <form action="" method="POST" class="needs-validation" novalidate>
                <input type="hidden" name="form_type" value="login">
                <!-- Username input -->
                <div class="form-outline mb-4">
                    <input type="text" id="username" name="username" class="form-control" required />
                    <label class="form-label" for="username">Username</label>
                    <div class="invalid-feedback">Please enter your username.</div>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                    <input type="password" id="password" name="password" class="form-control" required />
                    <label class="form-label" for="password">Password</label>
                    <div class="invalid-feedback">Please enter your password.</div>
                </div>

                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary btn-block mb-4">Login</button>

                <!-- Register link -->
                <div class="text-center">
                    <p>Don't have an account? <a href="#" id="register-link">Register here</a></p>
                </div>

                <?php
                if (isset($_POST['submit']) && isset($_POST['form_type']) && $_POST['form_type'] == 'login') { 
                    // Mengecek apakah form login telah disubmit
                    $username = $_POST['username']; // Mengambil data username dari form
                    $password = $_POST['password']; // Mengambil data password dari form

                    $sql = "SELECT * FROM user WHERE username='$username'"; // Query untuk mengambil data user berdasarkan username
                    $result = $conn->query($sql); // Menjalankan query

                    if ($result->num_rows > 0) { // Mengecek apakah username ditemukan
                        $row = $result->fetch_assoc(); // Mengambil data user
                        if (password_verify($password, $row['password'])) { // Mengecek apakah password sesuai
                            $_SESSION['user_id'] = $row['id']; // Menyimpan user_id ke session
                            $_SESSION['username'] = $row['username']; // Menyimpan username ke session
                            header("Location: ../index.php"); // Mengarahkan ke halaman index
                        } else {
                            echo '<div class="alert alert-danger mt-3">Password salah</div>'; // Menampilkan pesan kesalahan jika password salah
                        }
                    } else {
                        echo '<div class="alert alert-danger mt-3">Tidak ditemukan user dengan username tersebut</div>'; // Menampilkan pesan kesalahan jika username tidak ditemukan
                    }
                }
                ?>
            </form>
        </div>

        <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
            <form action="" method="POST" class="needs-validation" novalidate>
                <input type="hidden" name="form_type" value="register">
                <!-- Username input -->
                <div class="form-outline mb-4">
                    <input type="text" id="registerUsername" name="username" class="form-control" required />
                    <label class="form-label" for="registerUsername">Username</label>
                    <div class="invalid-feedback">Please enter a username.</div>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                    <input type="password" id="registerPassword" name="password" class="form-control" required />
                    <label class="form-label" for="registerPassword">Password</label>
                    <div class="invalid-feedback">Please enter a password.</div>
                </div>

                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary btn-block mb-3">Register</button>

                <!-- Login link -->
                <div class="text-center">
                    <p>Already have an account? <a href="#" id="login-link">Login here</a></p>
                </div>

                <?php
                if (isset($_POST['submit']) && isset($_POST['form_type']) && $_POST['form_type'] == 'register') {
                    // Mengecek apakah form register telah disubmit
                    $username = $_POST['username']; // Mengambil data username dari form
                    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Mengambil data password dari form dan melakukan hash

                    $sql = "INSERT INTO user (username, password) VALUES ('$username', '$password')"; // Query untuk memasukkan data user baru

                    if ($conn->query($sql) === TRUE) {
                        echo '<div class="alert alert-success mt-3">User berhasil terdaftar</div>'; // Menampilkan pesan sukses jika user berhasil terdaftar
                    } else {
                        echo '<div class="alert alert-danger mt-3">Error: ' . $sql . '<br>' . $conn->error . '</div>'; // Menampilkan pesan kesalahan jika terjadi error
                    }
                }
                ?>
            </form>
        </div>
    </div>
</div>

<?php include '../components/footer.php'; ?> <!-- Menyertakan footer -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
  (function () {
    'use strict'
    var forms = document.querySelectorAll('.needs-validation')
    Array.prototype.slice.call(forms)
      .forEach(function (form) {
        form.addEventListener('submit', function (event) {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }
          form.classList.add('was-validated')
        }, false)
      })
  })()

  // Script to switch to the register tab when clicking on the register link
  document.getElementById('register-link').addEventListener('click', function (event) {
    event.preventDefault();
    var registerTab = new bootstrap.Tab(document.getElementById('tab-register'));
    registerTab.show();
  });

  // Script to switch to the login tab when clicking on the login link
  document.getElementById('login-link').addEventListener('click', function (event) {
    event.preventDefault();
    var loginTab = new bootstrap.Tab(document.getElementById('tab-login'));
    loginTab.show();
  });
</script>
</body>
</html>
<?php $conn->close(); ?> <!-- Menutup koneksi database -->
