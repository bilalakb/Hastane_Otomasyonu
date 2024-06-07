<?php
ob_start();
session_start();
include 'baglan.php';

// Kullanıcı giriş yapmış mı kontrol et
if(!isset($_SESSION['userkullanici_tc'])){
    header("location:giris.php");
    exit;
}

// Giriş yapan kullanıcının bilgilerini çek
$kullanici_tc = $_SESSION['userkullanici_tc'];
$kullanicisor = $db->prepare("SELECT * FROM kullanici WHERE kullanici_tc=:kullanici_tc");
$kullanicisor->execute([':kullanici_tc' => $kullanici_tc]);
$kullanici = $kullanicisor->fetch(PDO::FETCH_ASSOC);
$kullanici_id = $kullanici['kullanici_id'];

// Kullanıcının randevularını çek
$randevularsor = $db->prepare("SELECT randevu.*, klinik.klinik_ad, doktor.doktor_adsoyad 
FROM randevu 
JOIN klinik ON randevu.klinik_id = klinik.klinik_id 
JOIN doktor ON randevu.doktor_id = doktor.doktor_id 
WHERE kullanici_id=:kullanici_id");
$randevularsor->execute([':kullanici_id' => $kullanici_id]);
$randevular = $randevularsor->fetchAll(PDO::FETCH_ASSOC);

// Randevu Silme İşlemi
if (isset($_POST['randevu_id'])) {
    $randevu_id = $_POST['randevu_id'];
    $sil = $db->prepare("DELETE FROM randevu WHERE randevu_id = ?");
    $sil->execute([$randevu_id]);

    if ($sil) {
        header("Location: randevu.php?silme_basarili");
    } else {
        header("Location: randevu.php?silme_basarisiz");
    }
    exit;
}

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Randevularım</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="randevu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>
<body>

<h2>Randevularım</h2>

<table>
    <tr>
        <th>Tarih</th>
        <th>Saat</th>
        <th>Klinik</th>
        <th>Doktor</th>
        <th>İşlem</th>
    </tr>
    <?php foreach($randevular as $randevu): ?>
        <tr>
            <td><?php echo htmlspecialchars($randevu['randevu_tarih']); ?></td>
            <td><?php echo htmlspecialchars($randevu['randevu_saat']); ?></td>
            <td><?php echo htmlspecialchars($randevu['klinik_ad']); ?></td>
            <td><?php echo htmlspecialchars($randevu['doktor_adsoyad']); ?></td>
            <td>
                <form method="POST" action="randevu.php">
                    <input type="hidden" name="randevu_id" value="<?php echo $randevu['randevu_id']; ?>">
                    <button type="submit">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
<br>
<a href="anasayfa.php">
    <button type="submit" style="background-color: red">Ana Sayfaya Dön</button>
</a>
</html>

<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=deneme;charset=utf8", "root", "");
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>
