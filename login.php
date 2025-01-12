<?php
include 'db_connection.php'; // Hubungkan dengan file koneksi database

$error = ''; // Variabel untuk menyimpan pesan error

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Hashing password

    // Query untuk memeriksa login berdasarkan username
    $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Login berhasil, simpan username ke sesi
        session_start();
        $_SESSION['username'] = $user['username'];

        // Arahkan berdasarkan username
        if ($user['username'] === 'admin') {
            // Jika username adalah admin
            header("Location: admin.php"); // Redirect ke admin.php
            exit();
        } else {
            // Jika username bukan admin
            header("Location: index.php"); // Redirect ke index.php
            exit();
        }
    } else {
        // Login gagal, tampilkan pesan error
        $error = "Username atau password Anda salah!";
    }

    $stmt->close();
}
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login</title>
    <link rel="icon" href="img/udinus.png"/>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <style>
        /* Gaya tombol close pada mode gelap */
        .modal-content.bg-dark .btn-close {
          filter: invert(1); /* Membuat warna ikon tombol menjadi terang */
        }

        /* Gaya khusus untuk card di mode gelap */
        .card.bg-dark {
            background-color: #343a40;
            color: white;
        }
    </style>  

</head>
  <body>
    <!--nav start-->
    <nav class="navbar navbar-expand-lg bg-primary sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">
              <img src="img/logoudinus.webp" width="500px" height="100px" />
            </a>
            <button
              class="navbar-toggler"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent"
              aria-expanded="false"
              aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-dark">
                <li class="nav-item">
                  <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#article" data-bs-toggle="modal" data-bs-target="#loginModal">Article</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#gallery" data-bs-toggle="modal" data-bs-target="#loginModal">Gallery</a>
                </li>
              </ul>
            </div>
            <form class="d-flex" role="search" data-bs-toggle="modal" data-bs-target="#loginModal">
              <input
                class="form-control me-2"
                type="search"
                placeholder="Search"
                aria-label="Search"
              />
              <button class="btn btn-outline-dark" type="button">Search</button>
            </form>       
        <div class="p-2">
        <button id="dark" type="button" class="btn btn-dark">
           <i class="bi bi-moon-stars"></i>
         </button>
            <button id="light" type="button" class="btn btn-light">
            <i class="bi bi-brightness-high"></i>
        </button>
        </div>
      </div>
    </nav>
    <!--nav end-->

    <!-- Modal Start -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="loginModalLabel">Login Required</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Login</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
    </div>
    <!-- Modal End -->

  <!--Login Start-->
  <div class="container mt-5">
      <div class="row justify-content-center">
          <div class="col-md-6 col-lg-4">
              <div class="card shadow">
                  <div class="card-body p-4">
                      <h2 class="text-center mb-4">Login</h2>
                      <form action="login.php" method="POST">
                          <div class="mb-3">
                              <label for="username" class="form-label">Username</label>
                              <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
                          </div>
                          <div class="mb-3">
                              <label for="password" class="form-label">Password</label>
                              <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                          </div>
                          <div class="d-grid">
                              <button type="submit" class="btn btn-primary">Sign In</button>
                          </div>
                      </form>
                      <!-- Tampilkan pesan error di sini -->
                      <?php if (!empty($error)): ?>
                          <div class="mt-3 alert alert-danger text-center" role="alert">
                              <?php echo $error; ?>
                          </div>
                      <?php endif; ?>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!--Login End-->

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous">
    </script>
    <script>
        // Dark Theme
        document.getElementById("dark").onclick = function () {
        document.body.classList.add("bg-dark", "text-white");
        document.body.classList.remove("bg-light", "text-dark");
    
        // Tambahkan kelas bg-dark ke modal
        const modalContent = document.querySelector(".modal-content");
        modalContent.classList.add("bg-dark");
        modalContent.querySelector(".btn-close").classList.add("btn-close-white");
    
        // Tambahkan kelas bg-dark ke card login
        const loginCard = document.querySelector(".card");
        loginCard.classList.add("bg-dark");
        };
    
        // Light Theme
        document.getElementById("light").onclick = function () {
        document.body.classList.add("bg-light", "text-dark");
        document.body.classList.remove("bg-dark", "text-white");
    
        // Hapus kelas bg-dark dari modal
        const modalContent = document.querySelector(".modal-content");
        modalContent.classList.remove("bg-dark");
        modalContent.querySelector(".btn-close").classList.remove("btn-close-white");
    
        // Hapus kelas bg-dark dari card login
        const loginCard = document.querySelector(".card");
        loginCard.classList.remove("bg-dark");
        };
    </script>
    </body>
</html>
