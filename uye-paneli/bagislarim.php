<!DOCTYPE html>
<html lang="tr">
<head>
    <?php include("../statik/ayarlar.php");
    session_start();
    if(!isset($_SESSION["userLogin"])){
        echo "Bu sayfayı görüntüleme yetkiniz yoktur.";
        header("Refresh: 0.0000000000000001; url=../yonlendirme/yasakli.php");
    }
    ?>
    <title><?php echo($yonetim["DernekAdı"] . " : Aidatlar"); ?></title>
    <?php include("../statik/head.php"); ?>
    <link rel="stylesheet" href="../kaynaklar/panel.css">
</head>
<body>
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#"><?php echo($yonetim["DernekAdı"]) ?></a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3" href="yonlendirme/cikis.php"><i class="fa-solid fa-right-from-bracket"></i> Çıkış Yap</a>
    </div>
  </div>
</header>

<div class="container-fluid">
  <div class="row">
    <?php include("../statik/navbarUye.php"); ?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Bağışlarım</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Bağış ID</th>
              <th scope="col">Bağış Miktarı</th>
              <th scope="col">Bağış Tarihi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $gID=$_GET['id'];
            $bagislarim="SELECT * FROM bağışlar WHERE ÜyeID = $gID ORDER BY BağışID DESC";
            $sorguBagislarim=mysqli_query($baglanti,$bagislarim);
            while( $bagislar=mysqli_fetch_array($sorguBagislarim,MYSQLI_NUM) ){
                echo '<tr> <td> '
                .$bagislar[0].
                '</td>  <td> '
                .$bagislar[1].
                ' TL </td> <td> '
                .$bagislar[2].
                '</td>
                </tr> 
                <br>'; 
            }
            ?>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div> 
    <script src="kaynaklar/bootstrap.bundle.js"></script>
</body>
</html>