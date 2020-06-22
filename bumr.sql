-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 03 Jul 2018 pada 17.18
-- Versi Server: 10.1.16-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bumr`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `all_shipping`
--

CREATE TABLE `all_shipping` (
  `allShippingID` int(5) NOT NULL,
  `cityShippingID` int(5) NOT NULL,
  `provShippingID` int(5) NOT NULL,
  `allShippingCost` varchar(20) NOT NULL,
  `allEstimateDay` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `articles`
--

CREATE TABLE `articles` (
  `articleID` int(5) NOT NULL,
  `artCategoryID` int(5) NOT NULL,
  `articleTitle` varchar(35) NOT NULL,
  `articleSeo` varchar(100) NOT NULL,
  `articleDesc` text NOT NULL,
  `articleImage` varchar(100) NOT NULL,
  `createDate` datetime NOT NULL,
  `createUser` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `art_categories`
--

CREATE TABLE `art_categories` (
  `artCategoryID` int(1) NOT NULL,
  `artCategoryName` char(30) NOT NULL,
  `artCategorySeo` varchar(30) NOT NULL,
  `active` char(1) NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `balance`
--

CREATE TABLE `balance` (
  `balanceID` int(5) NOT NULL,
  `balanceValue` varchar(20) NOT NULL,
  `balancePrice` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `balance_order`
--

CREATE TABLE `balance_order` (
  `balanceOrderID` int(5) NOT NULL,
  `memberID` int(50) NOT NULL,
  `balanceID` int(5) NOT NULL,
  `orderInvoice` varchar(30) NOT NULL,
  `statusDeposit` varchar(30) NOT NULL DEFAULT 'Pending',
  `bank` varchar(10) NOT NULL,
  `depoName` varchar(30) NOT NULL,
  `photoD` varchar(100) NOT NULL,
  `paidDate` datetime NOT NULL,
  `finish` char(1) NOT NULL,
  `total1` varchar(20) NOT NULL,
  `dateCreate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bank`
--

CREATE TABLE `bank` (
  `bankID` int(5) NOT NULL,
  `bankName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `carts`
--

CREATE TABLE `carts` (
  `cartID` int(5) NOT NULL,
  `productID` int(5) NOT NULL,
  `memberID` int(5) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(20) NOT NULL,
  `stockCart` int(11) NOT NULL,
  `createDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `carts`
--

INSERT INTO `carts` (`cartID`, `productID`, `memberID`, `quantity`, `price`, `stockCart`, `createDate`) VALUES
(2, 12, 4, 1, 5000000, 10, '2018-06-14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `categoryID` int(5) NOT NULL,
  `categoryName` varchar(50) NOT NULL,
  `categorySeo` varchar(50) NOT NULL,
  `icons` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`categoryID`, `categoryName`, `categorySeo`, `icons`, `title`) VALUES
(13, 'Elektronik', 'elektronik', '7.png', 'Semua Menu Kategori Elektronik'),
(14, 'Handphone', 'handphone', 'icons8-android-100.png', 'Kategori Produk Semua Smartphone'),
(15, 'Komputer', 'komputer', 'icons8-mac-client-100.png', 'Semua Menu Kategori Komputer'),
(16, 'Kantor & Industri', 'kantor--industri', '1.png', 'Semua Menu Kategori Kantor dan Industri'),
(17, 'Mobil', 'mobil', '2.png', 'Semua Menu Kategori Mobil'),
(18, 'Motor', 'motor', '9.png', 'Semua Menu Kategori Motor'),
(19, 'Rumah Tangga', 'rumah-tangga', '6.png', 'Kategori Produk Semua Rumah Tangga'),
(20, 'Olahraga', 'olahraga', 'icons8-ping-pong-100.png', 'Semua Menu Kategori Olahraga'),
(21, 'Sepeda', 'sepeda', '4.png', 'Semua Menu Kategori Sepeda'),
(22, 'Kesehatan', 'kesehatan', '5.png', 'Semua Menu Kategori Kesehatan'),
(23, 'Pelengkapan Bayi', 'pelengkapan-bayi', '11.png', 'Semua Menu Kategori Pelengkapan Bayi & Anak'),
(24, 'Fashion Pria', 'fashion-pria', 'icons8-shirt-100.png', 'Semua Menu Kategori Fashion Pria'),
(25, 'Fashion Wanita', 'fashion-wanita', 'icons8-dress-back-view-100.png', 'Semua Menu Kategori Fashion Wanita'),
(26, 'Fashion Anak', 'fashion-anak', 'icons8-girl-100.png', 'Semua Menu Kategori Fashion Anak'),
(27, 'Hobbi & Koleksi', 'hobbi--koleksi', 'icons8-read-100.png', 'Semua Menu Kategori Hobbi & Koleksi'),
(28, 'Camera', 'camera', 'icons8-camera-100.png', 'Semua Menu Kategori Camera'),
(29, 'Sayur-Mayur', 'sayur', 'icons8-carrot-100.png', 'Semua Menu Kategori Sayuran'),
(30, 'Makanan', 'makanan', 'icons8-meal-100.png', 'Semua Menu Kategori Makanan'),
(31, 'Minuman', 'minuman', 'icons8-soda-100.png', 'Semua Menu Kategori Minuman'),
(32, 'Perabotan', 'perabotan', 'icons8-bureau-100.png', 'Semua Menu Kategori Perabotan'),
(33, 'Buah-Buahan', 'buah', 'icons8-kiwi-100.png', 'Semua Menu Kategori Buah-Buahan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `chat`
--

CREATE TABLE `chat` (
  `chat_id` int(11) NOT NULL,
  `chat_from` int(11) NOT NULL,
  `chat_to` int(11) NOT NULL,
  `message` text NOT NULL,
  `sent` datetime NOT NULL,
  `recd` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cities`
--

CREATE TABLE `cities` (
  `cityID` int(5) NOT NULL,
  `provinceID` int(5) NOT NULL,
  `cityName` varchar(30) NOT NULL,
  `status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `cities`
--

INSERT INTO `cities` (`cityID`, `provinceID`, `cityName`, `status`) VALUES
(1, 1, 'Banda Aceh', 'Y'),
(2, 1, 'Lhokseumawe', 'Y'),
(3, 1, 'Takengon', 'Y'),
(4, 1, 'Langsa', 'Y'),
(5, 1, 'Lhoksukon', 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cities_shipping`
--

CREATE TABLE `cities_shipping` (
  `cityShippingID` int(5) NOT NULL,
  `city` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `compare`
--

CREATE TABLE `compare` (
  `compareID` int(5) NOT NULL,
  `memberID` int(5) NOT NULL,
  `productID` int(5) NOT NULL,
  `compareDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `courier`
--

CREATE TABLE `courier` (
  `courierID` int(5) NOT NULL,
  `courierName` varchar(100) NOT NULL,
  `courierType` char(1) NOT NULL,
  `courierDesc` varchar(100) NOT NULL,
  `status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `favorite`
--

CREATE TABLE `favorite` (
  `favoriteID` int(5) NOT NULL,
  `memberID` int(5) NOT NULL,
  `productID` int(5) NOT NULL,
  `favoriteDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `header`
--

CREATE TABLE `header` (
  `id_header` int(5) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `createDate` datetime NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `header`
--

INSERT INTO `header` (`id_header`, `judul`, `icon`, `createDate`, `status`) VALUES
(1, 'Promo Buah 80% Polimarket', '1.jpg', '2018-05-21 12:31:10', 'Y'),
(2, 'Hot Sale Kelontong Budiman', '2.jpg', '2018-05-21 12:31:42', 'Y'),
(3, 'Big Sale Rempah-Rempah', '3.jpg', '2018-05-21 12:32:16', 'Y'),
(4, 'Promo Whiskas', '4.jpg', '2018-05-21 12:32:51', 'Y'),
(5, 'Promo Mobil', '5.jpg', '2018-05-21 12:34:21', 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kafe`
--

CREATE TABLE `kafe` (
  `id` int(11) NOT NULL,
  `nama_kafe` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kafe`
--

INSERT INTO `kafe` (`id`, `nama_kafe`, `alamat`, `latitude`, `longitude`) VALUES
(1, 'Maliki Coffe', 'rakaya, Rayeuk Meunye, Simpang Raya, Banggai, Sulawesi Tengah', '5.058778', '97.258974'),
(2, 'Rangkaya Coffea', 'JL Exxon Mobil SPG, Rangkaya, Tanah Luas Aceh Utara, Rangkaya, Banda Aceh, Kabupaten Aceh Utara, Aceh 24385', '5.058178', '97.259846'),
(3, 'Seuramo Distro', 'Sp. T. luas- Utara, Rangkaya, Tanah Luas, Kabupaten Aceh Utara, Aceh 24376', '5.056094', '97.259889'),
(4, 'Goet Sa Koepi', 'Rayeuk Meunye, Tanah Luas, Kabupaten Aceh Utara, Aceh 24372', '5.056297', '97.266991'),
(5, 'Warkop Kak Dah', 'warkop kak idah Tanah Luas,, Manyang Seuleumak Bar., Tanah Luas, Kabupaten Aceh Utara, Aceh 24376', '5.051980', '97.255088');

-- --------------------------------------------------------

--
-- Struktur dari tabel `location`
--

CREATE TABLE `location` (
  `locationID` int(5) NOT NULL,
  `courierID` int(5) NOT NULL,
  `cityID` int(5) NOT NULL,
  `provinceID` int(5) NOT NULL,
  `locationName` varchar(100) NOT NULL,
  `status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `members`
--

CREATE TABLE `members` (
  `memberID` int(5) NOT NULL,
  `provinceID` int(5) NOT NULL,
  `cityID` int(5) NOT NULL,
  `courierID` int(5) NOT NULL,
  `shippingID` int(5) NOT NULL,
  `bankID` int(5) NOT NULL,
  `memberName` varchar(100) NOT NULL,
  `gender` char(1) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `rekening` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `codeVerication` varchar(30) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `status` char(1) NOT NULL,
  `createdDate` datetime NOT NULL,
  `lasLogin` datetime NOT NULL,
  `hobi` varchar(20) NOT NULL,
  `nomorKTP` varchar(20) NOT NULL,
  `tanggalLahir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `members`
--

INSERT INTO `members` (`memberID`, `provinceID`, `cityID`, `courierID`, `shippingID`, `bankID`, `memberName`, `gender`, `address`, `phone`, `rekening`, `username`, `email`, `password`, `codeVerication`, `photo`, `status`, `createdDate`, `lasLogin`, `hobi`, `nomorKTP`, `tanggalLahir`) VALUES
(4, 1, 2, 0, 0, 0, 'Rico Alfianda', 'L', '<p>Meunasah Meusjid Punteuet, Kecamatan Blang Mangat, Lhokseumawe</p>', '082272332144', '', 'ricoalfianda', 'ricoalfianda11@gmail.com', 'be89e250d8388c5e7ded2f1630e5daa4', 'AkbcuroURE', 'AL3.jpg', 'Y', '2018-05-15 14:46:09', '0000-00-00 00:00:00', 'Menulis', '12345678910', '1997-09-11'),
(5, 1, 2, 0, 0, 0, 'Reza Rizqullah', 'L', '<p>Blang Jruen, Kab. Aceh Utara, Aceh</p>', '082367285000', '', 'ybreza', 'android.ac3h@gmail.com', 'bb98b1d0b523d5e783f931550d7702b6', 'dztWuLyLVM', 'Capture.JPG', 'Y', '2018-05-17 08:14:41', '0000-00-00 00:00:00', 'Fotografi', '09237184912', '1997-05-11'),
(6, 0, 0, 0, 0, 0, 'Ricky Maulana', '', '', '082276541234', '', 'rickymaulana', 'rickymaulana@gmail.com', '56ea8b83122449e814e0fd7bfb5f220a', 'WtVEcuIRxw', '', 'Y', '2018-06-10 14:23:36', '0000-00-00 00:00:00', 'Olahraga', '0928172635412', '1998-12-12'),
(7, 0, 0, 0, 0, 0, 'Elfida', '', '', '+6282273214567', '', 'elfida11', 'elfida.dedek00@gmail.com', '070d090c5a452d290c86ea9ae9036036', 'BmcWlHmIMu', '', 'Y', '2018-06-10 14:24:36', '0000-00-00 00:00:00', 'Memasak', '0282725162731', '1945-08-17'),
(8, 0, 0, 0, 0, 0, 'Mauliza', '', '', '+6282273214570', '', 'mauliza', 'mauliza@gmail.com', '2856e276d9a6db73994b2440f214b616', 'WvcqQDPeIX', '', 'Y', '2018-06-10 15:10:59', '0000-00-00 00:00:00', 'Fotografi', '85327649168123', '1999-06-21'),
(9, 0, 0, 0, 0, 0, 'Ibrahimovic', '', '', '+6282273214590', '', 'ibrahimovic', 'ibrahimovic@gmail.com', 'a9c1390e5670c244e228e3df1d72ce1c', 'CyHodrassv', '', 'Y', '2018-06-10 15:28:56', '0000-00-00 00:00:00', 'Olahraga', '871238714129', '1980-09-09'),
(13, 0, 0, 0, 0, 0, 'Oci Almegaz', '', '', '+6282272332143', '', 'ocialmegaz', 'ricoalfianda11@yahoo.com', '5d86db523125b49ae6f3f8660a9b798f', 'HYBtKYtPQc', '', 'Y', '2018-06-12 11:04:47', '0000-00-00 00:00:00', 'Menulis', '85327649168123', '1980-11-11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `member_add`
--

CREATE TABLE `member_add` (
  `memberAddID` int(5) NOT NULL,
  `memberID` int(5) NOT NULL,
  `email` varchar(100) NOT NULL,
  `provinceID` int(5) NOT NULL,
  `cityID` int(5) NOT NULL,
  `memberNameAdd` varchar(100) NOT NULL,
  `addressAdd` text NOT NULL,
  `phoneAdd` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `orderID` int(5) NOT NULL,
  `productID` int(11) NOT NULL,
  `memberID` varchar(20) NOT NULL,
  `customerName` varchar(20) NOT NULL,
  `invoice` varchar(30) NOT NULL,
  `statusOrder` varchar(30) NOT NULL DEFAULT 'Pending',
  `dateOrder` datetime NOT NULL,
  `totalOrder` varchar(10) NOT NULL,
  `pendingOrder` char(1) NOT NULL,
  `paidOrder` char(1) NOT NULL,
  `sendOrder` char(1) NOT NULL,
  `acceptOrder` char(1) NOT NULL,
  `rejectOrder` int(2) NOT NULL,
  `accountBank` varchar(10) NOT NULL,
  `totalPaid` varchar(20) NOT NULL,
  `datePaid` datetime NOT NULL,
  `dateSend` datetime NOT NULL,
  `dateFinish` datetime NOT NULL,
  `photo` varchar(100) NOT NULL,
  `dibaca` char(1) NOT NULL DEFAULT 'N',
  `rate` int(11) NOT NULL,
  `catatan` text NOT NULL,
  `resi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`orderID`, `productID`, `memberID`, `customerName`, `invoice`, `statusOrder`, `dateOrder`, `totalOrder`, `pendingOrder`, `paidOrder`, `sendOrder`, `acceptOrder`, `rejectOrder`, `accountBank`, `totalPaid`, `datePaid`, `dateSend`, `dateFinish`, `photo`, `dibaca`, `rate`, `catatan`, `resi`) VALUES
(4, 1, '5', 'Reza Rizqullah', 'BL520180526094939', 'Diterima', '2018-05-26 09:49:39', '9200082', '1', '', '1', '1', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2018-05-26 11:15:43', '', 'Y', 0, '', ''),
(5, 4, '5', 'Reza Rizqullah', 'BL520180529023640', 'Diterima', '2018-05-29 14:36:40', '12750023', '1', '', '1', '1', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2018-05-29 15:14:48', '', 'Y', 5, '', ''),
(6, 3, '5', 'Reza Rizqullah', 'BL520180529031553', 'Diterima', '2018-05-29 15:15:53', '3400014', '1', '', '1', '1', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2018-05-29 17:06:57', '', 'Y', 5, '', ''),
(7, 11, '4', 'Rico Alfianda', 'BL420180610031227', 'Dikembalikan', '2018-06-10 15:12:27', '1000093', '1', '', '1', '', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'Y', 3, '', ''),
(8, 10, '4', 'Rico Alfianda', 'BL420180610032409', 'Diterima', '2018-06-10 15:24:09', '500062', '1', '', '1', '1', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2018-06-10 15:24:52', '', 'Y', 4, '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders_detail`
--

CREATE TABLE `orders_detail` (
  `orderID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `quantity` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `orders_detail`
--

INSERT INTO `orders_detail` (`orderID`, `productID`, `quantity`) VALUES
(4, 3, 1),
(4, 1, 1),
(5, 4, 1),
(6, 3, 1),
(7, 11, 1),
(8, 10, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `productID` int(5) NOT NULL,
  `categoryID` int(5) NOT NULL,
  `subCategoryID` int(5) NOT NULL,
  `memberID` int(5) NOT NULL,
  `productCode` varchar(100) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `productSeo` varchar(100) NOT NULL,
  `salePrice` varchar(20) NOT NULL,
  `conditions` char(1) NOT NULL,
  `qty` char(5) NOT NULL,
  `weight` varchar(5) NOT NULL,
  `discount` varchar(5) NOT NULL,
  `sold` int(5) NOT NULL,
  `status` char(2) NOT NULL DEFAULT 'Y',
  `photo1` varchar(100) NOT NULL,
  `photo2` varchar(100) NOT NULL,
  `photo3` varchar(100) NOT NULL,
  `photo4` varchar(100) NOT NULL,
  `photo5` varchar(100) NOT NULL,
  `photo6` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `ad_type` int(5) NOT NULL DEFAULT '1',
  `hits` int(5) NOT NULL,
  `createDate` datetime NOT NULL,
  `updateDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`productID`, `categoryID`, `subCategoryID`, `memberID`, `productCode`, `productName`, `productSeo`, `salePrice`, `conditions`, `qty`, `weight`, `discount`, `sold`, `status`, `photo1`, `photo2`, `photo3`, `photo4`, `photo5`, `photo6`, `description`, `ad_type`, `hits`, `createDate`, `updateDate`) VALUES
(1, 15, 30, 4, '180517082752', 'Lenovo 500 14ACZ', 'lenovo-500-14acz', '5800000', '2', '19', '1', '0', 1, 'Y', 'c37d0dc5b5542b051c179374f2d15099_20180517082619_Lenovo.JPG', 'd25d432ccfa6f7eec60544c0e301b1fd_20180517082742_2.JPG', '', '', '', '', '<p>For sale Lenovo 500 14ACZ 80K3 14&quot; 2K AMD FX-8800P Radeon R7 + R5 M330. Laptop Gaming Multimedia spek tinggi layar tajam.<br />.<br />Spek:<br />AMD FX-8800P<br />Layar 14&quot; 2K<br />RAM 4GB<br />Radeon R7 512MB<br />Radeon R5 M330 2GB<br />HDD 500GB<br />.<br />Kondisi:<br />Fisik oke eks pemakaian normal.<br />Mesin normal lancar jaya.<br />Baterai Estimasi 2jam pemakaian.<br />Kelengkapan laptop+charger.</p>', 1, 9, '2018-05-17 08:27:52', '0000-00-00 00:00:00'),
(3, 15, 30, 4, '180517084320', 'Asus X42JR', 'asus-x42jr', '3400000', '2', '18', '1', '0', 2, 'Y', 'c8cef774cb38bcb2556ceca45a767dc7_20180517084305_1321.JPG', '9944f42bcfd2d03cc4c707e477b7895e_20180517084309_asd.JPG', '', '', '', '', '<p>For Sale Asus X42JR 14&quot; HD Core i7-740QM Radeon HD 5470. Laptop Multimedia Gaming Dari Asus. Harta murah saja!.</p><p>.<br />Spek:<br />Intel Core i7-740QM<br />Layar 14&quot; HD<br />RAM 4GB<br />Radeon HD 5470 1GB<br />HDD 320GB<br />Windows 7 Original.<br />.<br />Kondisi:<br />Fisik oke gores-gores eks pemakaian normal.<br />Mesin normal lancar jaya.<br />Baterai Estimasi 1/2jam pemakaian normal.<br />Minus: bagian keyboard agak ngangkat, DVD kadang bisa kadang tidak, kamera/Webcam Terbalik.<br />Kelengkapan laptop+charger.</p>', 1, 16, '2018-05-17 08:43:20', '0000-00-00 00:00:00'),
(4, 15, 30, 4, '180517035141', 'MacBook Air', 'macbook-air', '12750000', '2', '4', '1', '0', 1, 'Y', 'c3264059af4712c790ffc9431fb72cbd_20180517035126_a.JPG', '39e79da134d46b8ab3ff9cb7b5c8c5c2_20180517035129_ab.JPG', '333a44f67e06d569d1ad0eee374c49ee_20180517035131_abc.JPG', '818a77a8d72967898e4527331d8ffe4a_20180517035135_abcd.JPG', '4f985e2823b15f252e3a1bca21458338_20180517035139_abcde.JPG', '', '<p>For Sale MacBook Air 11,6&quot; HD Core i7 1.7GHz Haswell CTO Mid 2013 Intel HD Graphics.<br />Masuk Macbook Air Seri tinggi Custom To Order spek tinggi cocok untuk orang yang mobile performa Ngebut.<br />.<br />Spek:<br />Intel Core i7 1.7GHz Haswell<br />Layar 11,6&quot; HD<br />RAM 8GB<br />Intel HD Graphics 5000 1.5GB<br />SSD 500GB<br />Backlit keyboard.<br />.<br />Kondisi:<br />Fisik oke 4titik dent kecil saja.<br />Mesin normal lancar jaya.<br />Baterai Cc: 458, Estimasi 3,5jam pemakaian.<br />Kelengkapan Macbook+charger.</p>', 1, 25, '2018-05-17 15:51:41', '0000-00-00 00:00:00'),
(10, 31, 0, 6, '180610023431', 'Biji Kopi Gayo ', 'biji-kopi-gayo-', '500000', '1', '49', '1', '0', 1, 'Y', '15f18c1faef487d28c38f32feebde2fe_20180610023419_1.JPG', '8b754eedb810a9fdb0dd4885f74d0ad2_20180610023423_3.jpg', '', 'aa6a1dc52024d48d7fb890373c6ca9e5_20180610023425_4.jpg', '961eb31d56037c078e772766da034436_20180610023428_5.jpg', '21b4d1162f837062362a5c74c0024610_20180610023430_6.jpg', '<p>Deskripsi Produk</p><p>Note :<br />- 100% Biji kopi Arabika gayo dengan proses natural wine<br />- untuk biji kopi, jangan lupa menambahkan informasi (giling kasar/halus) dan disertai metode brew, untuk giling kasar disesuaikan dengan penggunaan kertas filter, jika tidak maka kopi akan dikirimkan dalam bentuk biji.<br /><br />Aceh Gayo Wine merupkan kopi dengan sensasi rasa dan aroma Wine (tanpa alkohol) pada Kopi, ini terjadi karena proses pengolahan Kopi membutuhkan waktu lebih lama dari proses natural biasa sehingga aroma yang dihasilkan oleh kulit kopi yang terfermentasi ini terserap oleh biji kopi.<br /><br />Dengan proses yang rumit dan keistimewaan rasa, membuat kopi ini patut untuk bagi para penggemar kopi. Cocok untuk drip, french press, esspresso ataupun tubruk.</p>', 1, 0, '2018-06-10 14:34:31', '0000-00-00 00:00:00'),
(11, 33, 0, 6, '180610023912', 'Buah Kiwi Thailand', 'buah-kiwi-thailand', '1000000', '1', '50', '1', '0', -1, 'Y', '7f0c3da844c1f3215dab38cb0c42961c_20180610023855_1.JPG', '40c7eb9a0937f18f33d9ac7fc30c7eb0_20180610023858_3.jpg', 'cdc4097935ea01fcf5bcf5b3c0beded0_20180610023901_2.jpg', 'a3c133ebdb074acdad955da94112388b_20180610023904_4.jpg', '30826dce476d8e1e2b2dfb4b6578b76f_20180610023908_5.jpg', '19683fef69f2366aa306c10082b929cf_20180610023910_6.jpg', '<p>Buah Kiwi Thailand Impor, Rp 1,000,000 / KG</p>', 1, 8, '2018-06-10 14:39:12', '0000-00-00 00:00:00'),
(12, 33, 0, 4, '180614112804', 'Fak', 'fak', '5000000', '1', '10', '10', '20', 0, 'Y', '19ee3d1d7d3cb1baebf01db0e777fbdb_20180614112802_Screenshot_1.jpg', '', '', '', '', '', '<p>-</p>', 1, 19, '2018-06-14 11:28:04', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `provinces`
--

CREATE TABLE `provinces` (
  `provinceID` int(5) NOT NULL,
  `provinceName` varchar(30) NOT NULL,
  `status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `provinces`
--

INSERT INTO `provinces` (`provinceID`, `provinceName`, `status`) VALUES
(1, 'Aceh', 'Y'),
(2, 'Sumatera Utara', 'Y'),
(3, 'Sumatera Barat', 'Y'),
(4, 'Riau', 'Y'),
(5, 'Kepulauan Riau', 'Y'),
(6, 'Jambi', 'Y'),
(7, 'Sumatera Selatan', 'Y'),
(8, 'Bangka Belitung', 'Y'),
(9, 'Bengkulu', 'Y'),
(10, 'Lampung', 'Y'),
(11, 'Banten', 'Y'),
(12, 'DKI Jakarta', 'Y'),
(13, 'Jawa Barat', 'Y'),
(14, 'Jawa Tengah', 'Y'),
(15, 'D.I. Yogyakarta', 'Y'),
(16, 'Jawa Timur', 'Y'),
(17, 'Bali', 'Y'),
(18, 'Nusa Tenggara Barat', 'Y'),
(19, 'Nusa Tenggara Timur', 'Y'),
(20, 'Kalimantan Barat', 'Y'),
(21, 'Kalimantan Selatan', 'Y'),
(22, 'Kalimantan Tengah', 'Y'),
(23, 'Kalimantan Timur', 'Y'),
(24, 'Kalimantan Utara', 'Y'),
(25, 'Sulawesi Utara', 'Y'),
(26, 'Sulawesi Barat', 'Y'),
(27, 'Sulawesi Tengah', 'Y'),
(28, 'Sulawesi Tenggara', 'Y'),
(29, 'Sulawesi Selatan', 'Y'),
(30, 'Gorontalo', 'Y'),
(31, 'Maluku', 'Y'),
(32, 'Maluku Utara', 'Y'),
(33, 'Papua Barat', 'Y'),
(34, 'Papua', 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `prov_shipping`
--

CREATE TABLE `prov_shipping` (
  `provShippingID` int(5) NOT NULL,
  `provShippingName` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rating`
--

CREATE TABLE `rating` (
  `id` int(5) NOT NULL,
  `rate` int(11) NOT NULL,
  `user` varchar(100) NOT NULL,
  `memberID` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `shipping`
--

CREATE TABLE `shipping` (
  `shippingID` int(5) NOT NULL,
  `courierID` int(5) NOT NULL,
  `cityID` varchar(100) NOT NULL,
  `provinceID` int(5) NOT NULL,
  `estimateDay` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `shipping_weight`
--

CREATE TABLE `shipping_weight` (
  `shippingWeightID` int(5) NOT NULL,
  `shippingID` int(5) NOT NULL,
  `weightFrom` int(11) NOT NULL,
  `weightTo` int(11) NOT NULL,
  `shippingCost` int(11) NOT NULL,
  `shippingStatus` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sub_categories`
--

CREATE TABLE `sub_categories` (
  `subCategoryID` int(5) NOT NULL,
  `categoryID` int(5) NOT NULL,
  `subCategoryName` varchar(50) NOT NULL,
  `subCategorySeo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sub_categories`
--

INSERT INTO `sub_categories` (`subCategoryID`, `categoryID`, `subCategoryName`, `subCategorySeo`) VALUES
(10, 13, 'Televisi', 'televisi'),
(11, 13, 'Lemari Es', 'lemari-es'),
(12, 13, 'Mesin Cuci', 'mesin-cuci'),
(13, 15, 'Akseoris', 'akseoris'),
(14, 15, 'Printer', 'printer'),
(19, 26, 'Anak Laki Laki', 'anak-laki-laki'),
(20, 26, 'Anak Perempuan', 'anak-perempuan'),
(21, 24, 'Tshirt', 'tshirt'),
(22, 24, 'Kemeja', 'kemeja'),
(23, 24, 'Jaket', 'jaket'),
(24, 25, 'Kaos', 'kaos'),
(25, 25, 'Kemeja/Blouse', 'kemejablouse'),
(26, 25, 'Baju Muslim', 'baju-muslim'),
(27, 25, 'Jaket', 'jaket'),
(28, 15, 'Hardware', 'hardware'),
(29, 15, 'Dekstop', 'dekstop'),
(30, 15, 'Laptop', 'laptop'),
(31, 17, 'Sparepart Mobil', 'sparepart-mobil'),
(32, 14, 'Smartphone', 'smartphone'),
(33, 14, 'Smartwatch', 'smartwatch'),
(34, 14, 'Tablet', 'tablet'),
(35, 14, 'Aksesoris Handphone', 'aksesoris-handphone');

-- --------------------------------------------------------

--
-- Struktur dari tabel `suppliers`
--

CREATE TABLE `suppliers` (
  `supplierID` int(5) NOT NULL,
  `supplierName` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `contactPerson` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `userID` int(5) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `rekening` varchar(20) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `lastLogin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`userID`, `email`, `username`, `password`, `fullName`, `rekening`, `contact`, `lastLogin`) VALUES
(1, 'ricoalfianda11@gmail.com', 'rico', 'be89e250d8388c5e7ded2f1630e5daa4', 'Administrator', '-', '082272332144', '2018-05-15 00:00:00'),
(2, 'android.ac3h@gmail.com', 'reza', 'bb98b1d0b523d5e783f931550d7702b6', 'Administrator', '-', '082367285000', '2018-05-15 18:30:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `withdraw`
--

CREATE TABLE `withdraw` (
  `withdrawID` int(5) NOT NULL,
  `tagihanID` varchar(20) NOT NULL,
  `orderID` int(5) NOT NULL,
  `customerID` int(5) NOT NULL,
  `incomeDraw` int(30) NOT NULL,
  `tagDraw` varchar(20) NOT NULL,
  `totalDraw` varchar(20) NOT NULL,
  `sisaDraw` varchar(20) NOT NULL,
  `statusDraw` varchar(20) NOT NULL DEFAULT 'Pending',
  `dateFinish` datetime NOT NULL,
  `dateCreate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `withdraw`
--

INSERT INTO `withdraw` (`withdrawID`, `tagihanID`, `orderID`, `customerID`, `incomeDraw`, `tagDraw`, `totalDraw`, `sisaDraw`, `statusDraw`, `dateFinish`, `dateCreate`) VALUES
(1, 'BL520180519025501', 1, 5, 12750079, '', '', '', 'Pending', '0000-00-00 00:00:00', '2018-05-19 14:55:01'),
(2, 'BL520180519045256', 2, 5, 3400077, '', '', '', 'Pending', '0000-00-00 00:00:00', '2018-05-19 16:52:56'),
(3, 'BL420180522013731', 1, 4, 16150011, '', '', '', 'Pending', '0000-00-00 00:00:00', '2018-05-22 13:37:31'),
(4, 'BL520180522013921', 2, 5, 3400053, '', '', '', 'Pending', '0000-00-00 00:00:00', '2018-05-22 13:39:21'),
(5, 'BL520180526094603', 3, 5, 12750009, '', '', '', 'Pending', '0000-00-00 00:00:00', '2018-05-26 09:46:03'),
(6, 'BL520180526094939', 4, 5, 9200082, '', '', '', 'Masuk', '0000-00-00 00:00:00', '2018-05-26 09:49:39'),
(7, 'BL520180526105827', 5, 5, 38250082, '', '', '', 'Masuk', '0000-00-00 00:00:00', '2018-05-26 10:58:27'),
(8, 'BL520180526105852', 6, 5, 12750010, '', '', '', 'Masuk', '0000-00-00 00:00:00', '2018-05-26 10:58:52'),
(9, 'BL520180526110454', 7, 5, 12750084, '', '', '', 'Pending', '0000-00-00 00:00:00', '2018-05-26 11:04:54'),
(10, 'BL520180529023640', 5, 5, 12750023, '', '', '', 'Masuk', '0000-00-00 00:00:00', '2018-05-29 14:36:40'),
(11, 'BL520180529031553', 6, 5, 3400014, '', '', '', 'Masuk', '0000-00-00 00:00:00', '2018-05-29 15:15:53'),
(12, 'BL420180610031227', 7, 4, 1000093, '', '', '', 'Pending', '0000-00-00 00:00:00', '2018-06-10 15:12:27'),
(13, 'BL420180610032409', 8, 4, 500062, '', '', '', 'Masuk', '0000-00-00 00:00:00', '2018-06-10 15:24:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `all_shipping`
--
ALTER TABLE `all_shipping`
  ADD PRIMARY KEY (`allShippingID`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`articleID`);

--
-- Indexes for table `art_categories`
--
ALTER TABLE `art_categories`
  ADD PRIMARY KEY (`artCategoryID`);

--
-- Indexes for table `balance`
--
ALTER TABLE `balance`
  ADD PRIMARY KEY (`balanceID`);

--
-- Indexes for table `balance_order`
--
ALTER TABLE `balance_order`
  ADD PRIMARY KEY (`balanceOrderID`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`bankID`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cartID`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`cityID`);

--
-- Indexes for table `cities_shipping`
--
ALTER TABLE `cities_shipping`
  ADD PRIMARY KEY (`cityShippingID`);

--
-- Indexes for table `compare`
--
ALTER TABLE `compare`
  ADD PRIMARY KEY (`compareID`);

--
-- Indexes for table `courier`
--
ALTER TABLE `courier`
  ADD PRIMARY KEY (`courierID`);

--
-- Indexes for table `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`favoriteID`);

--
-- Indexes for table `header`
--
ALTER TABLE `header`
  ADD PRIMARY KEY (`id_header`);

--
-- Indexes for table `kafe`
--
ALTER TABLE `kafe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`locationID`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`memberID`);

--
-- Indexes for table `member_add`
--
ALTER TABLE `member_add`
  ADD PRIMARY KEY (`memberAddID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productID`);

--
-- Indexes for table `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`provinceID`);

--
-- Indexes for table `prov_shipping`
--
ALTER TABLE `prov_shipping`
  ADD PRIMARY KEY (`provShippingID`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`shippingID`);

--
-- Indexes for table `shipping_weight`
--
ALTER TABLE `shipping_weight`
  ADD PRIMARY KEY (`shippingWeightID`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`subCategoryID`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplierID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `withdraw`
--
ALTER TABLE `withdraw`
  ADD PRIMARY KEY (`withdrawID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `all_shipping`
--
ALTER TABLE `all_shipping`
  MODIFY `allShippingID` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `articleID` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `art_categories`
--
ALTER TABLE `art_categories`
  MODIFY `artCategoryID` int(1) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `balance`
--
ALTER TABLE `balance`
  MODIFY `balanceID` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `balance_order`
--
ALTER TABLE `balance_order`
  MODIFY `balanceOrderID` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `bankID` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `cartID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `cityID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `cities_shipping`
--
ALTER TABLE `cities_shipping`
  MODIFY `cityShippingID` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `compare`
--
ALTER TABLE `compare`
  MODIFY `compareID` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `courier`
--
ALTER TABLE `courier`
  MODIFY `courierID` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `favorite`
--
ALTER TABLE `favorite`
  MODIFY `favoriteID` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `header`
--
ALTER TABLE `header`
  MODIFY `id_header` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `kafe`
--
ALTER TABLE `kafe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `locationID` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `memberID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `member_add`
--
ALTER TABLE `member_add`
  MODIFY `memberAddID` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `provinces`
--
ALTER TABLE `provinces`
  MODIFY `provinceID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `prov_shipping`
--
ALTER TABLE `prov_shipping`
  MODIFY `provShippingID` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `shippingID` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shipping_weight`
--
ALTER TABLE `shipping_weight`
  MODIFY `shippingWeightID` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `subCategoryID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplierID` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `withdraw`
--
ALTER TABLE `withdraw`
  MODIFY `withdrawID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
