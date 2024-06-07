<?php
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

if (isset($_POST['klinik_id'])) {
    $klinik_id = $_POST['klinik_id'];

    $doktor_query = "SELECT * FROM doktor WHERE klinik_id = $klinik_id";
    $doktor_result = $conn->query($doktor_query);

    if ($doktor_result->num_rows > 0) {
        echo '<option value="">Doktor Seçin</option>';
        while ($row = $doktor_result->fetch_assoc()) {
            echo "<option value='" . $row['doktor_id'] . "'>" . $row['doktor_adsoyad'] . "</option>";
        }
    } else {
        echo '<option value="">Doktor bulunamadı</option>';
    }
}

// Veritabanı bağlantısını kapatma
$conn->close();
?>
