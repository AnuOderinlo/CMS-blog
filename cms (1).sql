-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2020 at 05:22 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `date` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `adminName` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `superAdmin` varchar(65) NOT NULL,
  `headline` varchar(30) NOT NULL,
  `image` varchar(64) NOT NULL DEFAULT 'myAvatar.png',
  `about` varchar(300) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `date`, `username`, `adminName`, `password`, `superAdmin`, `headline`, `image`, `about`) VALUES
(1, '23/Jun/2020 05:08pm', 'thanos', 'Temilolu Fag ', '12345', '', 'Web developer', 'IMG-20190401-WA0005.jpg', ' I love playing'),
(2, '23/Jun/2020 05:25pm', 'avenger', 'Gilbert Anu', '12345', 'Taye thanos', 'Web developer', 'IMG-20191005-WA0003.jpg', '   Tech enthusiast, interested in IoT(INTERNET OF THINGS)'),
(3, '23/Jun/2020 05:25pm', 'Evelyn', 'Ese Okwi', '12345', 'Taye thanos', 'Blogger | Data analyst', 'IMG_20200223_122201_049.jpg', 'Worshipper, data analyst enthusiast, lover of God, Leader, achiver.\r\nYou will surely fall in love with me if you really want to know about me'),
(4, '23/Jun/2020 05:25pm', 'Felix', ' Felix Tobi O', '12345', 'Taye thanos', 'Researcher | Scientist', 'IMG_20151023_132735.jpg', '    The best revenge is to be successful Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum veniam possimus in maxime quis, tenetur dolor recusandae a nulla qui enim, dolorem temporibus mollitia cum, quidem distinctio nobis voluptates harum.');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `author`, `date`) VALUES
(1, 'Science', 'Taye thanos', '23/Jun/2020 05:09pm'),
(2, 'Politics', 'Taye thanos', '23/Jun/2020 05:09pm'),
(3, 'Sports', 'Taye thanos', '23/Jun/2020 05:09pm'),
(4, 'Religion', 'Taye thanos', '23/Jun/2020 05:09pm'),
(5, 'Education', 'Taye thanos', '23/Jun/2020 05:09pm'),
(6, 'Technology', 'Taye thanos', '23/Jun/2020 06:23pm');

-- --------------------------------------------------------

--
-- Table structure for table `cms_blog_user`
--

CREATE TABLE `cms_blog_user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `about_you` varchar(255) NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `activation` varchar(20) NOT NULL,
  `activation_key` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `date` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(300) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `admin` varchar(65) NOT NULL,
  `status` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `date`, `name`, `email`, `comment`, `admin`, `status`) VALUES
(1, 1, '23/Jun/2020 05:45pm', 'Ada', 'adatobi@gmail.com', 'Nice post\r\n', 'Anuoluwapo', 'ON'),
(2, 3, '23/Jun/2020 05:56pm', 'Josh', 'josh@gmail.com', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis officia vero inventore, harum placeat enim sint voluptates est numquam fugiat consequuntur perspiciatis, suscipit assumenda. Omnis amet delectus dicta aliquid voluptatem!', 'Tobi Felix', 'ON'),
(3, 1, '23/Jun/2020 06:01pm', 'Anuoluwapo', 'anu@gmail.com', 'Nice one, I love this', 'Tobi Felix', 'ON');

-- --------------------------------------------------------

--
-- Table structure for table `password_recovery`
--

CREATE TABLE `password_recovery` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `activation_code` varchar(50) NOT NULL,
  `verification_time` int(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `admin_id` int(10) NOT NULL,
  `date` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `title` varchar(300) NOT NULL,
  `category` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `post` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `admin_id`, `date`, `author`, `title`, `category`, `image`, `post`) VALUES
(1, 1, '23/Jun/2020 05:11pm', 'Temilolu Fag ', 'Anti money laundering', 'Sports', 'Anti-Money-Laundering-Law-2.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor obcaecati tempora dolores eos delectus reiciendis excepturi error dignissimos provident nemo cumque ducimus accusantium repudiandae culpa assumenda nisi, ut reprehenderit ad!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor obcaecati tempora dolores eos delectus reiciendis excepturi error dignissimos provident nemo cumque ducimus accusantium repudiandae culpa assumenda nisi, ut reprehenderit ad!Lorem ipsum dolor sit am'),
(2, 1, '23/Jun/2020 05:14pm', 'Temilolu Fag ', 'Racism', 'Science', 'blacklives.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor obcaecati tempora dolores eos delectus reiciendis excepturi error dignissimos provident nemo cumque ducimus accusantium repudiandae culpa assumenda nisi, ut reprehenderit ad!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor obcaecati tempora dolores eos delectus reiciendis excepturi error dignissimos provident nemo cumque ducimus accusantium repudiandae culpa assumenda nisi, ut reprehenderit ad!Lorem ipsum dolor sit am'),
(3, 4, '23/Jun/2020 05:55pm', ' Felix Tobi O', 'The Art of Protest', 'Science', 'p08gq883.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis officia vero inventore, harum placeat enim sint voluptates est numquam fugiat consequuntur perspiciatis, suscipit assumenda. Omnis amet delectus dicta aliquid voluptatem!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis officia vero inventore, harum placeat enim sint voluptates est numquam fugiat consequuntur perspiciatis, suscipit assumenda. Omnis amet delectus dicta aliquid voluptatem!Lorem ipsum dolor sit amet, '),
(4, 4, '23/Jun/2020 06:16pm', ' Felix Tobi O', 'Salvation', 'Religion', 'grace.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis officia vero inventore, harum placeat enim sint voluptates est numquam fugiat consequuntur perspiciatis, suscipit assumenda. Omnis amet delectus dicta aliquid voluptatem!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis officia vero inventore, harum placeat enim sint voluptates est numquam fugiat consequuntur perspiciatis, suscipit assumenda. Omnis amet delectus dicta aliquid voluptatem!Lorem ipsum dolor sit amet, '),
(5, 3, '23/Jun/2020 06:19pm', 'Ese Okwi', 'Faith of our Fathers', 'Religion', 'law and grace.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis officia vero inventore, harum placeat enim sint voluptates est numquam fugiat consequuntur perspiciatis, suscipit assumenda. Omnis amet delectus dicta aliquid voluptatem!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis officia vero inventore, harum placeat enim sint voluptates est numquam fugiat consequuntur perspiciatis, suscipit assumenda. Omnis amet delectus dicta aliquid voluptatem!Lorem ipsum dolor sit amet, '),
(6, 3, '23/Jun/2020 06:21pm', 'Ese Okwi', 'Savings! one step to Wealth', 'Science', 'savings.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis officia vero inventore, harum placeat enim sint voluptates est numquam fugiat consequuntur perspiciatis, suscipit assumenda. Omnis amet delectus dicta aliquid voluptatem!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis officia vero inventore, harum placeat enim sint voluptates est numquam fugiat consequuntur perspiciatis, suscipit assumenda. Omnis amet delectus dicta aliquid voluptatem!Lorem ipsum dolor sit amet, '),
(7, 1, '23/Jun/2020 06:23pm', 'Temilolu Fag ', 'Invvestment', 'Science', 'Savings-Investment-images.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis officia vero inventore, harum placeat enim sint voluptates est numquam fugiat consequuntur perspiciatis, suscipit assumenda. Omnis amet delectus dicta aliquid voluptatem!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis officia vero inventore, harum placeat enim sint voluptates est numquam fugiat consequuntur perspiciatis, suscipit assumenda. Omnis amet delectus dicta aliquid voluptatem!Lorem ipsum dolor sit amet, '),
(8, 1, '23/Jun/2020 06:24pm', 'Temilolu Fag ', 'A beginner\'s path to become web developer', 'Technology', 'web3.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis officia vero inventore, harum placeat enim sint voluptates est numquam fugiat consequuntur perspiciatis, suscipit assumenda. Omnis amet delectus dicta aliquid voluptatem!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis officia vero inventore, harum placeat enim sint voluptates est numquam fugiat consequuntur perspiciatis, suscipit assumenda. Omnis amet delectus dicta aliquid voluptatem!Lorem ipsum dolor sit amet, '),
(10, 2, '25/Jun/2020 02:49pm', 'Gilbert Anu', 'Internet of things', 'Technology', 'iot.jpg', 'Internet of Things is the new era of technology Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repudiandae aliquid, quaerat ipsa similique excepturi dicta. Fugiat doloremque beatae consequatur dignissimos officia natus praesentium, mollitia, voluptates, sapiente molestiae illo ducimus tempore!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repudiandae aliquid, quaerat ipsa similique excepturi dicta. Fugiat doloremque beatae consequatur dignissimos officia natus praesentium, ');

-- --------------------------------------------------------

--
-- Table structure for table `user_registration_time`
--

CREATE TABLE `user_registration_time` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `registration_date` varchar(255) NOT NULL,
  `registration_time` int(50) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_blog_user`
--
ALTER TABLE `cms_blog_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `activation_key` (`activation_key`),
  ADD KEY `email_2` (`email`(6)),
  ADD KEY `firstname` (`firstname`(6)),
  ADD KEY `lastname` (`lastname`(6)),
  ADD KEY `about_you` (`about_you`(10));

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `password_recovery`
--
ALTER TABLE `password_recovery`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `activation_code` (`activation_code`),
  ADD KEY `email_2` (`email`(6));

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_registration_time`
--
ALTER TABLE `user_registration_time`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `email_2` (`email`(6));

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cms_blog_user`
--
ALTER TABLE `cms_blog_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `password_recovery`
--
ALTER TABLE `password_recovery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_registration_time`
--
ALTER TABLE `user_registration_time`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
