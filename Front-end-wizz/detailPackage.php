<?php
include('../Admin/security.php');
// require_once('config/koneksi.php');




$id_paket = isset($_GET['id']) ? mysqli_real_escape_string($connection, $_GET['id']) : null;
$query = "SELECT * FROM packages_detail
        INNER JOIN packages ON packages_detail.id_paket = packages.id_paket
        WHERE packages.id_paket = '$id_paket'
        ";

$result = mysqli_query($connection, $query) or die(mysqli_error($connection));

?>


<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">

  <title>Wizz - Wedding Organizer</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Additional CSS Files -->
  <link rel="stylesheet" href="assets/css/fontawesome.css">
  <link rel="stylesheet" href="assets/css/detailPackage.css">
  <link rel="stylesheet" href="assets/css/owl.css">
  <link rel="stylesheet" href="assets/css/animate.css">
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />



</head>

<body>


  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav">
            <!-- ***** Logo Start ***** -->
            <a href="index.html" class="logo">
              <img src="assets/img/WIZZARD.svg" alt="" style="width: 158px;">
            </a>
            <!-- ***** Logo End ***** -->
            <!-- ***** Menu Start ***** -->
            <ul class="nav">
              <li><a href="home.php">Home</a></li>
              <li><a href="package.php">Packages</a></li>
              <li><a href="detailPackage.php" class="active">Detail Packages</a></li>
              <li><a href="login.php">Log In</a></li>
            </ul>
            <a class='menu-trigger'>
              <span>Menu</span>
            </a>
            <!-- ***** Menu End ***** -->
          </nav>
        </div>
      </div>
    </div>
  </header>
  <!-- ***** Header Area End ***** -->

  <?php
  while ($data_paket = mysqli_fetch_array($result)) {
    
    $resultPaketTerkunci = $data_paket['status_terkunci'];

    #$resultPaketTerkunci = mysqli_query($connection, $queryPaketTerkunci);

    if ($resultPaketTerkunci > 0) {
        // Paket sudah terkunci, tidak bisa dipesan
        $paketTerkunci = true;
    } else {
        // Paket belum terkunci, bisa dipesan
        $paketTerkunci = false;
    }

    ?>
    <div class="page-heading header-text">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <h3>
              <?php echo $data_paket['nama_paket']; ?>
            </h3>

          </div>
        </div>
      </div>
    </div>

    <div class="single-product section">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <div class="left-image">
              <img
                src="../Admin/upload/<?php echo $data_paket["gambar"]; ?>"
                alt="">
            </div>
          </div>
          <div class="col-lg-6 align-self-center">
            <h4>
              <?php echo $data_paket['nama_paket']; ?>
            </h4>
            <span class="price"><em>$
                <?php echo $data_paket['harga']; ?>
              </em> $
              <?php echo $data_paket['harga']; ?>
            </span>
            <p>
              <?php echo $data_paket["deskripsi"]; ?>
            </p>
            <form id="qty" action="detailPemesanan.php" method="get">
              <input type="hidden" name="id" value="<?php echo $data_paket['id_paket']; ?>">
              <input type="qty" class="form-control" id="" aria-describedby="quantity" placeholder="1">
              <?php if ($paketTerkunci) { ?>
                <button type="button" disabled><i class="fa fa-shopping-bag"></i> Paket Terkunci</button>
            <?php } else { ?>
                <button type="submit"><i class="fa fa-shopping-bag"></i> Checkout</button>
            <?php } ?>
            </form>




            <ul>
              <li><span>Paket ID:</span>
                <?php echo $data_paket["id_paket"]; ?>
              </li>
              <li><span>Nama paket</span>
                <?php echo $data_paket['nama_paket']; ?></a>
              </li>

            </ul>
          </div>
          <div class="col-lg-12">
            <div class="sep"></div>
          </div>
        </div>
      </div>
    </div>

    <div class="more-info">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="tabs-content">
              <div class="row">
                <div class="nav-wrapper ">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                        data-bs-target="#description" type="button" role="tab" aria-controls="description"
                        aria-selected="true">Rincian paket</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews"
                        type="button" role="tab" aria-controls="reviews" aria-selected="false">Dekorasi</button>
                    </li>
                  </ul>
                </div>
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="description" role="tabpanel"
                    aria-labelledby="description-tab">
                     <!-- Menampilkan deskripsi sebagai list -->
                <ul>
                    <?php
                    // Pecah deskripsi menjadi array
                    $deskripsiList = explode("\n", $data_paket["rincian_paket"]);

                    // Tampilkan setiap elemen sebagai list
                    foreach ($deskripsiList as $deskripsiItem) {
                        echo "<li>$deskripsiItem</li>";
                    }
                    ?>
                </ul>
                  </div>
                  <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                  <div>
                  <img
                src="../Admin/upload/<?php echo $data_paket["gambar_dekorasi"]; ?>"
                alt="">
                  </div>
                
                 <div><img
                src=""
                alt=""></div> 
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php

  }

  ?>



  <div class="section categories related-games">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="section-heading">
            <h6>Packages</h6>
            <h2>Paket lainnya</h2>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="main-button">
            <a href="package.php">View All</a>
          </div>
        </div>

        <?php
        
        $sql = "SELECT * FROM packages
                LIMIT 4
        
        ";
        $all_paket = $connection->query($sql);

        while ($row = mysqli_fetch_assoc($all_paket)) {


          ?>
          <div class="col-lg-3 col-md-6 align-self-center mb-30 trending-items col-md-6 adv">
            <div class="item">
              <h4>
                <?php echo $row['nama_paket']; ?>
              </h4>
              <div class="thumb">
              <a href="detailPackage.php?id=<?php echo $row["id_paket"]; ?>"><img src="../Admin/upload/<?php echo $row["gambar"]; ?>" alt=""></a>
              </div>
            </div>
          </div>

          <?php

        }

        ?>
      </div>
    </div>
  </div>

  <footer>
    <div class="container">
      <div class="col-lg-12">
        <p>Copyright © 2023 WIZZ Company. All rights reserved. &nbsp;&nbsp; <a rel="nofollow"
            href="https://templatemo.com" target="_blank">Design: TemplateMo</a></p>
      </div>
    </div>
  </footer>

  <!-- !-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/isotope.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/counter.js"></script>
  <script src="assets/js/custom.js"></script>

  <script src="assets/js/main.js"></script>


</body>

</html>