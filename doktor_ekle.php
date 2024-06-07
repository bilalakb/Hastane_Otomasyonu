<?php
session_start();
include 'baglan.php';

// Klinik bilgilerini çek
if (isset($db)) {
    $kliniksor = $db->prepare("SELECT * FROM klinik");
}
$kliniksor->execute();
$kliniks = $kliniksor->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['doktor_ekle'])) {
    $doktor_adsoyad = $_POST['doktor_adsoyad'];
    $klinik_id = $_POST['klinik_id'];

    $doktor_sorgu = $db->prepare("INSERT INTO doktor (doktor_adsoyad, klinik_id) VALUES (?, ?)");
    $ekle = $doktor_sorgu->execute([$doktor_adsoyad, $klinik_id]);

    if ($ekle) {
        header("location:doktor_ekle.php?durum=basarili");
    } else {
        header("location:doktor_ekle.php?durum=basarisiz");
    }
    exit;
}

// Klinik seçiminden sonra doktorları listeleme işlemi
if (isset($_POST['klinik_id'])) {
    $klinik_id = $_POST['klinik_id'];
    $doktor_sorgu = $db->prepare("SELECT * FROM doktor WHERE klinik_id = ?");
    $doktor_sorgu->execute([$klinik_id]);
    $doktorlar = $doktor_sorgu->fetchAll(PDO::FETCH_ASSOC);
}

// Doktor silme işlemi
if (isset($_POST['doktor_sil'])) {
    $doktor_id = $_POST['doktor_id'];

    $sil_sorgu = $db->prepare("DELETE FROM doktor WHERE doktor_id = ?");
    $sil = $sil_sorgu->execute([$doktor_id]);

    if ($sil) {
        header("location:doktor_ekle.php?silme_durum=basarili");
    } else {
        header("location:doktor_ekle.php?silme_durum=basarisiz");
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Doktor Ekle</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
        }

        .container {
            background-color: #e0e0e0;
            padding: 20px;
            margin: 20px auto;
            width: 80%;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form {
            text-align: center;
            margin-top: 20px;
        }

        input[type="text"],
        select {
            padding: 10px;
            width: 200px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-right: 10px;
        }

        button[type="submit"],
        button[type="delete"] {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: green;
            color: #fff;
        }

        button[type="submit"]:hover,
        button[type="delete"]:hover {
            background-color: #1a8b3d;
        }

        button[type="delete"] {
            text-align: right;
            padding: 10px 20px; /* Mevcut stil */
            border: none; /* Mevcut stil */
            border-radius: 5px; /* Mevcut stil */
            cursor: pointer; /* Mevcut stil */
            background-color: red; /* Mevcut stil */
            color: #fff; /* Mevcut stil */
        }

        button[type="delete"]:hover {
            background-color: #b71c1c; /* Mevcut stil */
        }

        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
            width: 50%; /* Eklendi: Her sütunun genişliği yüzde olarak belirlendi */
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

    <!-- Doktor Ekle Formu -->
    <h2>Doktor Ekle</h2>
    <hr>
    <form method="POST" action="">
        <input type="text" name="doktor_adsoyad" placeholder="Doktor Adı Soyadı" required>
        <select name="klinik_id" required>
            <option value="">Klinik Seçin</option>
            <?php foreach($kliniks as $klinik): ?>
                <option value="<?php echo $klinik['klinik_id']; ?>"><?php echo $klinik['klinik_ad']; ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit" name="doktor_ekle">Ekle</button>
    </form>
</div>

<div class="container">
    <h2>Mevcut Doktorlar</h2>
    <!-- Klinik Seçim Formu -->
    <form method="POST" action="">
        <label for="klinik_id">Klinik Seçin:</label>
        <select name="klinik_id" id="klinik_id" required>
            <option value="">Klinik Seçin</option>
            <?php foreach($kliniks as $klinik): ?>
                <option value="<?php echo $klinik['klinik_id']; ?>"><?php echo $klinik['klinik_ad']; ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Doktorları Listele</button>
    </form>
    <hr>
    <!-- Doktorlar Tablosu -->
    <?php if(isset($doktorlar) && !empty($doktorlar)): ?>
        <table>
            <tr>
                <th>Doktor Adı Soyadı</th>
                <th style="text-align:center">İşlem</th>
            </tr>
            <?php foreach($doktorlar as $doktor): ?>
                <tr>
                    <td>
                        <?php echo htmlspecialchars($doktor['doktor_adsoyad']); ?>

                    </td>

                    <td>
                        <form method="POST" action="">
                            <input type="hidden" name="doktor_id" value="<?php echo $doktor['doktor_id']; ?>">
                            <button type="delete" name="doktor_sil" onclick="return confirm('Doktoru silmek istediğinize emin misiniz?')"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</div>

<?php if(isset($_GET['durum']) && $_GET['durum'] == 'basarili'): ?>
<?php elseif(isset($_GET['durum']) && $_GET['durum'] == 'basarisiz'): ?>
<?php endif; ?>
</body>
</html>