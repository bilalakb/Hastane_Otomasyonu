
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `deneme`
--
CREATE DATABASE IF NOT EXISTS `deneme` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci;
USE `deneme`;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `doktor`
--

DROP TABLE IF EXISTS `doktor`;
CREATE TABLE IF NOT EXISTS `doktor` (
  `doktor_id` int NOT NULL AUTO_INCREMENT,
  `doktor_adsoyad` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `klinik_id` int NOT NULL,
  PRIMARY KEY (`doktor_id`),
  KEY `klinik_id` (`klinik_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `klinik`
--

DROP TABLE IF EXISTS `klinik`;
CREATE TABLE IF NOT EXISTS `klinik` (
  `klinik_id` int NOT NULL AUTO_INCREMENT,
  `klinik_ad` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  PRIMARY KEY (`klinik_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanici`
--

DROP TABLE IF EXISTS `kullanici`;
CREATE TABLE IF NOT EXISTS `kullanici` (
  `kullanici_id` int NOT NULL AUTO_INCREMENT,
  `kullanici_adsoyad` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `kullanici_tc` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `kullanici_password` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `kullanici_mail` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `kullanici_tel` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  PRIMARY KEY (`kullanici_id`),
  UNIQUE KEY `uc_kullanici_tc` (`kullanici_tc`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `randevu`
--

DROP TABLE IF EXISTS `randevu`;
CREATE TABLE IF NOT EXISTS `randevu` (
  `randevu_id` int NOT NULL AUTO_INCREMENT,
  `randevu_tarih` date DEFAULT NULL,
  `randevu_saat` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  `klinik_id` int DEFAULT NULL,
  `doktor_id` int DEFAULT NULL,
  `kullanici_id` int DEFAULT NULL,
  PRIMARY KEY (`randevu_id`),
  KEY `klinik_id` (`klinik_id`),
  KEY `doktor_id` (`doktor_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sonuc`
--

DROP TABLE IF EXISTS `sonuc`;
CREATE TABLE IF NOT EXISTS `sonuc` (
  `sonuc_id` int NOT NULL AUTO_INCREMENT,
  `hasta_tc` varchar(11) CHARACTER SET utf16 COLLATE utf16_turkish_ci NOT NULL,
  `dosya` longblob,
  PRIMARY KEY (`sonuc_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf16 COLLATE=utf16_turkish_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
