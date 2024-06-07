<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Paneli - Ana Sayfa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 100px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .card {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
        }

        .card-item {
            width: 200px;
            margin: 10px;
            padding: 20px;
            text-align: center;
            background-color: #e0e0e0;
            border-radius: 10px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .card-item i {
            font-size: 48px;
            margin-bottom: 10px;
            color: #555;
        }

        .card-item h2 {
            margin-bottom: 10px;
            font-size: 20px;
            color: #333;
        }

        .card-item p {
            color: #777;
        }

        /* Buton stilleri */
        .btn {
            display: inline-block;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .image-container {
            text-align: center;
            margin-top: 20px;
        }

        .image-container img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }
    </style>
</head>
<body>
<div class="container">

    <div class="image-container">
        <img src="resimler/altfooter2.png" alt="Doktor Ekleme" width="300px">
    </div>
    <br>
    <h1>Necmettin Erbakan Üniversitesi Admin Paneli</h1><br>
    <div class="card">
        <div class="card-item">
            <i class="fas fa-clinic-medical"></i>
            <h2>Klinik Yönetimi</h2>
            <p>Klinik yönetimi İçin</p>
            <a href="klinik_ekle.php" target="_blank" class="btn">Detaylar</a>
        </div>

        <div class="card-item">
            <i class="fas fa-user-md"></i>
            <h2>Doktor Yönetimi</h2>
            <p>Doktor yönetimi için</p>
            <a href="doktor_ekle.php" target="_blank" class="btn">Detaylar</a>
        </div>

        <div class="card-item">
            <i class="fas fa-clipboard-check"></i>
            <h2>Sonuç Yönetimi</h2>
            <p>Sonuç yönetimi için</p>
            <a href="sonuc_ekle.php" target="_blank" class="btn">Detaylar</a>
        </div>
    </div>
</div>

</body>
</html>
