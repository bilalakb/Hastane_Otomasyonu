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
    <link rel="stylesheet" href="hesap.css">
    <title>Hesap Bilgileri</title>
</head>
<body>

<form action="islem.php" method="post">
    <div class="hesab_content">

        <div class="resim">
            <img src="resimler/altfooter2.png" alt="resim" width="300px">
        </div>
        <br>
        <br>
        <div class="label">
            <label>Ad Soyad</label>
            <input type="text" name="kullanici_adsoyad" value="<?php echo $kullanicicek['kullanici_adsoyad']; ?>" disabled style="border-radius: 20px">
        </div>

        <div class="label">
            <label>Tc No</label>
            <input type="text" name="kullanici_tc" value="<?php echo $kullanicicek['kullanici_tc']; ?>" disabled style="border-radius: 20px">

        </div>

        <div class="label">
            <label>Şifre</label>
            <input type="password" name="kullanici_password" value="<?php echo $kullanicicek['kullanici_password']; ?>" disabled style="border-radius: 20px">
        </div>

        <div class="label">
            <label>Telefon No</label>
            <input type="tel" name="kullanici_tel" value="<?php echo $kullanicicek['kullanici_tel']; ?>" disabled style="border-radius: 20px">
        </div>

        <div class="label">
            <label>E-Mail</label>
            <input type="email" name="kullanici_mail" value="<?php echo $kullanicicek['kullanici_mail']; ?>" disabled style="border-radius: 20px">
        </div>


        <button id="guncelleButonu" type="button" >Bilgilerimi Güncelle</button>
        <br>
        <button type="submit" name="guncelle" style="background-color: #007bff">Bilgilerimi Kaydet</button>

        <br>
        <a href="anasayfa.php">
            <button type="button" style="background-color: red"> Ana Sayfaya Dön </button>
        </a>

    </div>
</form>





<script>
    document.getElementById("guncelleButonu").onclick = function() {
        var inputs = document.querySelectorAll(".label input");
        inputs.forEach(function(input) {
            input.removeAttribute("disabled");
        });
    };
</script>



</body>
</html>