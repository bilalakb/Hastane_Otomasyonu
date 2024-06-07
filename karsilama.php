<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hastane</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
            background-color: #e0e0e0;
        }

        .logo img {
            max-width: 190px;
        }

        .login-register a {
            text-decoration: none;
            margin-left: 20px;
            padding: 8px 15px;
            border: 1px solid #ccc;
            border-radius: 50px;
            color: #333;
        }

        .login-register a i {
            margin-right: 5px;
        }
    </style>
</head>
<body>
<div class="header">
    <div class="logo">
        <img src="resimler/altfooter2.png" alt="Hastane Logo">
    </div>
    <div class="menu">
        <!-- Menü öğeleri buraya gelecek -->
    </div>
    <div class="login-register">
        <a href="sonuc_sorgula.php"><i style="color: #007bff" class="fas fa-file-medical-alt"></i>Sonuç Sorgula</a>
        <a href="giris.php"><i style="color: #4CAF50" class="fas fa-sign-in-alt"></i>Giriş Yap</a>
        <a href="kayit.php"><i style="color: #007bff" class="fas fa-user-plus"></i>Üye Ol</a>
    </div>
</div>

<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="resimler/belcikada-yasayan-turkler-hastane.jpg" class="d-block w-100" alt="..." height="700">
        </div>
        <div class="carousel-item">
            <img src="resimler/ONLINERANDEVU.jpg" class="d-block w-100" alt="..." height="700">
        </div>
        <div class="carousel-item">
            <img src="resimler/neyimvar.jpg" class="d-block w-100" alt="..." height="700">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span> <!-- Önceki resmi gösteren kontrol simgesi -->
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next" >
        <span class="carousel-control-next-icon" aria-hidden="true"></span> <!-- Sonraki resmi gösteren kontrol simgesi -->
        <span class="sr-only">Next</span>
    </a>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
