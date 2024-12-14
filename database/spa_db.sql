

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";




CREATE TABLE `admin` (
  `id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `admin` (`id`, `name`, `email`, `password`, `image`) VALUES
('9CIDsn8Tm2aMBLeyc766', 'max', 'max@gmail.com', '0706025b2bbcec1ed8d64822f4eccd96314938d0', 'jNDQkgR3ak2JdNSUC66r.jpg');





CREATE TABLE `employee` (
  `id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `profession` varchar(50) NOT NULL,
  `email` varchar(60) NOT NULL,
  `number` int(20) NOT NULL,
  `profile_desc` text NOT NULL,
  `profile` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `employee` (`id`, `name`, `profession`, `email`, `number`, `profile_desc`, `profile`, `status`) VALUES
('LSLSe6rZUGSHzf2iTxnc', 'sara smith', 'massage specialist', 'sarasmith@gmail.com', 2147483647, 'As co-founder of the first all-woman physician plastic surgery practice in Atlanta, Dr. Diane Z. Alexander is a nationally recognized leader in cosmetic surgery, non-invasive facial rejuvenation and anti-aging. As much an artist as a surgeon, she sees Artisan Beauté as the natural fulfillment of her journey for the women she serves.As co-founder of the first all-woman physician plastic surgery practice in Atlanta, Dr. Diane Z. Alexander is a nationally recognized leader in cosmetic surgery, non-invasive facial rejuvenation and anti-aging. As much an artist as a surgeon, she sees Artisan Beauté as the natural fulfillment of her journey for the women she serves.', 'employee0.jpg', 'active'),
('Hc2ONpIYF7lkhhbjC8dy', 'neil parker', 'barber', 'neilparke@gmail.com', 2147483647, 'As co-founder of the first all-woman physician plastic surgery practice in Atlanta, Dr. Diane Z. Alexander is a nationally recognized leader in cosmetic surgery, non-invasive facial rejuvenation and anti-aging. As much an artist as a surgeon, she sees Artisan Beauté as the natural fulfillment of her journey for the women she serves.As co-founder of the first all-woman physician plastic surgery practice in Atlanta, Dr. Diane Z. Alexander is a nationally recognized leader in cosmetic surgery, non-invasive facial rejuvenation and anti-aging. As much an artist as a surgeon, she sees Artisan Beauté as the natural fulfillment of her journey for the women she serves.As co-founder of the first all-woman physician plastic surgery practice in Atlanta, Dr. Diane Z. Alexander is a nationally recognized leader in cosmetic surgery, non-invasive facial rejuvenation and anti-aging. As much an artist as a surgeon, she sees Artisan Beauté as the natural fulfillment of her journey for the women she serves.', 'img.webp', 'active'),
('z8jAV4gcxpComoYyr5sZ', 'sana ansari', 'master&#39;s of cosmetology', 'sanaansari@gmail.com', 2147483647, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'employee.jpg', 'active'),
('AYFTvgKCMUnEtsUsWQYH', 'sara smith', 'massage specialist', 'sarasmith@gmail.com', 2147483647, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'employee1.jpg', 'active');



CREATE TABLE `message` (
  `id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `subject`, `message`) VALUES
('Oh5M8yLUCOXnyDHk2aM8', 'G0xqQK2i3tfAyW6bl4YD', 'raj', 'raj786@gmail.com', 'appointment', 'how i book appointment');



CREATE TABLE `orders` (
  `id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `service_id` varchar(200) NOT NULL,
  `employee_id` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL,
  `time` varchar(20) NOT NULL,
  `price` varchar(10) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'booked',
  `payment_status` varchar(255) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `service_id`, `employee_id`, `date`, `time`, `price`, `status`, `payment_status`) VALUES
('SNrlI6oN9XYSRQiU8YUx', 'PtLUoRc1sSusvAR3oZW6', 'mahi nazir', '345', 'shalu@gmail.com', 'M1gfpG6Pr2ufjtlSWXp1', 'aroma therapy', '2024-02-09', '3:30 PM - 4:30 PM', '40', 'in progress', 'pending'),
('HRQl5xAaEItfuybfVRM9', 'PtLUoRc1sSusvAR3oZW6', 'shalu ansari', '6677556677', 'shalu@gmail.com', 'kD1TmpfkUBI3MbZQqKFY', 'Hc2ONpIYF7lkhhbjC8dy', '2024-01-31', '12:00 AM - 1:00 AM', '80', 'canceled', 'pending'),
('9tVn0jlPlS9fwOo3CDNQ', 'G0xqQK2i3tfAyW6bl4YD', 'raj ansari', '8877669977', 'raj786@gmail.com', 'qyT67nnRsvByK1FTvaB8', 'Hc2ONpIYF7lkhhbjC8dy', '2024-02-16', '1:30 PM - 2:30 PM', '600', 'booked', 'pending');



CREATE TABLE `services` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `service_detail` varchar(1500) NOT NULL,
  `category` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `services` (`id`, `name`, `price`, `image`, `service_detail`, `category`, `status`) VALUES
('gFKBAaUqsMTjvY3QmVg4', 'aroma therapy', '200', 'service.avif', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'massages', 'active'),
('kckGNfPq3VUxw2da1SYv', 'Foot relexation', '400', 'service-img-02.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'body treatment', 'active'),
('qyT67nnRsvByK1FTvaB8', 'couple massage', '600', 'Spa Programs for Couple.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'for couple', 'active'),
('jVuROJSplJd4EzuOEYjP', 'de-stress massage', '500', 'service-img-05.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'massages', 'active'),
('DPLNSX5QeGfDFYIZENzq', 'deep tissue massage', '400', 'Deep Tissue Massage.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'body treatment', 'active');



CREATE TABLE `users` (
  `id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `users` (`id`, `name`, `email`, `password`, `image`) VALUES
('PtLUoRc1sSusvAR3oZW6', 'shalu', 'shalu@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '9KLGLt6qO8P8ZdKgmeks.jpg'),
('U19IY50Q1hMlT2law9s2', 'john', 'john@gmail.com', 'a51dda7c7ff50b61eaea0444371f4a6a9301e501', '0T2Oz7E85Sn491mMddNB.jpg'),
('G0xqQK2i3tfAyW6bl4YD', 'raj', 'raj786@gmail.com', '3055effa054a24f84cf42cea946db4cdf445cb76', 'QzMuQrnoYJm9YHyZz1HS.jpg');
COMMIT;

