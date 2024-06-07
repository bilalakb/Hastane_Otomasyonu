<?php
ob_start();
session_start();
include 'baglan.php';

//Kullanıcı kaydetme işlemleri
if(isset($_POST['kullanicikaydet'])){
    $kullanici_tc = isset($_POST['kullanici_tc']) ? $_POST['kullanici_tc'] : null;
    $kullanici_adsoyad = isset($_POST['kullanici_adsoyad']) ? $_POST['kullanici_adsoyad'] : null;
    $kullanici_password = isset($_POST['kullanici_password']) ? $_POST['kullanici_password'] : null;
    $kullanici_mail = isset($_POST['kullanici_mail']) ? $_POST['kullanici_mail'] : null;
    $kullanici_tel = isset($_POST['kullanici_tel']) ? $_POST['kullanici_tel'] : null;


    if (isset($db)) {
        $kullanici_sorgu = $db->prepare("SELECT * FROM kullanici WHERE kullanici_tc = ?");
    }
    $kullanici_sorgu->execute([$kullanici_tc]);
    $kullanici_varmi = $kullanici_sorgu->fetch(PDO::FETCH_ASSOC);
    if ($kullanici_varmi) {
        // Kullanıcı zaten varsa hata mesajı göster
        header('location:kayit.php?durum=aynıtc');
        exit;
    } else {
        $sorgu = $db->prepare('INSERT INTO kullanici SET
            kullanici_tc = ?,
            kullanici_adsoyad = ?,
            kullanici_password = ?,
            kullanici_mail	= ?,
            kullanici_tel = ?
        ');

        $ekle = $sorgu -> execute([
            $kullanici_tc,$kullanici_adsoyad,$kullanici_password,$kullanici_mail,$kullanici_tel
        ]);

        if ($ekle){
            header('location:giris.php?durum=başarili');
        }else{
            $hata = $sorgu ->errorInfo();
            echo 'mysql hatası'.$hata[2];
        }
    }
}

//Kullanıcı giriş yapma işlemi
if (isset($_POST['girisyap'])){
    $kullanici_tc = $_POST['kullanici_tc'];
    $kullanici_password = $_POST['kullanici_password'];


    $kullanicisor = $db->prepare("SELECT * FROM kullanici WHERE kullanici_tc=:kullanici_tc AND kullanici_password=:kullanici_password");
    $kullanicisor->execute([
        ':kullanici_tc' => $kullanici_tc,
        ':kullanici_password' => $kullanici_password
    ]);

    $say = $kullanicisor->rowCount();
    if ($say==1){
        $_SESSION['userkullanici_tc']=$kullanici_tc;
        header('location:anasayfa.php?durum=girisbasarili');
        exit;
    }else{
        header('location:giris.php?durum=basarisizgiris');
        exit;
    }

}


//Randevu Silme İşlemi
if(isset($_POST['randevu_id'])) {
    $randevu_id = $_POST['randevu_id'];


    $sil = $db->prepare("DELETE FROM randevu WHERE randevu_id = ?");
    $sil->execute([$randevu_id]);

    if ($sil) {
        header("location:randevu.php?silme_basarili");
    } else {
        header("location:randevu.php?silme_basarisiz");
    }
}

//Kullanıcının Bilgilerini güncelleme işlemi
if(isset($_POST['guncelle'])){
    $kullanici_adsoyad = isset($_POST['kullanici_adsoyad']) ? $_POST['kullanici_adsoyad'] : null;
    $kullanici_tc = isset($_POST['kullanici_tc']) ? $_POST['kullanici_tc'] : null;
    $kullanici_tel = isset($_POST['kullanici_tel']) ? $_POST['kullanici_tel'] : null;
    $kullanici_mail = isset($_POST['kullanici_mail']) ? $_POST['kullanici_mail'] : null;
    $kullanici_password = isset($_POST['kullanici_password']) ? $_POST['kullanici_password'] : null;

    $guncelleme_sorgusu = $db->prepare("UPDATE kullanici SET 
        kullanici_adsoyad = ?, 
        kullanici_tel = ?, 
        kullanici_mail = ?,
        kullanici_password = ?
        WHERE kullanici_tc = ?");

    $guncelleme_sorgusu->execute([$kullanici_adsoyad, $kullanici_tel, $kullanici_mail, $kullanici_password, $kullanici_tc]);

    if($guncelleme_sorgusu) {
        header("location:hesap.php?güncelleme_basarili");
    } else {
        header("location:hesap.php?güncelleme_basarisiz");
    }
}
?>





