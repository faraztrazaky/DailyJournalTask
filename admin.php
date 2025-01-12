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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>  
        html {
            position: relative;
            min-height: 100%;
        }
        body {
            margin-bottom: 100px; /* Margin bottom by footer height */
        }
        footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 100px; /* Set the fixed height of the footer here */ 
        }
    </style>
  </head>
  <body>
    <!-- Navbar -->
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
                <a class="nav-link" href="admin.php?page=dashboard">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin.php?page=article">Article</a>
            </li>
          </ul>
        </div>
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
    <!-- End Navbar -->

    
<!-- content begin -->
<section id="content" class="p-5">
    <div class="container">
        <?php
        if(isset($_GET['page'])){
        ?>
            <h4 class="lead display-6 pb-2 border-bottom border-primary"><?= ucfirst($_GET['page'])?></h4>
            <?php
            include($_GET['page'].".php");
        }else{
        ?>
            <h4 class="lead display-6 pb-2 border-bottom border-primary">Dashboard</h4>
            <?php
            include("dashboard.php");
        }
        ?>
    </div>
</section>
<!-- content end -->
    <!-- Footer -->
    <footer class="text-center p-3 bg-primary">
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
      <div class="text-dark">Faraztra Zaky &copy; 2024</div>
    </footer>
    <!-- End Footer -->

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
    };

  // Light Theme
  document.getElementById("light").onclick = function () {
    document.body.classList.add("bg-light", "text-dark");
    document.body.classList.remove("bg-dark", "text-white");
  };

</script>
  </body>
</html>
