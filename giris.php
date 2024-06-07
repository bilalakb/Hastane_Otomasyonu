<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"
    <title></title>
    <link rel="stylesheet" href="giris.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

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
<br><br><br>
<div class="logo-container">
    <img src="resimler/altfooter2.png" class="logo">
</div>
<div class="container">

    <?php
    if (isset($_GET['durum']) && $_GET['durum'] == 'basarisizgiris') {
        echo '<div class="alert">
                <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>
                Tc Kimlik Numarası veya Şifre Hatalı.
              </div>';
    }
    ?>
    <br><br>
    <form action="islem.php" method="post">
        <div class="form-group">
            <label for="tc">
                <i class="fas fa-user user-icon"></i> <!-- Font Awesome kullanıcı ikonu -->
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

        <button type="submit" class="sub" id="giris" name="girisyap">Giriş Yap</button>

    </form>

    <a href="kayit.php" class="register-link">
        <button style="background-color:#007bff">
            <i class="fas fa-user-plus register-icon"></i>
            Üye Ol
        </button>
    </a>

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