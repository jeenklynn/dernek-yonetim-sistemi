<!DOCTYPE html>
<html lang="tr">
<head>
    <?php include("statik/ayarlar.php");
    session_start();
    if(!isset($_SESSION["login"])){
        echo "Bu sayfayı görüntüleme yetkiniz yoktur.";
        header("Refresh: 0.0000000000000001; url=yonlendirme/yasakli.php");
    }
    ?>
    <title><?php echo($yonetim["DernekAdı"] . " : Aidatlar"); ?></title>
    <?php include("statik/head.php"); ?>
    <link rel="stylesheet" href="kaynaklar/panel.css">
</head>
<body>
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#"><?php echo($yonetim["DernekAdı"]) ?></a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <form action="arama/aidatAra.php" method="GET">
    <input name="query" class="form-control form-control-dark w-100 rounded-0 border-0" type="text" placeholder="Aidat Ara... " aria-label="Search">
	</form>
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3" href="yonlendirme/cikis.php"><i class="fa-solid fa-right-from-bracket"></i> Çıkış Yap</a>
    </div>
  </div>
</header>

<div class="container-fluid">
  <div class="row">
    <?php include("statik/navbar.php"); ?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Aidatlar</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <button type="button" class="btn btn-success btn-sm"><a style="text-decoration: none;" class="text-light" href="islemler/aidat-ekle.php"><i class="fa-solid fa-plus"></i> Aidat Ekle</a></button>
          </div>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Aidat ID</th>
              <th scope="col">Aidat Miktarı</th>
              <th scope="col">Ödeme Tarihi</th>
              <th scope="col">Ödenme Durumu</th>
              <th scope="col">Üye ID</th>
              <th scope="col">Üye Adı</th>
              <th scope="col">Üye Soyadı</th>
              <th scope="col">Seçenekler</th>
            </tr>
          </thead>
          <tbody>
            <?php
            while( $aidatlar=mysqli_fetch_array($sorgu3,MYSQLI_NUM) ){
                $sqlAidatUye="SELECT * FROM Üyeler WHERE ÜyeID = $aidatlar[4]";
                $sorguAidatUye=mysqli_query($baglanti,$sqlAidatUye);
                $aidatUye=mysqli_fetch_assoc($sorguAidatUye);
                echo '<tr> <td> '
                .$aidatlar[0].
                '</td>  <td> '
                .$aidatlar[1].
                ' TL </td> <td> '
                .$aidatlar[2].
                '</td> <td> '
                .$aidatlar[3].
                '</td>  <td> '
                .$aidatlar[4].
                '</td>  <td> '
                .$aidatUye["ÜyeAdı"].
                '</td>  <td> '
                .$aidatUye["ÜyeSoyadı"].
                '</td> 
                <td> 
                <button type="button" class="btn btn-primary btn-sm">
                <a style="text-decoration: none;" class="text-light" href="islemler/aidat-duzenle.php?id='.$aidatlar[0].'"><i class="fa-solid fa-pencil"></i> Düzenle</a>
                </button>
                <button type="button" class="btn btn-danger btn-sm">
                <a style="text-decoration: none;" class="text-light" href="islemler/aidat-sil.php?id='.$aidatlar[0].'"><i class="fa-solid fa-trash-can"></i> Sil</a>
                </button>
                </td>
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