<?php
ob_start();
session_start();
include 'baglan.php';

if (isset($db)) {
    $kullanicisor=$db->prepare("SELECT * FROM kullanici WHERE kullanici_tc=:kullanici_tc");
}
$kullanicisor->execute([
    'kullanici_tc' =>$_SESSION['userkullanici_tc']
]);
$say=$kullanicisor->rowCount();
$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);

if ($say==0){
    header("location:giris:php?durum=izinsiz");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Ana Sayfa</title>
</head>
<body>
<div class="ust">
    <a href="karsilama.php"> <img src="resimler/altfooter2.png" alt="resim" style="width: 250px;"> </a>
    <div class="menu">
        <a href="hesap.php"><h4><i style="color: #4CAF50;"class="fas fa-user hesap-icon"></i></h4></a>
        <a href="randevu.php"><h4><i style="color: #4CAF50;"class="far fa-calendar-alt"></i></h4></a>
    </div>
</div>


<div class="cikis">
    <a href="logout.php"><i style="color: red" class="fas fa-sign-out-alt"></i></a>
</div>

</body>
</html>