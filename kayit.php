<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Üye Ol</title>
    <link rel="stylesheet" href="kayit.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Font Awesome CSS dosyasını ekleyelim -->

    <style>
        .alert {
            padding: 20px;
            background-color: #f44336; /* Red */
            color: white;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #f44336;
            text-align: center;
            font-size: 20px;
            width: 80%;
            margin: 0 auto;
            max-width: 600px;
        }

        .closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        .closebtn:hover {
            color: black;
        }
    </style>

</head>
<body>

<div class="logo-container">
    <img src="resimler/altfooter2.png" class="logo" style="max-width: 500px">
</div>

<div class="container">
    <?php
    if (isset($_GET['durum']) && $_GET['durum'] == 'aynıtc') {
        echo '<div class="alert">
                <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>
                Bu T.C. Kimlik Numarası ile zaten bir kullanıcı var.
              </div>';
    }
    ?>
    <br><br>
    <form action="islem.php" method="post">
        <div class="form-group">
            <label for="adsoyad">
                <i class="fas fa-user user-icon"></i> <!-- Font Awesome kullanıcı ikonu -->
            </label>
            <input type="text" id="adsoyad" name="kullanici_adsoyad" placeholder="Ad-Soyad" required>
        </div>

        <div class="form-group">
            <label for="tc">
                <i class="fas fa-id-card id-card-icon tc-icon"></i>
            </label>
            <input type="text" id="tc" name="kullanici_tc" placeholder="T.C Kimlik No" required maxlength="11" oninput="validateTC(this)">
        </div>

        <div class="form-group">
            <label for="password">
                <i class="fas fa-lock lock-icon"></i> <!-- Font Awesome kilit ikonu -->
            </label>
            <input type="password" id="password" name="kullanici_password" placeholder="Parola" required>
            <!-- Şifreyi göster/gizle ikonu -->
            <i class="fas fa-eye show-password-icon" onclick="togglePasswordVisibility('password')"></i>
        </div>

        <div class="form-group">
            <label for="email">
                <i class="fas fa-envelope mail-icon"></i>
            </label>
            <input type="email" id="email" name="kullanici_mail" placeholder="E-Mail" required>
        </div>

        <div class="form-group">
            <label for="tel">
                <i class="fas fa-phone phone-icon"></i>
            </label>
            <input type="tel" id="tel"  name="kullanici_tel" placeholder="Telefon-No" required>
        </div>



        <button class="sub" id="giris" name="kullanicikaydet" style="background-color:#007bff">Üye Ol</button>
    </form>

</div>

<script>

    function validateTC(input) {
        // Sadece rakam girişine izin ver
        input.value = input.value.replace(/[^0-9]/g, '');

        // 11 karakter sınırı
        if (input.value.length > 11) {
            input.value = input.value.slice(0, 11);
        }
    }

    function togglePasswordVisibility(inputId) {
        const passwordInput = document.getElementById(inputId);
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    }
</script>

</body>
</html>
