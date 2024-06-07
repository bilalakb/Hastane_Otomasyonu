<?php
session_start();
include 'baglan.php';

// Klinik ekleme işlemi
if (isset($_POST['klinik_ekle'])) {
    $klinik_ad = $_POST['klinik_ad'];

    if (isset($db)) {
        $klinik_sorgu = $db->prepare("INSERT INTO klinik (klinik_ad) VALUES (?)");
    }
    $ekle = $klinik_sorgu->execute([$klinik_ad]);

    if ($ekle) {
        header("location:klinik_ekle.php?durum=basarili");
    } else {
        header("location:klinik_ekle.php?durum=basarisiz");
    }
    exit;
}

// Klinik silme işlemi
if (isset($_POST['klinik_sil'])) {
    $klinik_id = $_POST['klinik_id'];

    if (isset($db)) {
        $sil_sorgu = $db->prepare("DELETE FROM klinik WHERE klinik_id = ?");
    }
    $sil = $sil_sorgu->execute([$klinik_id]);

    if ($sil) {
        header("location:klinik_ekle.php?silme_durum=basarili");
    } else {
        header("location:klinik_ekle.php?silme_durum=basarisiz");
    }
    exit;
}

// Tüm klinikleri çekme işlemi
if (isset($db)) {
    $kliniksor = $db->prepare("SELECT * FROM klinik");
}
$kliniksor->execute();
$kliniks = $kliniksor->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Klinik Ekle</title>
    <link rel="stylesheet" href="styles.css">
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

        input[type="text"] {
            padding: 10px;
            width: 200px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-right: 10px;
        }

        button[type="submit"], button[type="delete"] {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: #fff;
        }

        button[type="submit"] {
            background-color: green;
        }

        button[type="submit"]:hover {
            background-color: #1a8b3d;
        }

        button[type="delete"] {
            background-color: red;
        }

        button[type="delete"]:hover {
            background-color: #b71c1c;
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
        }

        th {
            position: relative;
        }

        th::after {
            content: "";
            position: absolute;
            bottom: -1px;
            left: 0;
            right: 0;
            height: 1px;
            background-color: #000;
        }

        .fas {
            font-size: 20px;
        }

        p {
            text-align: center;
            margin-top: 10px;
        }

        .action-header {
            text-align: right;
            padding-right: 30px; /* Buton hizalaması için sağa boşluk ekleyin */
        }

        .action-cell {
            text-align: right;
            width: 100px; /* İşlem sütunu genişliğini ayarlayın */
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

    <h2>Klinik Ekle</h2>
    <hr>
    <form method="POST" action="">
        <input type="text" name="klinik_ad" placeholder="Klinik Adı" required>
        <button type="submit" name="klinik_ekle">Ekle</button>
    </form>
</div>

<?php if(isset($_GET['durum']) && $_GET['durum'] == 'basarili'): ?>

<?php elseif(isset($_GET['durum']) && $_GET['durum'] == 'basarisiz'): ?>

<?php endif; ?>

<?php if(isset($_GET['silme_durum']) && $_GET['silme_durum'] == 'basarili'): ?>

<?php elseif(isset($_GET['silme_durum']) && $_GET['silme_durum'] == 'basarisiz'): ?>

<?php endif; ?>

<div class="container">
    <h2>Mevcut Klinikler</h2>
    <table>
        <tr>
            <th>Klinik Adı</th>
            <th class="action-header">İşlem</th>
        </tr>
        <?php foreach($kliniks as $klinik): ?>
            <tr>
                <td><?php echo htmlspecialchars($klinik['klinik_ad']); ?></td>
                <td class="action-cell">
                    <form method="POST" action="">
                        <input type="hidden" name="klinik_id" value="<?php echo $klinik['klinik_id']; ?>">
                        <button type="delete" name="klinik_sil" class="delete-btn">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

</body>
</html>
