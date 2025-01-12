<?php
session_start();
include 'db_connection.php';
$isLoggedIn = isset($_SESSION['username']);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>My Daily Journal</title>
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
  </head>
  <body>
    <!--nav start-->
    <nav class="navbar navbar-expand-lg bg-primary sticky-top">
      <div class="container">
        <a class="navbar-brand" href="#"
          ><img src="img/logoudinus.webp" width="500px" height="100px"
        /></a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-dark">
            <li class="nav-item">
              <a class="nav-link" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#article">Article</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#gallery">Gallery</a>
            </li>
          </ul>
        </div>
        <form class="d-flex" role="search">
          <input
          class="form-control me-2"
          type="search"
          placeholder="Search"
          aria-label="Search"
          />
          <button class="btn btn-outline-dark" type="submit">Search</button>
        </form>
        <div class="p-2">
        <button id="dark" type="button" class="btn btn-dark">
           <i class="bi bi-moon-stars"></i>
         </button>
            <button id="light" type="button" class="btn btn-light">
            <i class="bi bi-brightness-high"></i>
        </button>
        </div>
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-dark">
        <li class="nav-item dropdown">
          <?php if (isset($_SESSION['username'])): ?>
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="bi bi-person-fill"></i>
                  Hi, <?= htmlspecialchars($_SESSION['username']); ?>
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="logout.php">Logout</a></li>
              </ul>
          <?php else: ?>
              <a class="nav-link" href="login.php">
                  <i class="bi bi-person-fill"></i>
                  Login
              </a>
          <?php endif; ?>
         </li>
        </ul>
      </div>
    </nav>
    <!--nav end-->

    <!--hero start-->
    <section id="hero" class="text-center p-5 bg-primary text-sm-start">
      <div class="container">
        <div class="d-sm-flex flex-sm-row-reverse align-items-center">
          <img src="img/banner.webp" class="img-fluid" width="300" />
          <div>
            <h1 class="fw-bold display-4">
              Create Memories, Save Memories, Everyday
            </h1>
            <h4 class="lead display-6">
              Mencatat semua kegiatan sehari-hari yang ada tanpa terkecuali
            </h4>
            <h6>
              <span id="tanggal"></span>
              <span id="jam"></span>
            </h6>
          </div>
        </div>
      </div>
    </section>
    <!--hero end-->

    <!-- article begin -->
    <section id="article" class="text-center p-5">
      <div class="container">
        <h1 class="fw-bold display-4 pb-3">Article</h1>
        <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
          <?php
          $sql = "SELECT * FROM article ORDER BY tanggal DESC";
          $hasil = $conn->query($sql); 

          while($row = $hasil->fetch_assoc()){
          ?>
            <div class="col">
              <div class="card h-100">
                <img src="img/<?= $row["gambar"]?>" class="card-img-top" alt="..." />
                <div class="card-body">
                  <h5 class="card-title"><?= $row["judul"]?></h5>
                  <p class="card-text">
                    <?= $row["isi"]?>
                  </p>
                </div>
                <div class="card-footer">
                  <small class="text-body-secondary">
                    <?= $row["tanggal"]?>
                  </small>
                </div>
              </div>
            </div>
            <?php
          }
          ?> 
        </div>
      </div>
    </section>
    <!-- article end -->

    <!--gallery start-->
    <section id="gallery" class="text-center p-5 bg-primary">
      <div class="container">
        <h1 class="fw-bold display-4 pb-3">Gallery</h1>
        <div id="carouselExample" class="carousel slide">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="img/sun.avif" class="d-block w-100" alt="..." />
            </div>
            <div class="carousel-item">
              <img src="img/praying.avif" class="d-block w-100" alt="..." />
            </div>
            <div class="carousel-item">
              <img src="img/library.avif" class="d-block w-100" alt="..." />
            </div>
            <div class="carousel-item">
              <img src="img/jogging.avif" class="d-block w-100" alt="..." />
            </div>
            <div class="carousel-item">
              <img src="img/bulb.avif" class="d-block w-100" alt="..." />
            </div>
          </div>
          <button
            class="carousel-control-prev"
            type="button"
            data-bs-target="#carouselExample"
            data-bs-slide="prev"
          >
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button
            class="carousel-control-next"
            type="button"
            data-bs-target="#carouselExample"
            data-bs-slide="next"
          >
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
    </section>
    <!--gallery end-->
    <!--footer start-->
    <footer class="text-center p-5">
      <div>
        <a href="https://www.instagram.com/faraztrazaky"
          ><i class="bi bi-instagram h2 p-2 text-dark"></i
        ></a>
        <a href="https://x.com/f24kyyy"
          ><i class="bi bi-twitter-x h2 p-2 text-dark"></i
        ></a>
        <a href="https://wa.me/+62811555068"
          ><i class="bi bi-whatsapp h2 p-2 text-dark"></i
        ></a>
      </div>
      <div>Faraztra Zaky &copy; 2024</div>
    </footer>
    <!--footer end-->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
    <script type="text/javascript">
      window.setTimeout("tampilWaktu()", 1000);

      function tampilWaktu(){
        var waktu = new Date();
        var bulan = waktu.getMonth() + 1;

        function padZero(value) {
        return value < 10 ? "0" + value : value;
        }

        setTimeout("tampilWaktu()", 1000);
        document.getElementById("tanggal").innerHTML = waktu.getDate() + "/" + bulan + "/" + waktu.getFullYear();
        document.getElementById("jam").innerHTML = padZero(waktu.getHours()) + ":" + padZero(waktu.getMinutes()) + ":" + padZero(waktu.getSeconds());
      };
    </script>
<script>
  // Dark Theme
  document.getElementById("dark").onclick = function () {
    document.body.classList.add("bg-dark", "text-white");
    document.body.classList.remove("bg-light", "text-dark");

    // Section Hero
    const heroSection = document.getElementById("hero");
    if (heroSection) {
      heroSection.classList.add("bg-primary","text-dark");
    }

    // Section Article
    const articleSection = document.getElementById("article");
    if (articleSection) {
      articleSection.classList.add("bg-dark", "text-light");
      articleSection.classList.remove("bg-light", "text-dark");
    }

    // Section Gallery
    const gallerySection = document.getElementById("gallery");
    if (gallerySection) {
      gallerySection.classList.add("bg-primary", "text-dark");
    }

    // Untuk semua kartu
    document.querySelectorAll(".card").forEach(function (card) {
      card.classList.add("bg-dark", "text-light");
      card.classList.remove("bg-light", "text-dark");
    });

    // Untuk semua footer di dalam kartu
    document.querySelectorAll(".card-footer").forEach(function (footer) {
      footer.classList.add("bg-secondary", "text-light");
      footer.classList.remove("bg-light", "text-dark");
    });

    // Footer Icons
    document.querySelectorAll("footer i").forEach(function (icon) {
      icon.classList.add("text-light");
      icon.classList.remove("text-dark");
    });
  };

  // Light Theme
  document.getElementById("light").onclick = function () {
    document.body.classList.add("bg-light", "text-dark");
    document.body.classList.remove("bg-dark", "text-white");

    // Section Hero
    const heroSection = document.getElementById("hero");
    if (heroSection) {
      heroSection.classList.add("bg-primary", "text-dark");
      heroSection.classList.remove("bg-dark", "text-light");
    }

    // Section Article
    const articleSection = document.getElementById("article");
    if (articleSection) {
      articleSection.classList.add("bg-light", "text-dark");
      articleSection.classList.remove("bg-dark", "text-light");
    }

    // Untuk semua kartu
    document.querySelectorAll(".card").forEach(function (card) {
      card.classList.add("bg-light", "text-dark");
      card.classList.remove("bg-dark", "text-light");
    });

    // Untuk semua footer di dalam kartu
    document.querySelectorAll(".card-footer").forEach(function (footer) {
      footer.classList.add("bg-light", "text-dark");
      footer.classList.remove("bg-secondary", "text-light");
    });

     // Footer Icons
     document.querySelectorAll("footer i").forEach(function (icon) {
      icon.classList.add("text-dark");
      icon.classList.remove("text-light");
    });
  };

</script>
  </body>
</html>
