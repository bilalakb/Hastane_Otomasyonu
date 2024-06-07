<?php
include 'header.php';

// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "deneme";

// Veritabanına bağlanma
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol etme
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// Randevu kaydetme işlemi
$message = ""; // Uyarı mesajı için değişken
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tarih'])) {
    $tarih = $_POST['tarih'];
    $saat = $_POST['saat'];
    $klinik_id = $_POST['klinik'];
    $doktor_id = $_POST['doktor'];
    $kullanici_id = isset($_POST['kullanici_id']) ? $_POST['kullanici_id'] : null;

    // Belirtilen tarihte, klinikte ve saatte başka bir randevu var mı kontrol et
    $randevu_check_query = "SELECT * FROM randevu WHERE randevu_tarih = '$tarih' AND randevu_saat = '$saat' AND klinik_id = $klinik_id AND doktor_id = $doktor_id";
    $randevu_check_result = $conn->query($randevu_check_query);

    if ($randevu_check_result->num_rows > 0) {
        $message = "Almak İstediğiniz Randevu Dolu.";
    } else {
        // Randevu kaydetme
        $insert_query = "INSERT INTO randevu (randevu_tarih, randevu_saat, klinik_id, doktor_id, kullanici_id) VALUES ('$tarih', '$saat', $klinik_id, $doktor_id, $kullanici_id)";

        if ($conn->query($insert_query) === TRUE) {
            header('location:anasayfa.php?durum=randevubasarili');
        } else {
            $message = "Hata: " . $insert_query . "<br>" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Ana Sayfa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="anasayfa.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<?php if (!empty($message)): ?>
    <script>
        alert('<?php echo $message; ?>');
    </script>
<?php endif; ?>

<div class="adsoyadd">
    <h4>Sn. <?php if (isset($kullanicicek)) {
            echo $kullanicicek['kullanici_adsoyad'];
        } ?>:</h4>
</div>
<br><br>
<div class="randevu-form" style="background-color:#e0e0e0">
    <h2>Randevu Al</h2>
    <form action="anasayfa.php" method="POST">
        <div class="form-group">
            <label for="tarih">Tarih:</label>
            <input type="date" id="tarih" name="tarih" required>
        </div>

        <label for="saat">Saat:</label>
        <select id="saat" name="saat">
            <option value="09:00">09:00</option>
            <option value="09:30">09:30</option>
            <option value="10:00">10:00</option>
            <option value="10:30">10:30</option>
            <option value="11:00">11:00</option>
            <option value="11:30">11:30</option>
            <option value="12:00">12:00</option>
            <option value="12:30">12:30</option>
            <option value="13:00">13:00</option>
            <option value="13:30">13:30</option>
            <option value="14:00">14:00</option>
            <option value="14:30">14:30</option>
            <option value="15:00">15:00</option>
            <option value="15:30">15:30</option>
            <option value="16:00">16:00</option>
            <option value="16:30">16:30</option>
            <option value="17:00">17:00</option>
            <option value="17:30">17:30</option>
        </select>

        <div class="form-group">
            <label for="klinik">Klinik:</label>
            <select id="klinik" name="klinik" required>
                <option value="">Klinik Seçin</option>
                <?php
                $klinik_query = "SELECT * FROM klinik";
                $klinik_result = $conn->query($klinik_query);
                while ($row = $klinik_result->fetch_assoc()) {
                    echo "<option value='" . $row['klinik_id'] . "'>" . $row['klinik_ad'] . "</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="doktor">Doktor:</label>
            <select id="doktor" name="doktor" required>
                <option value="">Önce klinik seçin</option>
            </select>
        </div>

        <input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id'];?>">

        <button name="randevukaydet" type="submit">Randevu Kaydet</button>
    </form>
</div>
<script>
    $(document).ready(function() {
        $('#klinik').change(function() {
            var klinik_id = $(this).val();
            if (klinik_id) {
                $.ajax({
                    type: 'POST',
                    url: 'doktor_getir.php',
                    data: { klinik_id: klinik_id },
                    success: function(html) {
                        $('#doktor').html(html);
                    }
                });
            } else {
                $('#doktor').html('<option value="">Önce klinik seçin</option>');
            }
        });
    });
</script>
<body>
</html>

<?php
// Veritabanı bağlantısını kapatma
$conn->close();
?>
