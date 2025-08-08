-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 14, 2024 lúc 05:17 AM
-- Phiên bản máy phục vụ: 10.4.27-MariaDB
-- Phiên bản PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `php-cellphones`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `adminId` int(11) NOT NULL,
  `adminName` varchar(255) NOT NULL,
  `adminEmail` varchar(150) NOT NULL,
  `adminUser` varchar(255) NOT NULL,
  `adminPass` varchar(255) NOT NULL,
  `level` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_admin`
--

INSERT INTO `tbl_admin` (`adminId`, `adminName`, `adminEmail`, `adminUser`, `adminPass`, `level`) VALUES
(1, 'Namphuong', 'phuongnam30702@gmail.com', 'Namphuong', 'e10adc3949ba59abbe56e057f20f883e', 0),
(2, 'Nghĩa', 'nghia@gmail.com', 'nghia52', '202cb962ac59075b964b07152d234b70', 0),
(3, 'admin', 'admin@gmail.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', 0),
(14, 'pho duc nghia', 'nghia52@gmail.com', 'nghia0', '202cb962ac59075b964b07152d234b70', 0),
(15, 'pho duc nghia', 'nghia52@gmail.com', 'nghia789', '202cb962ac59075b964b07152d234b70', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `brandId` int(11) NOT NULL,
  `brandName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_brand`
--

INSERT INTO `tbl_brand` (`brandId`, `brandName`) VALUES
(1, 'Apple'),
(2, 'SamSung');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cartId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `sId` varchar(255) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` varchar(200) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(200) NOT NULL,
  `customer_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_cart`
--

INSERT INTO `tbl_cart` (`cartId`, `productId`, `sId`, `productName`, `price`, `quantity`, `image`, `customer_Id`) VALUES
(322, 56, '', 'iPhone 16 512GB', '23990000', 1, 'f2cf763b2c.jpeg', 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_category`
--

CREATE TABLE `tbl_category` (
  `catId` int(11) NOT NULL,
  `catName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_category`
--

INSERT INTO `tbl_category` (`catId`, `catName`) VALUES
(2, 'iPhone'),
(3, 'iPad'),
(4, 'MacBook'),
(5, 'AirPods'),
(6, 'HomePod'),
(7, 'Accessories'),
(8, 'Magic Keyboard');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_contact`
--

CREATE TABLE `tbl_contact` (
  `id` int(11) NOT NULL,
  `customer_Id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_contact`
--

INSERT INTO `tbl_contact` (`id`, `customer_Id`, `name`, `email`, `phone`, `message`, `created_at`) VALUES
(7, 4, '123', '123', '123', '123', '2024-11-28 14:35:41'),
(8, 4, '123', '123', '123', '123', '2024-11-28 14:35:46'),
(9, 4, '123', '123', '123', '123', '2024-11-28 14:35:47'),
(11, 12, 'nghia', 'nghia0502@gmail.com', '0397981261', 'qựneiljsankdnaksdklndsakldhasildnasildnsaklndailsdnasildnaslindasilnd', '2024-11-28 15:30:35'),
(12, 4, '123', '567657', '7657567', 'rgrgsgsdgsd', '2024-11-28 21:29:48'),
(13, 4, 'nidsand', 'nghia', '1234567889', 'dnsaildnilsanld', '2024-11-29 10:23:35'),
(14, 4, 'Phó Đức Nghĩa', 'pdnghia0502@gmail.com', '123456', 'nkdsahdjklsahd', '2024-12-12 09:24:15');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `Id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `emailguest` varchar(50) DEFAULT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_customer`
--

INSERT INTO `tbl_customer` (`Id`, `name`, `address`, `emailguest`, `phone`, `email`, `password`) VALUES
(4, 'hhhh', 'thái nguyên', '123', '111111', 'nghia@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(5, 'Nghĩa', 'Ngõ 290 Đường Lưu Nhân Trú Phường Hương Sơn', '321', '0397981261', 'pdnghia0502@gmail.com', '202cb962ac59075b964b07152d234b70'),
(7, 'Đức Nghĩa', 'admokajakd', 'pdnghia0502@gmail.com', '123456', 'pdnghia@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(10, 'hhhh', 'admokajakd', '', '123456', 'nghia0@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(11, 'Phó Đức Nghĩa', 'thai nguyen', '', '123456', 'pducnghia0502@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(12, 'nghia0502', 'Hà nội', 'nghia2002@gmail.com', '0397981261', 'nghia2002@gmail.com', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_order`
--

CREATE TABLE `tbl_order` (
  `Id` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `customer_Id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `date_order` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_order`
--

INSERT INTO `tbl_order` (`Id`, `productId`, `productName`, `customer_Id`, `quantity`, `price`, `image`, `status`, `date_order`) VALUES
(51, 15, 'iPad Air 5 10.9 inch 64GB', 7, 2, '27980000', '8a617230e2.jpg', 1, '2024-11-27 12:07:59'),
(73, 4, 'AirPods Pro 2 Bluetooth', 7, 1, '4390000', 'eb3036f572.jpg', 4, '2024-11-27 15:41:41'),
(74, 17, 'iPhone 16 Pro Max 256GB', 7, 2, '67980000', '6492f8f23b.jpeg', 4, '2024-11-28 09:30:25'),
(92, 16, 'iPhone 15 Pro Max 256G', 12, 8, '236720000', '736a5303ef.jpg', 1, '2024-11-28 13:02:58'),
(100, 15, 'iPad Air 5 10.9 inch 64GB', 7, 1, '13990000', '8a617230e2.jpg', 1, '2024-11-29 02:37:09'),
(124, 53, 'Macbook Pro M2 512GB', 4, 3, '74970000', '410b2dbb07.jpg', 6, '2024-12-12 03:23:06'),
(141, 18, 'iPhone 16 Pro Max 512GB', 4, 1, '29590000', '45c9cd6764.jpeg', 6, '2024-12-13 06:48:03'),
(152, 23, 'iPhone 13 128GB', 4, 2, '26580000', 'f80cf5f37b.jpeg', 3, '2024-12-13 10:20:35'),
(153, 27, 'iPhone 14 Pro Max 128GB', 4, 3, '64470000', 'abb4031433.png', 2, '2024-12-13 10:20:49'),
(154, 24, 'iPhone 13 Pro Max 256GB', 4, 1, '23990000', 'fa49cdbb92.png', 3, '2024-12-13 10:26:42'),
(155, 46, 'Magic Keyboard 2021 MK293', 4, 1, '3290000', '3f7cd74e42.jpg', 5, '2024-12-13 10:28:19'),
(156, 47, 'Apple Pencil 2023 (MUWA3)', 4, 3, '6570000', 'de6f5adf2b.png', 5, '2024-12-13 10:31:53'),
(158, 18, 'iPhone 16 Pro Max 512GB', 4, 5, '147950000', '45c9cd6764.jpeg', 2, '2024-12-13 15:01:24');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_product`
--

CREATE TABLE `tbl_product` (
  `productId` int(11) NOT NULL,
  `productName` tinytext NOT NULL,
  `catId` int(11) NOT NULL,
  `brandId` int(11) NOT NULL,
  `product_desc` text NOT NULL,
  `type` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `quantity_in_stock` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_product`
--

INSERT INTO `tbl_product` (`productId`, `productName`, `catId`, `brandId`, `product_desc`, `type`, `price`, `image`, `quantity_in_stock`) VALUES
(1, 'iPad Pro 11 128GB', 3, 1, '<p>-Thiết kế phẳng mạnh mẽ - Gia c&ocirc;ng từ kim loại bền bỉ, phong c&aacute;ch hiện đại, sang trọng<br />-Hiệu năng mạnh mẽ với CPU thế hệ mới - chip Apple M2 trong đ&oacute; c&oacute; 8 l&otilde;i c&ugrave;ng RAM 8 GB<br />-M&agrave;n h&igrave;nh s&aacute;ng hơn, hỗ trợ nội dung HDR tốt hơn - 11 inch LCD, 600 nits<br />-Thoải m&aacute;i s&aacute;ng tạo v&agrave; thiết kế - Nhận diện b&uacute;t Apple Pencil 2 si&ecirc;u nhanh v&agrave; nhạy</p>', 0, '17900000', '681a7dfc98.jpg', 6),
(2, 'iPhone 14 Pro Max 256GB', 2, 1, '<p>-M&agrave;n h&igrave;nh Dynamic Island - Sự biến mất của m&agrave;n h&igrave;nh tai thỏ thay thế bằng thiết kế vi&ecirc;n thuốc, OLED 6,7 inch, hỗ trợ always-on display<br />-Cấu h&igrave;nh iPhone 14 Pro Max mạnh mẽ, hiệu năng cực khủng từ chipset A16 Bionic<br />-L&agrave;m chủ c&ocirc;ng nghệ nhiếp ảnh - Camera sau 48MP, cảm biến TOF sống động<br />-Pin liền lithium-ion kết hợp c&ugrave;ng c&ocirc;ng nghệ sạc nhanh cải tiến</p>\r\n<div id=\"gtx-trans\" style=\"position: absolute; left: -51px; top: 21.8px;\">&nbsp;</div>', 1, '25300000', '355b6d9e7b.jpg', 12),
(3, 'Apple Pencil 2', 7, 1, '<p>-Thiết kế đơn giản tinh tế với gam m&agrave;u trắng k&iacute;ch thước chiều d&agrave;i 16.6 cm v&agrave; trọng lượng 20.7 g<br />-Kết nối kh&ocirc;ng d&acirc;y Bluetooth với iPad cho cảm gi&aacute;c sử dụng tương tự b&uacute;t th&ocirc;ng dụng<br />-Sạc pin nam ch&acirc;m từ t&iacute;nh ngay tr&ecirc;n thiết bị Ipad, sạc đầy trong 45 ph&uacute;t, sử dụng đến 4 giờ<br />-C&ocirc;ng nghệ cảm ứng lực nhấn cho độ trễ thấp, độ nhạy v&agrave; ch&iacute;nh x&aacute;c cao<br />-Dễ d&agrave;ng thao t&aacute;c chuyển đổi c&ocirc;ng cụ b&uacute;t bằng cảm ứng tr&ecirc;n th&acirc;n b&uacute;t</p>\r\n<div id=\"gtx-trans\" style=\"position: absolute; left: -47px; top: 21.8px;\">&nbsp;</div>', 1, '2390000', '818c7856d3.jpg', 7),
(4, 'AirPods Pro 2 Bluetooth', 5, 1, '<p>-T&iacute;ch hợp chip Apple H2 mang đến chất &acirc;m sống động c&ugrave;ng khả năng t&aacute;i tạo &acirc;m thanh 3 chiều vượt trội<br />-C&ocirc;ng nghệ Bluetooth 5.3 kết nối ổn định, mượt m&agrave;, ti&ecirc;u thụ năng lượng thấp, gi&uacute;p tiết kiệm pin đ&aacute;ng kể<br />-Chống ồn chủ động loại bỏ tiếng ồn hiệu quả gấp đ&ocirc;i thế hệ trước, gi&uacute;p n&acirc;ng cao trải nghiệm nghe nhạc<br />-Chống nước chuẩn IPX4 tr&ecirc;n tai nghe v&agrave; hộp sạc, gi&uacute;p bạn thỏa sức tập luyện kh&ocirc;ng cần lo thấm mồ h&ocirc;i</p>\r\n<div id=\"gtx-trans\" style=\"position: absolute; left: -11px; top: -20px;\">&nbsp;</div>', 0, '4390000', 'eb3036f572.jpg', 0),
(5, 'Macbook Air M2 256GB', 4, 1, '<p>-Thiết kế sang trọng, lịch l&atilde;m - si&ecirc;u mỏng 11.3mm, chỉ 1.24kg<br />-Hiệu năng h&agrave;ng đầu - Chip Apple M2, 8 nh&acirc;n GPU, hỗ trợ tốt c&aacute;c phần mềm như Word, Axel, Adoble Premier<br />-Đa nhiệm mượt m&agrave; - Ram 8GB, SSD 256GB cho ph&eacute;p vừa l&agrave;m việc, vừa nghe nhạc<br />-M&agrave;n h&igrave;nh sắc n&eacute;t - Độ ph&acirc;n giải 2560 x 1664 c&ugrave;ng độ s&aacute;ng 500 nits<br />-&Acirc;m thanh sống động - 4 loa tramg bị c&ocirc;ng nghệ Dolby Atmos v&agrave; &acirc;m thanh đa chiều</p>\r\n<div id=\"gtx-trans\" style=\"position: absolute; left: -43px; top: -20px;\">&nbsp;</div>', 1, '25200000', '482b7c3f77.jpg', 7),
(7, 'MacBook Pro M2 256GB', 4, 1, '<p>-Chip M2 mới nhất - hiệu năng h&agrave;ng đầu, thoải m&aacute;i sử dụng c&aacute;c phần mềm đồ hoạ hay render video<br />-M&agrave;n h&igrave;nh Retina - m&agrave;u sắc hiển thị sống động tạo ra kh&ocirc;ng gian giải tr&iacute; đỉnh cao<br />-Thiết kế sang trọng - Trọng lượng m&aacute;y chỉ 1.4kg, độ d&agrave;y chỉ 15.6mm gi&uacute;p bạn dễ d&agrave;ng mang theo<br />-&Acirc;m thanh ch&acirc;n thật - T&iacute;ch hợp loa k&eacute;p c&ugrave;ng c&ocirc;ng nghệ Dolby Atmos mang đến chất lượng &acirc;m thanh tuyệt vời</p>', 1, '23990000', 'ff3eb35607.jpg', 3),
(8, 'Apple Pencil 1', 7, 1, '<p>-Kiểu d&aacute;ng tối giản, r&aacute;t gọn g&agrave;ng vừa tay c&ugrave;ng m&agrave;u trắng thanh lịch phủ khắp th&acirc;n b&uacute;t<br />-Nhận diện được lực nhấn từ b&agrave;n tay người d&ugrave;ng hiệu quả để thể hiện n&eacute;t b&uacute;t đậm nhạc<br />-Phản hồi nhanh với độ trễ gần như kh&ocirc;ng c&oacute; tr&ecirc;n mỗi đường b&uacute;t, mỗi thao t&aacute;c<br />-Cơ chế qu&eacute;t t&iacute;n hiệu li&ecirc;n tục với tần suất 240fps, gần như kh&ocirc;ng c&oacute; độ trễ khi sử dụng<br />-Đến 2 phương thức sạc cho bạn Lightning to Lightning v&agrave; Lightning to USB-C</p>\r\n<div id=\"gtx-trans\" style=\"position: absolute; left: -133px; top: 21.8px;\">&nbsp;</div>', 0, '1590000', '31625c4ee7.jpg', 20),
(10, 'Magic Keyboard for iPad', 8, 1, '<p>B&agrave;n ph&iacute;m Magic Keyboard cho Apple iPad Pro 11 l&agrave; sản phẩm gi&uacute;p iPad gi&uacute;p khẳng định tham vọng thay thế m&aacute;y t&iacute;nh x&aacute;ch tay trong tương lai của Apple. So với chiếc b&agrave;n ph&iacute;m kh&ocirc;ng d&acirc;y, Magic Keyboad tr&ecirc;n MacBook Pro ra mắt năm ngo&aacute;i, chiếc b&agrave;n ph&iacute;m mới n&agrave;y c&oacute; cơ chế ph&iacute;m \"cắt k&eacute;o\".....</p>', 1, '4890000', 'f67d7c8fb0.jpg', 4),
(11, 'iPhone 13 Pro Max 128GB', 2, 1, '<p>-Hiệu năng vượt trội - Chip Apple A15 Bionic mạnh mẽ, hỗ trợ mạng 5G tốc độ cao<br />-Kh&ocirc;ng gian hiển thị sống động - M&agrave;n h&igrave;nh 6.1\" Super Retina XDR độ s&aacute;ng cao, sắc n&eacute;t<br />-Trải nghiệm điện ảnh đỉnh cao - Camera k&eacute;p 12MP, hỗ trợ ổn định h&igrave;nh ảnh quang học<br />-Tối ưu điện năng - Sạc nhanh 20 W, đầy 50% pin trong khoảng 30 ph&uacute;t</p>', 0, '16690000', 'd49361c389.jpg', 6),
(15, 'iPad Air 5 10.9 inch 64GB', 3, 1, '<p>-Thiết kế sang trọng - Thiết kế phẳng ở 4 cạnh, m&agrave;u sắc tươi trẻ<br />-M&agrave;n h&igrave;nh cho trải nghiệm ch&acirc;n thực - Tấm nền Retina IPS LCD 10.9 inches, ch&acirc;n thực v&agrave; sắc n&eacute;t<br />-Khả năng kết nối phụ kiện tuyệt vời - Dễ d&agrave;ng kết nối Magic Keyboard v&agrave; Apple Pencil biến iPad của bạn th&agrave;nh chiếc Laptop ho&agrave;n hảo<br />-Khả năng xử l&yacute; t&aacute;c vụ đ&aacute;ng kinh ngạc - Con chip M1 v&ocirc; c&ugrave;ng mạnh mẽ</p>', 0, '13990000', '8a617230e2.jpg', 1),
(16, 'iPhone 15 Pro Max 256GB', 2, 1, '<p>Thiết kế khung viền từ titan chuẩn h&agrave;ng kh&ocirc;ng vũ trụ - Cực nhẹ, bền c&ugrave;ng viền cạnh mỏng cầm nắm thoải m&aacute;i<br />Hiệu năng Pro chiến game thả ga - Chip A17 Pro mang lại hiệu năng đồ họa v&ocirc; c&ugrave;ng sống động v&agrave; ch&acirc;n thực<br />Thoả sức s&aacute;ng tạo v&agrave; quay phim chuy&ecirc;n nghiệp - Cụm 3 camera sau đến 48MP v&agrave; nhiều chế độ ti&ecirc;n tiến<br />N&uacute;t t&aacute;c vụ mới gi&uacute;p nhanh ch&oacute;ng k&iacute;ch hoạt t&iacute;nh năng y&ecirc;u th&iacute;ch của bạn</p>', 0, '29590000', '736a5303ef.jpg', 10),
(17, 'iPhone 16 Pro Max 256GB', 2, 1, '<p>M&agrave;n h&igrave;nh Super Retina XDR 6,9 inch lớn hơn c&oacute; viền mỏng hơn, đem đến cảm gi&aacute;c tuyệt vời khi cầm tr&ecirc;n tay.<br />Điều khiển Camera - Chỉ cần trượt ng&oacute;n tay để điều chỉnh camera gi&uacute;p chụp ảnh hoặc quay video đẹp ho&agrave;n hảo v&agrave; si&ecirc;u nhanh.<br />iPhone 16 Pro Max c&oacute; thiết kế titan cấp 5 với lớp ho&agrave;n thiện mới, tinh tế được xử l&yacute; bề mặt vi điểm.<br />iPhone 16 Pro Max được c&agrave;i đặt sẵn hệ điều h&agrave;nh iOS 18, cho giao diện trực quan, dễ sử dụng v&agrave; nhiều t&iacute;nh năng hữu &iacute;ch.</p>', 1, '33990000', '6492f8f23b.jpeg', 1),
(18, 'iPhone 16 Pro Max 512GB', 2, 1, '<p>M&agrave;n h&igrave;nh Super Retina XDR 6,9 inch lớn hơn c&oacute; viền mỏng hơn, đem đến cảm gi&aacute;c tuyệt vời khi cầm tr&ecirc;n tay.<br />Điều khiển Camera - Chỉ cần trượt ng&oacute;n tay để điều chỉnh camera gi&uacute;p chụp ảnh hoặc quay video đẹp ho&agrave;n hảo v&agrave; si&ecirc;u nhanh.<br />iPhone 16 Pro Max c&oacute; thiết kế titan cấp 5 với lớp ho&agrave;n thiện mới, tinh tế được xử l&yacute; bề mặt vi điểm.<br />iPhone 16 Pro Max được c&agrave;i đặt sẵn hệ điều h&agrave;nh iOS 18, cho giao diện trực quan, dễ sử dụng v&agrave; nhiều t&iacute;nh năng hữu &iacute;ch.</p>', 1, '29590000', '45c9cd6764.jpeg', 33),
(19, 'Loa Bluetooth Homepod', 6, 1, '<p>Kết nối Bluetooth 5.3 cho tốc độ truyền tải nhanh hơn, ổn định hơn, &iacute;t bị gi&aacute;n đoạn<br />Kh&aacute;ng nước IP67, cho ph&eacute;p sử dụng loa ngo&agrave;i trời hoặc trong m&ocirc;i trường ẩm ướt<br />Loại bỏ tiếng ồn v&agrave; tiếng vọng trong cuộc gọi, đảm bảo cuộc tr&ograve; chuyện r&otilde; r&agrave;ng<br />T&iacute;nh năng Stereo Pair kết nối hai loa để tạo &acirc;m thanh stereo sống động, mạnh mẽ</p>', 0, '3399000', 'f3fe194c32.jpg', 1),
(21, 'Iphone 13 Pro 256GB', 2, 1, '<p>Hiệu năng vượt trội - Chip Apple A15 Bionic mạnh mẽ, hỗ trợ mạng 5G tốc độ cao<br />Kh&ocirc;ng gian hiển thị sống động - M&agrave;n h&igrave;nh 6.1\" Super Retina XDR độ s&aacute;ng cao, sắc n&eacute;t<br />Trải nghiệm điện ảnh đỉnh cao - Cụm 3 camera 12MP, hỗ trợ ổn định h&igrave;nh ảnh quang học<br />Tối ưu điện năng - Sạc nhanh 20 W, đầy 50% pin trong khoảng 30 ph&uacute;t</p>', 0, '24490000', '08d8ad8162.jpg', 31),
(22, 'iPhone 13 512GB', 2, 1, '<p>Hiệu năng vượt trội - Chip Apple A15 Bionic mạnh mẽ, hỗ trợ mạng 5G tốc độ cao<br />Trải nghiệm hiển thị sống động - M&agrave;n h&igrave;nh 6.1\" Super Retina XDR độ s&aacute;ng cao, sắc n&eacute;t<br />Bắt trọn từng khoảng khắc - Camera k&eacute;p 12MP, hỗ trợ ổn định h&igrave;nh ảnh quang học<br />Tối ưu điện năng - Sạc nhanh 20 W, đầy 50% pin trong khoảng 30 ph&uacute;t</p>', 1, '20990000', 'a0a278bd43.png', 27),
(23, 'iPhone 13 128GB', 2, 1, '<ul>\r\n<li>Hiệu năng vượt trội - Chip Apple A15 Bionic mạnh mẽ, hỗ trợ mạng 5G tốc độ cao</li>\r\n<li>Kh&ocirc;ng gian hiển thị sống động - M&agrave;n h&igrave;nh 6.1\" Super Retina XDR độ s&aacute;ng cao, sắc n&eacute;t</li>\r\n<li>Trải nghiệm điện ảnh đỉnh cao - Camera k&eacute;p 12MP, hỗ trợ ổn định h&igrave;nh ảnh quang học</li>\r\n<li>Tối ưu điện năng - Sạc nhanh 20 W, đầy 50% pin trong khoảng 30 ph&uacute;t</li>\r\n</ul>', 1, '13290000', 'f80cf5f37b.jpeg', 17),
(24, 'iPhone 13 Pro Max 256GB', 2, 1, '<ul>\r\n<li>Hiệu năng vượt trội - Chip Apple A15 Bionic mạnh mẽ, hỗ trợ mạng 5G tốc độ cao</li>\r\n<li>Kh&ocirc;ng gian hiển thị sống động - M&agrave;n h&igrave;nh 6.7\" Super Retina XDR độ s&aacute;ng cao, sắc n&eacute;t</li>\r\n<li>Trải nghiệm điện ảnh đỉnh cao - Cụm 3 camera 12MP, hỗ trợ ổn định h&igrave;nh ảnh quang học</li>\r\n<li>Tối ưu điện năng - Sạc nhanh 20 W, đầy 50% pin trong khoảng 30 ph&uacute;t</li>\r\n</ul>', 1, '23990000', 'fa49cdbb92.png', 29),
(25, 'iPhone 14 Pro 128GB', 2, 1, '<ul>\r\n<li>Trải nghiệm thị gi&aacute;c ấn tượng - M&agrave;n h&igrave;nh Dynamic Island, sắc n&eacute;t với c&ocirc;ng nghệ Super Retina XDR, mượt m&agrave; 120 Hz</li>\r\n<li>Tuyệt đỉnh thiết kế, tỉ mỉ từng đường n&eacute;t - N&acirc;ng cấp to&agrave;n diện với kiểu d&aacute;ng mới, nhiều lựa chọn m&agrave;u sắc trẻ trung</li>\r\n<li>Hiệu năng h&agrave;ng đầu thế giới - Apple A16 Bionic xử l&iacute; nhanh, ổn định mọi t&aacute;c vụ</li>\r\n<li>Camera chuẩn nhiếp ảnh chuy&ecirc;n nghiệp - Camera sau 48MP trang bị nhiều c&ocirc;ng nghệ chụp đa dạng</li>\r\n</ul>', 0, '24990000', '171a72d03e.jpg', 23),
(26, 'iPhone 14 Pro 256GB', 2, 1, '<ul>\r\n<li>Trải nghiệm thị gi&aacute;c ấn tượng - M&agrave;n h&igrave;nh Dynamic Island, sắc n&eacute;t với c&ocirc;ng nghệ Super Retina XDR, mượt m&agrave; 120 Hz</li>\r\n<li>Tuyệt đỉnh thiết kế, tỉ mỉ từng đường n&eacute;t - N&acirc;ng cấp to&agrave;n diện với kiểu d&aacute;ng mới, nhiều lựa chọn m&agrave;u sắc trẻ trung</li>\r\n<li>Hiệu năng h&agrave;ng đầu thế giới - Apple A16 Bionic xử l&iacute; nhanh, ổn định mọi t&aacute;c vụ</li>\r\n<li>Camera chuẩn nhiếp ảnh chuy&ecirc;n nghiệp - Camera sau 48MP trang bị nhiều c&ocirc;ng nghệ chụp đa dạng</li>\r\n</ul>', 0, '24990000', '59b3ca8a2b.jpg', 16),
(27, 'iPhone 14 Pro Max 128GB', 2, 1, '<p>Hiệu năng vượt trội - Chip Apple A15 Bionic mạnh mẽ, hỗ trợ mạng 5G tốc độ cao<br />Trải nghiệm hiển thị sống động - M&agrave;n h&igrave;nh 6.1\" Super Retina XDR độ s&aacute;ng cao, sắc n&eacute;t<br />Bắt trọn từng khoảng khắc - Camera k&eacute;p 12MP, hỗ trợ ổn định h&igrave;nh ảnh quang học<br />Tối ưu điện năng - Sạc nhanh 20 W, đầy 50% pin trong khoảng 30 ph&uacute;t</p>', 0, '21490000', 'abb4031433.png', 23),
(28, 'iPhone 15 128GB', 2, 1, '<p>Hiệu năng vượt trội - Chip Apple A15 Bionic mạnh mẽ, hỗ trợ mạng 5G tốc độ cao<br />Trải nghiệm hiển thị sống động - M&agrave;n h&igrave;nh 6.1\" Super Retina XDR độ s&aacute;ng cao, sắc n&eacute;t<br />Bắt trọn từng khoảng khắc - Camera k&eacute;p 12MP, hỗ trợ ổn định h&igrave;nh ảnh quang học<br />Tối ưu điện năng - Sạc nhanh 20 W, đầy 50% pin trong khoảng 30 ph&uacute;t</p>', 1, '19490000', '061af70737.jpg', 52),
(29, 'iPhone 15 Pro 256GB', 2, 1, '<p>Hiệu năng vượt trội - Chip Apple A15 Bionic mạnh mẽ, hỗ trợ mạng 5G tốc độ cao<br />Trải nghiệm hiển thị sống động - M&agrave;n h&igrave;nh 6.1\" Super Retina XDR độ s&aacute;ng cao, sắc n&eacute;t<br />Bắt trọn từng khoảng khắc - Camera k&eacute;p 12MP, hỗ trợ ổn định h&igrave;nh ảnh quang học<br />Tối ưu điện năng - Sạc nhanh 20 W, đầy 50% pin trong khoảng 30 ph&uacute;t</p>', 1, '28590000', '563e56fb1d.jpg', 38),
(30, 'iPhone 15 Pro Max 512GB', 2, 1, '<p>Hiệu năng vượt trội - Chip Apple A15 Bionic mạnh mẽ, hỗ trợ mạng 5G tốc độ cao<br />Trải nghiệm hiển thị sống động - M&agrave;n h&igrave;nh 6.1\" Super Retina XDR độ s&aacute;ng cao, sắc n&eacute;t<br />Bắt trọn từng khoảng khắc - Camera k&eacute;p 12MP, hỗ trợ ổn định h&igrave;nh ảnh quang học<br />Tối ưu điện năng - Sạc nhanh 20 W, đầy 50% pin trong khoảng 30 ph&uacute;t</p>', 1, '34690000', '6b7c5d37c4.jpg', 32),
(32, 'iPhone 15 Pro 128GB', 2, 1, '<p>Hiệu năng vượt trội - Chip Apple A15 Bionic mạnh mẽ, hỗ trợ mạng 5G tốc độ cao<br />Trải nghiệm hiển thị sống động - M&agrave;n h&igrave;nh 6.1\" Super Retina XDR độ s&aacute;ng cao, sắc n&eacute;t<br />Bắt trọn từng khoảng khắc - Camera k&eacute;p 12MP, hỗ trợ ổn định h&igrave;nh ảnh quang học<br />Tối ưu điện năng - Sạc nhanh 20 W, đầy 50% pin trong khoảng 30 ph&uacute;t</p>', 1, '22590000', 'b892c82ff3.jpg', 36),
(35, 'iPad Air 6 13 inch 64GB', 3, 1, '<ul>\r\n<li>Trang bị chip Apple M2 mạnh mẽ, xử l&yacute; mượt m&agrave; mọi t&aacute;c vụ, từ c&ocirc;ng việc văn ph&ograve;ng đến s&aacute;ng tạo nội dung.</li>\r\n<li>M&agrave;n h&igrave;nh Liquid Retina rực rỡ cho trải nghiệm h&igrave;nh ảnh sống động, sắc n&eacute;t v&agrave; ch&acirc;n thực.</li>\r\n<li>Gọi video call chất lượng cao với camera trước g&oacute;c si&ecirc;u rộng 12MP.</li>\r\n<li>Thiết kế mỏng nhẹ, di động linh hoạt, dễ d&agrave;ng mang theo b&ecirc;n m&igrave;nh mọi l&uacute;c mọi nơi, phục vụ đa dạng nhu cầu.</li>\r\n</ul>', 1, '14890000', '4bce00eefe.jpg', 15),
(36, 'iPad mini 7 2024 128GB', 3, 1, '<p>Trang bị chip Apple M2 mạnh mẽ, xử l&yacute; mượt m&agrave; mọi t&aacute;c vụ, từ c&ocirc;ng việc văn ph&ograve;ng đến s&aacute;ng tạo nội dung.<br />M&agrave;n h&igrave;nh Liquid Retina rực rỡ cho trải nghiệm h&igrave;nh ảnh sống động, sắc n&eacute;t v&agrave; ch&acirc;n thực.<br />Gọi video call chất lượng cao với camera trước g&oacute;c si&ecirc;u rộng 12MP.<br />Thiết kế mỏng nhẹ, di động linh hoạt, dễ d&agrave;ng mang theo b&ecirc;n m&igrave;nh mọi l&uacute;c mọi nơi, phục vụ đa dạng nhu cầu.</p>', 0, '13990000', 'd91ac18450.jpeg', 31),
(37, 'iPad mini 6 2024 64GB', 3, 1, '<p>Trang bị chip Apple M2 mạnh mẽ, xử l&yacute; mượt m&agrave; mọi t&aacute;c vụ, từ c&ocirc;ng việc văn ph&ograve;ng đến s&aacute;ng tạo nội dung.<br />M&agrave;n h&igrave;nh Liquid Retina rực rỡ cho trải nghiệm h&igrave;nh ảnh sống động, sắc n&eacute;t v&agrave; ch&acirc;n thực.<br />Gọi video call chất lượng cao với camera trước g&oacute;c si&ecirc;u rộng 12MP.<br />Thiết kế mỏng nhẹ, di động linh hoạt, dễ d&agrave;ng mang theo b&ecirc;n m&igrave;nh mọi l&uacute;c mọi nơi, phục vụ đa dạng nhu cầu.</p>', 0, '11290000', '0e2615d434.jpg', 26),
(38, 'iPad 10.2 2022 128GB', 3, 1, '<p>Trang bị chip Apple M2 mạnh mẽ, xử l&yacute; mượt m&agrave; mọi t&aacute;c vụ, từ c&ocirc;ng việc văn ph&ograve;ng đến s&aacute;ng tạo nội dung.<br />M&agrave;n h&igrave;nh Liquid Retina rực rỡ cho trải nghiệm h&igrave;nh ảnh sống động, sắc n&eacute;t v&agrave; ch&acirc;n thực.<br />Gọi video call chất lượng cao với camera trước g&oacute;c si&ecirc;u rộng 12MP.<br />Thiết kế mỏng nhẹ, di động linh hoạt, dễ d&agrave;ng mang theo b&ecirc;n m&igrave;nh mọi l&uacute;c mọi nơi, phục vụ đa dạng nhu cầu.</p>', 0, '7050000', 'c4ad0b9326.jpg', 30),
(39, 'iPad Pro M4 256GB', 3, 1, '<p>Trang bị chip Apple M2 mạnh mẽ, xử l&yacute; mượt m&agrave; mọi t&aacute;c vụ, từ c&ocirc;ng việc văn ph&ograve;ng đến s&aacute;ng tạo nội dung.<br />M&agrave;n h&igrave;nh Liquid Retina rực rỡ cho trải nghiệm h&igrave;nh ảnh sống động, sắc n&eacute;t v&agrave; ch&acirc;n thực.<br />Gọi video call chất lượng cao với camera trước g&oacute;c si&ecirc;u rộng 12MP.<br />Thiết kế mỏng nhẹ, di động linh hoạt, dễ d&agrave;ng mang theo b&ecirc;n m&igrave;nh mọi l&uacute;c mọi nơi, phục vụ đa dạng nhu cầu.</p>', 1, '27490000', '0c107d99a4.jpg', 30),
(40, 'Macbook Air M2 128GB', 4, 1, '<p>Trang bị chip Apple M2 mạnh mẽ, xử l&yacute; mượt m&agrave; mọi t&aacute;c vụ, từ c&ocirc;ng việc văn ph&ograve;ng đến s&aacute;ng tạo nội dung.<br />M&agrave;n h&igrave;nh Liquid Retina rực rỡ cho trải nghiệm h&igrave;nh ảnh sống động, sắc n&eacute;t v&agrave; ch&acirc;n thực.<br />Gọi video call chất lượng cao với camera trước g&oacute;c si&ecirc;u rộng 12MP.<br />Thiết kế mỏng nhẹ, di động linh hoạt, dễ d&agrave;ng mang theo b&ecirc;n m&igrave;nh mọi l&uacute;c mọi nơi, phục vụ đa dạng nhu cầu.</p>', 1, '25990000', '90bf11f092.jpg', 30),
(41, 'Macbook Air M2 512GB', 4, 1, '<p>Trang bị chip Apple M2 mạnh mẽ, xử l&yacute; mượt m&agrave; mọi t&aacute;c vụ, từ c&ocirc;ng việc văn ph&ograve;ng đến s&aacute;ng tạo nội dung.<br />M&agrave;n h&igrave;nh Liquid Retina rực rỡ cho trải nghiệm h&igrave;nh ảnh sống động, sắc n&eacute;t v&agrave; ch&acirc;n thực.<br />Gọi video call chất lượng cao với camera trước g&oacute;c si&ecirc;u rộng 12MP.<br />Thiết kế mỏng nhẹ, di động linh hoạt, dễ d&agrave;ng mang theo b&ecirc;n m&igrave;nh mọi l&uacute;c mọi nơi, phục vụ đa dạng nhu cầu.</p>', 0, '29590000', 'c33aaa87db.jpg', 25),
(42, 'Macbook Pro M3 512GB', 4, 1, '<p>Trang bị chip Apple M2 mạnh mẽ, xử l&yacute; mượt m&agrave; mọi t&aacute;c vụ, từ c&ocirc;ng việc văn ph&ograve;ng đến s&aacute;ng tạo nội dung.<br />M&agrave;n h&igrave;nh Liquid Retina rực rỡ cho trải nghiệm h&igrave;nh ảnh sống động, sắc n&eacute;t v&agrave; ch&acirc;n thực.<br />Gọi video call chất lượng cao với camera trước g&oacute;c si&ecirc;u rộng 12MP.<br />Thiết kế mỏng nhẹ, di động linh hoạt, dễ d&agrave;ng mang theo b&ecirc;n m&igrave;nh mọi l&uacute;c mọi nơi, phục vụ đa dạng nhu cầu.</p>', 1, '35990000', '35f3683281.jpg', 15),
(44, 'Magic Keyboard 2', 8, 1, '<p><strong>B&agrave;n ph&iacute;m Wireless Keyboard</strong>&nbsp;cũng được Apple thay đổi kh&aacute; nhiều với một số tinh chỉnh về mặt thiết kế. Wireless Keyboard mới vẫn c&oacute; h&igrave;nh d&aacute;ng tương tự một miếng kim loại nhẹ m&agrave;u trắng nhưng được v&aacute;t nhẹ hai b&ecirc;n v&agrave; dốc thẳng đứng xuống dưới, tương tự như thiết kế của trackpad mới. Nếu như sử dụng đồng thời b&agrave;n ph&iacute;m Wireless Keyboard v&agrave; trackpad mới của Apple th&igrave; bạn sẽ c&oacute; hai sản phẩm rất đồng nhất tr&ecirc;n b&agrave;n l&agrave;m việc của m&igrave;nh.</p>\r\n<p>Vị tr&iacute; của c&aacute;c ph&iacute;m bấm vẫn tương tự như thế hệ trước nhưng khoảng c&aacute;ch giữa mỗi ph&iacute;m đ&atilde; rộng hơn, hỗ trợ cơ chế &ldquo;Butterfly Mechanism&rdquo; như tr&ecirc;n MacBook 12 inch, hứa hẹn mang lại cảm gi&aacute;c g&otilde; thoải m&aacute;i hơn. Ngo&agrave;i ra, c&aacute;c ph&iacute;m chức năng cũng được thay đổi k&iacute;ch thước từ dạng h&igrave;nh chữ nhật th&agrave;nh h&igrave;nh vu&ocirc;ng.</p>', 0, '2990000', 'a21c558bf9.jpg', 15),
(45, 'Magic Keyboard 2021 MK2A3', 8, 1, '<p><strong>B&agrave;n ph&iacute;m Wireless Keyboard</strong>&nbsp;cũng được Apple thay đổi kh&aacute; nhiều với một số tinh chỉnh về mặt thiết kế. Wireless Keyboard mới vẫn c&oacute; h&igrave;nh d&aacute;ng tương tự một miếng kim loại nhẹ m&agrave;u trắng nhưng được v&aacute;t nhẹ hai b&ecirc;n v&agrave; dốc thẳng đứng xuống dưới, tương tự như thiết kế của trackpad mới. Nếu như sử dụng đồng thời b&agrave;n ph&iacute;m Wireless Keyboard v&agrave; trackpad mới của Apple th&igrave; bạn sẽ c&oacute; hai sản phẩm rất đồng nhất tr&ecirc;n b&agrave;n l&agrave;m việc của m&igrave;nh.</p>\r\n<p>Vị tr&iacute; của c&aacute;c ph&iacute;m bấm vẫn tương tự như thế hệ trước nhưng khoảng c&aacute;ch giữa mỗi ph&iacute;m đ&atilde; rộng hơn, hỗ trợ cơ chế &ldquo;Butterfly Mechanism&rdquo; như tr&ecirc;n MacBook 12 inch, hứa hẹn mang lại cảm gi&aacute;c g&otilde; thoải m&aacute;i hơn. Ngo&agrave;i ra, c&aacute;c ph&iacute;m chức năng cũng được thay đổi k&iacute;ch thước từ dạng h&igrave;nh chữ nhật th&agrave;nh h&igrave;nh vu&ocirc;ng.</p>', 1, '2090000', '3e18b61127.jpg', 21),
(46, 'Magic Keyboard 2021 MK293', 8, 1, '<p><strong>B&agrave;n ph&iacute;m Wireless Keyboard</strong>&nbsp;cũng được Apple thay đổi kh&aacute; nhiều với một số tinh chỉnh về mặt thiết kế. Wireless Keyboard mới vẫn c&oacute; h&igrave;nh d&aacute;ng tương tự một miếng kim loại nhẹ m&agrave;u trắng nhưng được v&aacute;t nhẹ hai b&ecirc;n v&agrave; dốc thẳng đứng xuống dưới, tương tự như thiết kế của trackpad mới. Nếu như sử dụng đồng thời b&agrave;n ph&iacute;m Wireless Keyboard v&agrave; trackpad mới của Apple th&igrave; bạn sẽ c&oacute; hai sản phẩm rất đồng nhất tr&ecirc;n b&agrave;n l&agrave;m việc của m&igrave;nh.</p>\r\n<p>Vị tr&iacute; của c&aacute;c ph&iacute;m bấm vẫn tương tự như thế hệ trước nhưng khoảng c&aacute;ch giữa mỗi ph&iacute;m đ&atilde; rộng hơn, hỗ trợ cơ chế &ldquo;Butterfly Mechanism&rdquo; như tr&ecirc;n MacBook 12 inch, hứa hẹn mang lại cảm gi&aacute;c g&otilde; thoải m&aacute;i hơn. Ngo&agrave;i ra, c&aacute;c ph&iacute;m chức năng cũng được thay đổi k&iacute;ch thước từ dạng h&igrave;nh chữ nhật th&agrave;nh h&igrave;nh vu&ocirc;ng.</p>', 1, '3290000', '3f7cd74e42.jpg', 19),
(47, 'Apple Pencil 2023 (MUWA3)', 7, 1, '<ul>\r\n<li>Apple Pencil 2023 USB-C tương th&iacute;ch với iPad: gen 10 (10.9 inch) trở l&ecirc;n, Mini 6 trở l&ecirc;n, Air thế hệ 4 trở l&ecirc;n, to&agrave;n bộ Pro 11, Pro 12.9 thế hệ 3 trở l&ecirc;n</li>\r\n<li>Lựa chọn l&yacute; tưởng để ph&aacute;c họa, ghi ch&uacute;, đ&aacute;nh dấu t&agrave;i liệu v&agrave; xử l&yacute; nhiều thao t&aacute;c kh&aacute;c</li>\r\n<li>D&ugrave;ng tự nhi&ecirc;n như b&uacute;t ch&igrave;, với độ ch&iacute;nh x&aacute;c cao, độ trễ thấp v&agrave; nhạy với độ nghi&ecirc;ng</li>\r\n<li>Khả năng gắn kết bằng nam ch&acirc;m c&ugrave;ng khả năng gh&eacute;p đ&ocirc;i v&agrave; sạc qua cổng USB-C</li>\r\n<li>Thiết kế tinh giản chuẩn Apple, si&ecirc;u nhẹ chỉ 20.5 gam, c&oacute; thể kết nối qua Bluetooth</li>\r\n</ul>', 1, '2190000', 'de6f5adf2b.png', 17),
(48, 'AirPods Pro 3 2023 USB-C', 5, 1, '<ul>\r\n<li>Vi&ecirc;n pin tốt cho thời lượng d&ugrave;ng l&ecirc;n đến 30 giờ li&ecirc;n tục khi đi k&egrave;m hộp sạc</li>\r\n<li>Thiết kế dạng earbuds sang trọng, &ocirc;m kh&iacute;t v&agrave;o tai, tạo cảm gi&aacute;c thoải m&aacute;i</li>\r\n<li>Chất &acirc;m vượt trội c&ugrave;ng khả năng tiết kiệm năng lượng nhờ chip Apple H1</li>\r\n<li>Y&ecirc;n t&acirc;m khi luyện tập thể thao v&agrave; đi mưa khi c&oacute; chuẩn kh&aacute;ng nước IPX4</li>\r\n</ul>', 1, '3590000', 'a838ef82bf.jpg', 24),
(49, 'AirPods 4 2024 Bluetooth', 5, 1, '<ul>\r\n<li>Vi&ecirc;n pin tốt cho thời lượng d&ugrave;ng l&ecirc;n đến 30 giờ li&ecirc;n tục khi đi k&egrave;m hộp sạc</li>\r\n<li>Thiết kế dạng earbuds sang trọng, &ocirc;m kh&iacute;t v&agrave;o tai, tạo cảm gi&aacute;c thoải m&aacute;i</li>\r\n<li>Chất &acirc;m vượt trội c&ugrave;ng khả năng tiết kiệm năng lượng nhờ chip Apple H1</li>\r\n<li>Y&ecirc;n t&acirc;m khi luyện tập thể thao v&agrave; đi mưa khi c&oacute; chuẩn kh&aacute;ng nước IPX4</li>\r\n</ul>', 0, '3350000', 'b570da6071.jpg', 30),
(50, 'AirPods Max 2024 Chống ồn', 5, 1, '<ul>\r\n<li>Vi&ecirc;n pin tốt cho thời lượng d&ugrave;ng l&ecirc;n đến 30 giờ li&ecirc;n tục khi đi k&egrave;m hộp sạc</li>\r\n<li>Thiết kế dạng earbuds sang trọng, &ocirc;m kh&iacute;t v&agrave;o tai, tạo cảm gi&aacute;c thoải m&aacute;i</li>\r\n<li>Chất &acirc;m vượt trội c&ugrave;ng khả năng tiết kiệm năng lượng nhờ chip Apple H1</li>\r\n<li>Y&ecirc;n t&acirc;m khi luyện tập thể thao v&agrave; đi mưa khi c&oacute; chuẩn kh&aacute;ng nước IPX4</li>\r\n</ul>', 1, '12990000', 'd83bedb9d2.jpg', 17),
(51, 'AirPods 2 Bluetooth', 5, 1, '<ul>\r\n<li>Phản hồi nhanh hơn v&agrave; tiết kiệm năng lượng nhờ v&agrave;o con chip Apple H1</li>\r\n<li>Thiết kế sang trọng, gọn nhẹ tạo cảm gi&aacute;c thoải m&aacute;i khi đeo h&agrave;ng giờ liền</li>\r\n<li>T&iacute;ch hợp 2 micro khử tiếng ồn cho chất lượng &acirc;m thanh tốt khi đ&agrave;m thoại</li>\r\n<li>Hỗ trợ c&ocirc;ng nghệ sạc nhanh, chỉ mất 15 ph&uacute;t l&agrave; đ&atilde; c&oacute; ngay 3 giờ sử dụng</li>\r\n</ul>', 0, '2990000', '751c295d7c.jpg', 16),
(52, 'iPhone 16 128GB', 2, 1, '<ul>\r\n<li>iPhone 16 được trang bị vi xử l&yacute; Apple A18, cho hiệu năng mạnh mẽ, đ&aacute;p ứng tốt c&aacute;c t&aacute;c vụ nặng như chơi game, thiết kế đồ họa v&agrave; chạy đa nhiệm.</li>\r\n<li>Điều khiển Camera - Gi&uacute;p bạn truy cập nhanh c&aacute;c c&ocirc;ng cụ camera dễ d&agrave;ng hơn chỉ cần trượt ng&oacute;n tay.</li>\r\n<li>Hệ thống camera mới - Chụp ảnh v&agrave; quay video macro cực kỳ chi tiết v&agrave; sắc n&eacute;t d&ugrave; từ xa hay gần.</li>\r\n<li>Vỏ m&aacute;y iPhone 16 được l&agrave;m từ nh&ocirc;m chuẩn h&agrave;ng kh&ocirc;ng vũ trụ cứng c&aacute;p v&agrave; k&iacute;nh pha m&agrave;u ở mặt sau vừa đẹp vừa bền bỉ.</li>\r\n</ul>', 1, '21790000', 'ab6d435a15.jpg', 24),
(53, 'Macbook Pro M2 512GB', 4, 1, '<ul>\r\n<li>Thiết kế sang trọng, thời thượng với mặt lưng nh&ocirc;m c&ugrave;ng trọng lượng chỉ 1.55kg</li>\r\n<li>Xử l&yacute; moi t&aacute;c vụ với con chip M3 c&ugrave;ng 10 nh&acirc;n GPU</li>\r\n<li>Chất lượng hiển thị h&agrave;ng đầu - m&agrave;n h&igrave;nh 14.2 inch tấm nền retina</li>\r\n<li>B&agrave;n ph&iacute;m trang bị Touch ID cho ph&eacute;p mở kho&aacute; chỉ với 1 chạm</li>\r\n<li>Tận hưởng chất lượng &acirc;m thanh ch&acirc;n thật với hệ thống 6 loa c&ugrave;ng c&ocirc;ng nghệ Dolby Atmos</li>\r\n</ul>', 0, '24990000', '410b2dbb07.jpg', 23),
(56, 'iPhone 16 512GB', 2, 1, '<ul>\r\n<li>iPhone 16 được trang bị vi xử l&yacute; Apple A18, cho hiệu năng mạnh mẽ, đ&aacute;p ứng tốt c&aacute;c t&aacute;c vụ nặng như chơi game, thiết kế đồ họa v&agrave; chạy đa nhiệm.</li>\r\n<li>Sở hữu hệ thống camera sau 48MP, cho khả năng chụp ảnh r&otilde; n&eacute;t, chi tiết v&agrave; bắt trọn những khoảnh khắc đẹp.</li>\r\n<li>M&agrave;n h&igrave;nh Super Retina XDR&nbsp;6.1 inch, cho trải nghiệm h&igrave;nh ảnh rộng r&atilde;i, m&agrave;u sắc rực rỡ, độ tương phản cao v&agrave; chi tiết r&otilde; r&agrave;ng.</li>\r\n<li>Vỏ m&aacute;y iPhone 16 được l&agrave;m từ nh&ocirc;m chuẩn h&agrave;ng kh&ocirc;ng vũ trụ cứng c&aacute;p v&agrave; k&iacute;nh pha m&agrave;u ở mặt sau vừa đẹp vừa bền bỉ.</li>\r\n</ul>', 1, '23990000', 'f2cf763b2c.jpeg', 29);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`adminId`);

--
-- Chỉ mục cho bảng `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`brandId`);

--
-- Chỉ mục cho bảng `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cartId`),
  ADD KEY `idpro` (`productId`),
  ADD KEY `fk_customer` (`customer_Id`);

--
-- Chỉ mục cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`catId`);

--
-- Chỉ mục cho bảng `tbl_contact`
--
ALTER TABLE `tbl_contact`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`Id`);

--
-- Chỉ mục cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `productId` (`productId`),
  ADD KEY `customer_Id` (`customer_Id`);

--
-- Chỉ mục cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`productId`),
  ADD KEY `catId` (`catId`),
  ADD KEY `brandId` (`brandId`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `brandId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=323;

--
-- AUTO_INCREMENT cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `catId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `tbl_contact`
--
ALTER TABLE `tbl_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD CONSTRAINT `fk_customer` FOREIGN KEY (`customer_Id`) REFERENCES `tbl_customer` (`Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `idpro` FOREIGN KEY (`productId`) REFERENCES `tbl_product` (`productId`);

--
-- Các ràng buộc cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD CONSTRAINT `tbl_order_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `tbl_product` (`productId`),
  ADD CONSTRAINT `tbl_order_ibfk_2` FOREIGN KEY (`customer_Id`) REFERENCES `tbl_customer` (`Id`);

--
-- Các ràng buộc cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD CONSTRAINT `tbl_product_ibfk_1` FOREIGN KEY (`catId`) REFERENCES `tbl_category` (`catId`),
  ADD CONSTRAINT `tbl_product_ibfk_2` FOREIGN KEY (`brandId`) REFERENCES `tbl_brand` (`brandId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
