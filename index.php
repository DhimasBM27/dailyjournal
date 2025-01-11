<?php
include "koneksi.php"; 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>My Daily Journal</title>
    <link rel="icon" href="img/logo.png" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
  </head>
  <body>
    <!-- nav begin -->
    <nav class="navbar navbar-expand-sm bg-body-tertiary sticky-top">
      <div class="container">
        <a class="navbar-brand" href="#">My Daily Journal</a>
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
            <li class="nav-item">
              <a class="nav-link" href="#schedule">Schedule</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#aboutme">About Me</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login.php" target="_blank">Login</a>
            </li>
            <button
              type="button"
              class="btn btn-dark theme"
              id="dark"
              title="dark"
            >
              <i class="bi bi-moon-stars-fill"></i>
            </button>
            <button
              type="button"
              class="btn btn-danger theme"
              id="light"
              title="light"
            >
              <i class="bi bi-brightness-high"></i>
            </button>
          </ul>
        </div>
      </div>
    </nav>
    <!-- nav end -->
    <!-- hero begin -->
    <section id="hero" class="text-center p-5 bg-danger-subtle text-sm-start">
      <div class="container">
        <div class="d-sm-flex flex-sm-row-reverse align-items-center">
          <img src="data:image/jpeg;base64,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" class="img-fluid" width="300" />
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
    <!-- hero end -->
    <!-- article begin -->
<section id="article" class="text-center p-5">
  <div class="container">
    <h1 class="fw-bold display-4 pb-3">article</h1>
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


<!-- gallery begin -->
<section id="gallery" class="text-center p-5 bg-danger-subtle">
  <div class="container">
    <h1 class="fw-bold display-4 pb-3">Gallery</h1>
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <?php
        include "koneksi.php"; // Include your database connection
        $sql = "SELECT * FROM gallery ORDER BY tanggal DESC"; // Query to fetch gallery data
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          $isActive = true; // Mark the first item as active
          while ($row = $result->fetch_assoc()) {
            $imagePath = "img/" . $row['gambar']; // Path to the image file
            $activeClass = $isActive ? "active" : ""; // Set the first item as active
            echo '
              <div class="carousel-item ' . $activeClass . '">
                <img src="' . $imagePath . '" class="d-block w-100" alt="Gallery Image" />
              </div>';
            $isActive = false; // After the first item, set active to false
          }
        } else {
          echo '<div class="carousel-item active"><img src="default_image.jpg" class="d-block w-100" alt="No image available" /></div>';
        }
        ?>
      </div>
      <!-- Carousel controls -->
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
</section>
<!-- gallery end -->



    <!-- gallery end -->
    <!-- schedule begin -->
    <section id="schedule" class="text-center p-5">
      <div class="container">
        <h1 class="fw-bold display-4 pb-3">Schedule</h1>
        <div class="row row-cols-1 row-cols-md-4 g-4 justify-content-center">
          <div class="col">
            <div class="card h-100">
              <div class="card-header bg-danger text-white">SENIN</div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  Etika Profesi<br />16.20-18.00 | H.4.4
                </li>
                <li class="list-group-item">
                  Sistem Operasi<br />18.30-21.00 | H.4.8
                </li>
              </ul>
            </div>
          </div>
          <div class="col">
            <div class="card h-100">
              <div class="card-header bg-danger text-white">SELASA</div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  Pendidikan Kewarganegaraan<br />12.30-13.10 | Kulino
                </li>
                <li class="list-group-item">
                  Probabilitas dan Statistik<br />15.30-18.00 | H.4.9
                </li>
                <li class="list-group-item">
                  Kecerdasan Buatan<br />18.30-21.00 | H.4.11
                </li>
              </ul>
            </div>
          </div>
          <div class="col">
            <div class="card h-100">
              <div class="card-header bg-danger text-white">RABU</div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  Manajemen Proyek Teknologi Informasi<br />15.30-18.00 | H.4.6
                </li>
              </ul>
            </div>
          </div>
          <div class="col">
            <div class="card h-100">
              <div class="card-header bg-danger text-white">KAMIS</div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  Bahasa Indonesia<br />12.30-14.10 | Kulino
                </li>
                <li class="list-group-item">
                  Pendidikan Agama Islam<br />16.20-18.00 | Kulino
                </li>
                <li class="list-group-item">
                  Penambangan Data<br />18.30-21.00 | H.4.9
                </li>
              </ul>
            </div>
          </div>
          <div class="col">
            <div class="card h-100">
              <div class="card-header bg-danger text-white">JUMAT</div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  Pemrograman Web Lanjut<br />10.20-12.00 | D.2.K
                </li>
              </ul>
            </div>
          </div>
          <div class="col">
            <div class="card h-100">
              <div class="card-header bg-danger text-white">SABTU</div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item">FREE</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- schedule end -->
    <!-- about me begin -->
    <section id="aboutme" class="text-center p-5 bg-danger-subtle">
      <div class="container">
        <div class="d-sm-flex align-items-center justify-content-center">
          <div class="p-3">
            <img
              src="https://watermark.lovepik.com/photo/20211210/large/lovepik-men-aggravate-fitness-equipment-picture_501791770.jpg"
              class="rounded-circle border shadow"
              width="300"
            />
          </div>
          <div class="p-md-5 text-sm-start">
            <h3 class="lead">A11.2023.14891</h3>
            <h1 class="fw-bold">Dhimas Bagus Maulana </h1>
            Program Studi Teknik Informatika<br />
            <a href="https://dinus.ac.id/" class="fw-bold text-decoration-none"
              >Universitas Dian Nuswantoro</a
            >
          </div>
        </div>
      </div>
    </section>
    <!-- about me end -->
    <!-- footer begin -->
    <footer id="footer" class="text-center p-5">
      <div>
        <a href="https://www.instagram.com/udinusofficial"
          ><i class="bi bi-instagram h2 p-2"></i
        ></a>
        <a href="https://twitter.com/udinusofficial"
          ><i class="bi bi-twitter h2 p-2"></i
        ></a>
        <a href="https://wa.me/+62812685577"
          ><i class="bi bi-whatsapp h2 p-2"></i
        ></a>
      </div>
      <div>Dhimas Bagus Maulana &copy; 2023</div>
    </footer>
    <!-- footer end -->

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>
    <script type="text/javascript">
      window.setTimeout("tampilWaktu()", 1000);

      function tampilWaktu() {
        var waktu = new Date();
        var bulan = waktu.getMonth() + 1;

        setTimeout("tampilWaktu()", 1000);
        document.getElementById("tanggal").innerHTML =
          waktu.getDate() + "/" + bulan + "/" + waktu.getFullYear();
        document.getElementById("jam").innerHTML =
          waktu.getHours() +
          ":" +
          waktu.getMinutes() +
          ":" +
          waktu.getSeconds();
      }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript">
      document.getElementById("dark").onclick = function () {
        document.body.style.backgroundColor = "black";

        document
          .getElementById("hero")
          .classList.remove("bg-danger-subtle", "text-black");
        document
          .getElementById("hero")
          .classList.add("bg-secondary", "text-white");

        document
          .getElementById("gallery")
          .classList.remove("bg-danger-subtle", "text-black");
        document
          .getElementById("gallery")
          .classList.add("bg-secondary", "text-white");

        document
          .getElementById("aboutme")
          .classList.remove("bg-danger-subtle", "text-black");
        document
          .getElementById("aboutme")
          .classList.add("bg-secondary", "text-white");

        document.getElementById("footer").classList.remove("text-black");
        document.getElementById("footer").classList.add("text-white");

        document.getElementById("article").classList.remove("text-black");
        document.getElementById("article").classList.add("text-white");

        document.getElementById("schedule").classList.remove("text-black");
        document.getElementById("schedule").classList.add("text-white");

        const collection = document.getElementsByClassName("card");
        for (let i = 0; i < collection.length; i++) {
          collection[i].classList.add("bg-secondary", "text-white");
        }

        const collection2 = document.getElementsByClassName("list-group-item");
        for (let i = 0; i < collection2.length; i++) {
          collection2[i].classList.add("bg-secondary", "text-white");
        }
      };

      document.getElementById("light").onclick = function () {
        document.body.style.backgroundColor = "white";

        document
          .getElementById("hero")
          .classList.remove("bg-secondary", "text-white");
        document
          .getElementById("hero")
          .classList.add("bg-danger-subtle", "text-black");

        document
          .getElementById("gallery")
          .classList.remove("bg-secondary", "text-white");
        document
          .getElementById("gallery")
          .classList.add("bg-danger-subtle", "text-black");

        document
          .getElementById("aboutme")
          .classList.remove("bg-secondary", "text-white");
        document
          .getElementById("aboutme")
          .classList.add("bg-danger-subtle", "text-black");

        document.getElementById("footer").classList.remove("text-white");
        document.getElementById("footer").classList.add("text-black");

        document.getElementById("article").classList.remove("text-white");
        document.getElementById("article").classList.add("text-black");

        document.getElementById("schedule").classList.remove("text-white");
        document.getElementById("schedule").classList.add("text-black");

        const collection = document.getElementsByClassName("card");
        for (let i = 0; i < collection.length; i++) {
          collection[i].classList.remove("bg-secondary", "text-white");
        }

        const collection2 = document.getElementsByClassName("list-group-item");
        for (let i = 0; i < collection2.length; i++) {
          collection2[i].classList.remove("bg-secondary", "text-white");
        }
      };
    </script>
      <script src="path_to_your_script.js"></script>
    <style>
        /* Mengatur ukuran gambar di carousel */
        #carouselExample img {
            width: 100%; /* Gambar memenuhi lebar kontainer */
            height: 800px; /* Menjaga rasio aspek gambar */
            object-fit: contain; /* Menyesuaikan gambar dalam area tanpa merusak rasio */
        }
    </style>
</body>

  
</html>
