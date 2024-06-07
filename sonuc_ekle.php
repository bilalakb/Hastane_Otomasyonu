<?php
ob_start();
session_start();
include 'baglan.php';

// Dosya yükleme işlemi
if(isset($_POST['dosya_yukle'])){
    $kullanici_tc = isset($_POST['kullanici_tc']) ? $_POST['kullanici_tc'] : null;

    // Dosyayı yükleme işlemi
    $dosya_adi = $_FILES['dosya']['name'];
    $dosya_gecici_yol = $_FILES['dosya']['tmp_name'];
    $dosya_uzantisi = pathinfo($dosya_adi, PATHINFO_EXTENSION);

    // Dosyayı oku
    $dosya_icerik = file_get_contents($dosya_gecici_yol);

    // Veritabanına kaydet
    $sorgu = $db->prepare("INSERT INTO sonuc (hasta_tc, dosya) VALUES (?, ?)");
    $sorgu->bindParam(1, $kullanici_tc);
    $sorgu->bindParam(2, $dosya_icerik, PDO::PARAM_LOB);

    if($sorgu->execute()){
        header('Location: sonuc_ekle.php?durum=basarili');
        exit;
    } else {
        header('Location: sonuc_ekle.php?durum=basarisiz');
        exit;
    }
}
?>


<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="adminn_panel_sonuc.css">
    <title>Sonuç</title>
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 50%;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center; /* Resmi ve içeriği ortalamak için */
            margin: 50px auto; /* Sayfanın üst ve alt kısmında boşluk bırakmak için */
        }

        .container img {
            max-width: 250px;
            margin: 0 auto 20px;
        }

        h2 {
            text-align: center;
        }

        form {
            width: 80%;
            margin: 0 auto;
        }

        label {
            font-weight: bold;
        }

        input[type="text"], input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

    </style>
</head>
<body>

<div class="container" style="background-color: #e0e0e0">
    <img src="resimler/altfooter2.png"><br><br>
    <form action="sonuc_ekle.php" method="POST" enctype="multipart/form-data">
        <label for="kullanici_tc">Kullanıcı TC:</label>
        <input type="text" id="kullanici_tc" name="kullanici_tc" required><br><br>

        <label for="dosya">Dosya Seçin:</label>
        <input type="file" id="dosya" name="dosya" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" required><br><br>

        <button type="submit" name="dosya_yukle">Dosyayı Yükle</button>
    </form>
</div>

</body>
</html>
