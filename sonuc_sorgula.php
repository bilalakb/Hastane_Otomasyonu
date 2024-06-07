<?php
ob_start();
session_start();
include 'baglan.php';

// Kullanıcı TC kimlik numarasını al
$kullanici_tc = isset($_POST['kullanici_tc']) ? $_POST['kullanici_tc'] : null;

// Veritabanında sonucu sorgula
$sorgu = $db->prepare("SELECT * FROM sonuc WHERE hasta_tc = ?");
$sorgu->execute([$kullanici_tc]);
$sonuc = $sorgu->fetch(PDO::FETCH_ASSOC);

// Eğer sonuç varsa, dosyayı göster
if ($sonuc) {
    $dosya = $sonuc['dosya'];

    // Dosya tipine göre uygun content type belirlenir
    header('Content-Type: application/pdf'); // Örnek olarak PDF dosyası için
    echo $dosya;
    exit;
} else {
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="sonuc_sorgula.css">
    <title>Sonuç Sorgulama</title>

</head>
<body>
<div class="container">
    <img src="resimler/altfooter2.png" alt="MHRS Logo">
    <h2>Sonuç Sorgulama</h2><br>
    <form action="sonuc_sorgula.php" method="POST">
        <label for="kullanici_tc">TC Kimlik Numarası:</label><br><br>
        <input type="text" id="kullanici_tc" name="kullanici_tc" maxlength="11" required><br>
        <button type="submit">Sonuçları Göster</button>
    </form>
</div>
</body>
</html>

