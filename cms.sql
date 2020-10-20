-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2020 at 04:06 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

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
  `email` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `authority` varchar(20) NOT NULL DEFAULT 'admin',
  `headline` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'myAvatar.png',
  `about` varchar(300) NOT NULL,
  `activation` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `code_time` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `date`, `username`, `adminName`, `email`, `password`, `authority`, `headline`, `image`, `about`, `activation`, `code`, `code_time`) VALUES
(1, '23/Jun/2020 05:08pm', 'anu', 'Anuoluwapo Gilbert', 'anu@gmail.com', '12345', 'super_admin', 'Web developer', 'IMG-20190401-WA0005.jpg', 'I love surfing the internet and Internet of Things', 'active', '', ''),
(2, '23/Jun/2020 05:25pm', 'avenger', 'Gilbert Anu', '', '12345', 'admin', 'Web developer', 'IMG-20191005-WA0003.jpg', '   Tech enthusiast, interested in IoT(INTERNET OF THINGS)', 'inactive', '', ''),
(3, '23/Jun/2020 05:25pm', 'Evelyn', 'Ese Okwi E', '', '12345', 'admin', 'Blogger | Data analyst | Customer Representative', 'IMG_20200105_125152_605.jpg', 'Worshipper, data analyst enthusiast, lover of God, Leader, achiver.rnYou will surely fall in love with me if you really want to know about me', '', '', ''),
(4, '23/Jun/2020 05:25pm', 'Felix', 'Felix Tobi O', '', '12345', 'admin', 'Researcher | Scientist', 'IMG_20151023_132735.jpg', '    The best revenge is to be successful Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum veniam possimus in maxime quis, tenetur dolor recusandae a nulla qui enim, dolorem temporibus mollitia cum, quidem distinctio nobis voluptates harum.', '', '', ''),
(5, '06/Jul/2020 11:08am', 'Edified', 'Gift Wisdom', '', '12345', 'admin', '', 'myAvatar.png', '', '', '', ''),
(6, '07/Jul/2020 01:20pm', 'Blessed', 'Blessed Assurance', '', '12345', 'admin', '', 'myAvatar.png', '', '', '', ''),
(7, '15/Aug/2020 05:10pm', 'Ezra', 'Ezra Williams', '', '12345', 'admin', 'Artress', 'myAvatar.png', 'Loving, caring, awesome, mother of two.... Acting is my passion', '', '', ''),
(8, '13/Sep/2020 03:15pm', 'Tboy', 'Taiwo Williams', 'taye@gmail.com', '1234', 'admin', '', 'myAvatar.png', '', '', '', '');

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
(6, 'Technology', 'Taye thanos', '23/Jun/2020 06:23pm'),
(7, 'Climate-change', 'Temilolu Fag ', '06/Jul/2020 10:40am'),
(27, 'Leadership', 'Anuoluwapo Gilbert', '10/Sep/2020 06:52pm'),
(23, 'Virtual-tech', 'Anuoluwapo Gilbert', '10/Sep/2020 06:47pm'),
(24, 'Relationsip', 'Anuoluwapo Gilbert', '10/Sep/2020 06:48pm');

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
(90, 5, '26/Aug/2020 09:21pm', 'Dennis', 'dennis@sample.com', 'Awesomw post', '', ''),
(94, 5, '26/Aug/2020 09:56pm', 'kay', 'kay@gmail.com', 'Love this', '', ''),
(3, 1, '23/Jun/2020 06:01pm', 'Anuoluwapo', 'anu@gmail.com', 'Nice one, I love this', 'Tobi Felix', 'ON'),
(4, 11, '06/Jul/2020 11:54am', 'Josh', 'tobi@yahoo.com', 'Good one', 'Pending', 'OFF'),
(5, 11, '07/Jul/2020 01:43pm', 'Nimi', 'nimi_bis@yahoo.com', 'I totally agree', '', ''),
(6, 11, '11/Jul/2020 07:37pm', 'Tolu', 'tolu@gmail.com', 'This is a very nice post', '', ''),
(96, 6, '27/Aug/2020 11:28am', 'Tobi', 'tobi@gmail.com', 'Savings is the best', '', ''),
(23, 8, '12/Jul/2020 03:33pm', 'Josh', 'josh@gmail.com', 'Hellooo', '', ''),
(127, 13, '15/Oct/2020 10:35am', 'Ada', 'tobi@yahoo.com', 'Awesome post', '', ''),
(89, 3, '05/Aug/2020 09:43am', 'Ese', 'josh@gmail.com', 'Awesome', '', ''),
(22, 8, '12/Jul/2020 03:32pm', 'Anuoluwapo', 'anu@gmail.com', 'good post', '', ''),
(88, 7, '04/Aug/2020 10:53am', 'Seyi Onifade', 'seyi@gmail.com', 'What a great post', '', ''),
(20, 11, '12/Jul/2020 03:29pm', 'Seyi', 'seyi@gmail.com', 'Good article', '', ''),
(27, 8, '12/Jul/2020 08:22pm', 'Tobechukwu', 'josh@gmail.com', 'I need to share this', '', ''),
(98, 13, '27/Aug/2020 11:30am', 'honesty', 'honest@yahoo.com', 'Great one', '', ''),
(97, 6, '27/Aug/2020 11:29am', 'Dennis', 'dennis@gmail.com', 'Ok good', '', ''),
(87, 7, '03/Aug/2020 09:37pm', 'Tobechukwu', 'adatobi@gmail.com', 'I love this post', '', ''),
(86, 11, '03/Aug/2020 06:29pm', 'Ese', 'adatobi@gmail.com', 'Awesome', '', ''),
(85, 11, '03/Aug/2020 06:12pm', 'Ada', 'adatobi@gmail.com', 'nice job', '', ''),
(84, 11, '03/Aug/2020 04:33pm', 'Mark', 'mark@gmail.com', 'Great one', '', ''),
(83, 11, '03/Aug/2020 04:30pm', 'Tolu', 'tolu@yahoo.com', 'I love this post', '', ''),
(124, 2, '17/Sep/2020 09:31pm', 'Nonso', 'nonso@gmail.com', 'Nice one there', '', ''),
(125, 4, '17/Sep/2020 09:32pm', 'Ada', 'anu@gmail.com', 'Ok na', '', ''),
(126, 1, '06/Oct/2020 11:55am', 'Favour', 'favour@gmail.com', 'Awesome', '', ''),
(101, 13, '28/Aug/2020 05:52pm', 'Tofunmi', 'toto@yahoo.com', 'Nice one', '', ''),
(67, 10, '23/Jul/2020 03:10pm', 'Habash', 'habash@gmail.com', 'Good one at that', '', ''),
(63, 10, '13/Jul/2020 07:29pm', 'Anuoluwapo', 'anu@gmail.com', 'Good job', '', ''),
(64, 10, '13/Jul/2020 07:29pm', 'Tobi', 'adatobi@gmail.com', 'Ok na', '', ''),
(99, 14, '27/Aug/2020 11:41am', 'Tobechukwu', 'tobechu@yahoo.com', 'Love it', '', ''),
(100, 14, '27/Aug/2020 11:54am', 'Mark', 'mark@gmail.com', 'Awesome', '', ''),
(102, 14, '30/Aug/2020 07:18pm', 'Alex', 'alex@yahoo.com', 'Greate article', '', ''),
(123, 46, '10/Sep/2020 02:54pm', 'Josh', 'tobi@yahoo.com', 'awesome', '', ''),
(122, 13, '05/Sep/2020 12:13pm', 'Tao', 'tao@gmail.com', 'You are doing well', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `unique_id` varchar(255) NOT NULL,
  `time` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`, `email`, `unique_id`, `time`) VALUES
(1, 'avenger', '0437f', 'oderinloezekiel@gmail.com', '', 0),
(2, 'thanos', '12345', '', '', 0);

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
  `post` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `admin_id`, `date`, `author`, `title`, `category`, `image`, `post`) VALUES
(1, 1, '23/Jun/2020 05:11pm', 'Anuoluwapo Gilbert', 'Anti money laundering', 'Science', 'grace.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor obcaecati tempora dolores eos delectus reiciendis excepturi error dignissimos provident nemo cumque ducimus accusantium repudiandae culpa assumenda nisi, ut reprehenderit ad!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor obcaecati tempora dolores eos delectus reiciendis excepturi error dignissimos provident nemo cumque ducimus accusantium repudiandae culpa assumenda nisi, ut reprehenderit ad!Lorem ipsum dolor sit am'),
(2, 1, '23/Jun/2020 05:14pm', 'Anuoluwapo Gilbert', 'Racism', 'Science', 'blacklives.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor obcaecati tempora dolores eos delectus reiciendis excepturi error dignissimos provident nemo cumque ducimus accusantium repudiandae culpa assumenda nisi, ut reprehenderit ad!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor obcaecati tempora dolores eos delectus reiciendis excepturi error dignissimos provident nemo cumque ducimus accusantium repudiandae culpa assumenda nisi, ut reprehenderit ad!Lorem ipsum dolor sit am'),
(3, 4, '23/Jun/2020 05:55pm', 'Felix Tobi O', 'The Art of Protest', 'Science', 'p08gq883.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis officia vero inventore, harum placeat enim sint voluptates est numquam fugiat consequuntur perspiciatis, suscipit assumenda. Omnis amet delectus dicta aliquid voluptatem!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis officia vero inventore, harum placeat enim sint voluptates est numquam fugiat consequuntur perspiciatis, suscipit assumenda. Omnis amet delectus dicta aliquid voluptatem!Lorem ipsum dolor sit amet, '),
(4, 4, '23/Jun/2020 06:16pm', 'Felix Tobi O', 'Salvation', 'Religion', 'grace.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis officia vero inventore, harum placeat enim sint voluptates est numquam fugiat consequuntur perspiciatis, suscipit assumenda. Omnis amet delectus dicta aliquid voluptatem!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis officia vero inventore, harum placeat enim sint voluptates est numquam fugiat consequuntur perspiciatis, suscipit assumenda. Omnis amet delectus dicta aliquid voluptatem!Lorem ipsum dolor sit amet, '),
(5, 3, '23/Jun/2020 06:19pm', 'Ese Okwi E', 'Faith of our Fathers', 'Religion', 'law and grace.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis officia vero inventore, harum placeat enim sint voluptates est numquam fugiat consequuntur perspiciatis, suscipit assumenda. Omnis amet delectus dicta aliquid voluptatem!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis officia vero inventore, harum placeat enim sint voluptates est numquam fugiat consequuntur perspiciatis, suscipit assumenda. Omnis amet delectus dicta aliquid voluptatem!Lorem ipsum dolor sit amet, '),
(6, 3, '23/Jun/2020 06:21pm', 'Ese Okwi E', 'Savings! one step to Wealth', 'Science', 'savings.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis officia vero inventore, harum placeat enim sint voluptates est numquam fugiat consequuntur perspiciatis, suscipit assumenda. Omnis amet delectus dicta aliquid voluptatem!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis officia vero inventore, harum placeat enim sint voluptates est numquam fugiat consequuntur perspiciatis, suscipit assumenda. Omnis amet delectus dicta aliquid voluptatem!Lorem ipsum dolor sit amet, '),
(7, 1, '23/Jun/2020 06:23pm', 'Anuoluwapo Gilbert', 'Invvestment', 'Science', 'Savings-Investment-images.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis officia vero inventore, harum placeat enim sint voluptates est numquam fugiat consequuntur perspiciatis, suscipit assumenda. Omnis amet delectus dicta aliquid voluptatem!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis officia vero inventore, harum placeat enim sint voluptates est numquam fugiat consequuntur perspiciatis, suscipit assumenda. Omnis amet delectus dicta aliquid voluptatem!Lorem ipsum dolor sit amet, '),
(8, 1, '23/Jun/2020 06:24pm', 'Anuoluwapo Gilbert', 'A beginner\'s path to become web developer', 'Technology', 'web3.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis officia vero inventore, harum placeat enim sint voluptates est numquam fugiat consequuntur perspiciatis, suscipit assumenda. Omnis amet delectus dicta aliquid voluptatem!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis officia vero inventore, harum placeat enim sint voluptates est numquam fugiat consequuntur perspiciatis, suscipit assumenda. Omnis amet delectus dicta aliquid voluptatem!Lorem ipsum dolor sit amet, '),
(10, 2, '25/Jun/2020 02:49pm', 'Gilbert Anu', 'Internet of things', 'Technology', 'iot.jpg', 'Internet of Things is the new era of technology Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repudiandae aliquid, quaerat ipsa similique excepturi dicta. Fugiat doloremque beatae consequatur dignissimos officia natus praesentium, mollitia, voluptates, sapiente molestiae illo ducimus tempore!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repudiandae aliquid, quaerat ipsa similique excepturi dicta. Fugiat doloremque beatae consequatur dignissimos officia natus praesentium, '),
(11, 1, '05/Jul/2020 06:29pm', 'Anuoluwapo Gilbert', 'G.O.A.T(Greatest Of All Time)', 'Sports', 'dembele-watching.jpg', 'The greatest of All time in Football history is no doubt Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum et, quaerat repellat vel tempora minus doloribus blanditiis, impedit cupiditate quos accusantium iusto, qui sit nemo rerum at quisquam possimus maiores.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum et, quaerat repellat vel tempora minus doloribus blanditiis, impedit cupiditate quos accusantium iusto, qui sit nemo rerum at quisquam possimus maiores.Lorem ipsum'),
(13, 3, '18/Aug/2020 02:37pm', 'Ese Okwi E', 'Secret of the heart', 'Science', 'programming to learn first.JPG', 'It was on a Sunday morning Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias earum harum praesentium repellendus nesciunt, rem optio omnis unde enim doloremque.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias earum harum praesentium repellendus nesciunt, rem optio omnis unde enim doloremque.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias earum harum praesentium repellendus nesciunt, rem optio omnis unde enim doloremque.\\r\\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Alias earum harum praesentium repellendus nesciunt, rem optio omnis unde enim doloremque.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias earum harum praesentium repellendus nesciunt, rem optio omnis unde enim doloremque.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias earum harum praesentium repellendus nesciunt, rem optio omnis unde enim doloremque.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias earum harum praesentium repellendus nesciunt, rem optio omnis unde enim doloremque.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias earum harum praesentium repellendus nesciunt, rem optio omnis unde enim doloremque.\\r\\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Alias earum harum praesentium repellendus nesciunt, rem optio omnis unde enim doloremque.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias earum harum praesentium repellendus nesciunt, rem optio omnis unde enim doloremque.\\r\\n&amp;nbsp;'),
(14, 3, '27/Aug/2020 11:40am', 'Ese Okwi E', 'Depression', 'Science', 'codeNeverLate.jpg', 'Lorem ipsum dolor sit amet consectetur, adipisicing, elit. Quia facilis similique dolorum dignissimos voluptas iure quis quas eaque. Esse, sunt.Lorem ipsum dolor sit amet consectetur, adipisicing, elit. Quia facilis similique dolorum dignissimos voluptas iure quis quas eaque. Esse, sunt.Lorem ipsum dolor sit amet consectetur, adipisicing, elit. Quia facilis similique dolorum dignissimos voluptas iure quis quas eaque. Esse, sunt.Lorem ipsum dolor sit amet consectetur, adipisicing, elit. Quia facilis similique dolorum dignissimos voluptas iure quis quas eaque. Esse, sunt.Lorem ipsum dolor sit amet consectetur, adipisicing, elit. Quia facilis similique dolorum dignissimos voluptas iure quis quas eaque. Esse, sunt.\\r\\nLorem ipsum dolor sit amet consectetur, adipisicing, elit. Quia facilis similique dolorum dignissimos voluptas iure quis quas eaque. Esse, sunt.Lorem ipsum dolor sit amet consectetur, adipisicing, elit. Quia facilis similique dolorum dignissimos voluptas iure quis quas eaque. Esse, sunt.Lorem ipsum dolor sit amet consectetur, adipisicing, elit. Quia facilis similique dolorum dignissimos voluptas iure quis quas eaque. Esse, sunt.\\r\\nLorem ipsum dolor sit amet consectetur, adipisicing, elit. Quia facilis similique dolorum dignissimos voluptas iure quis quas eaque. Esse, sunt.Lorem ipsum dolor sit amet consectetur, adipisicing, elit. Quia facilis similique dolorum dignissimos voluptas iure quis quas eaque. Esse, sunt.'),
(46, 1, '09/Sep/2020 04:24pm', 'Anuoluwapo Gilbert', 'Dealing with addiction', 'Religion', 'addiction.jpg', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aut velit recusandae necessitatibus architecto, repellat repellendus aliquam voluptatibus nobis distinctio provident voluptatum a eos quisquam sapiente labore pariatur quae id natus! Reprehenderit dolorem, quibusdam molestiae rerum enim voluptatum ab vitae harum!Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aut velit recusandae necessitatibus architecto, repellat repellendus aliquam voluptatibus nobis distinctio provident voluptatum a eos quisquam sapiente labore pariatur quae id natus! Reprehenderit dolorem, quibusdam molestiae rerum enim voluptatum ab vitae harum!Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aut velit recusandae necessitatibus architecto, repellat repellendus aliquam voluptatibus nobis distinctio provident voluptatum a eos quisquam sapiente labore pariatur quae id natus! Reprehenderit dolorem, quibusdam molestiae rerum enim voluptatum ab vitae harum!Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aut velit recusandae necessitatibus architecto, repellat repellendus aliquam voluptatibus nobis distinctio provident voluptatum a eos quisquam sapiente labore pariatur quae id natus! Reprehenderit dolorem, quibusdam molestiae rerum enim voluptatum ab vitae harum!Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aut velit recusandae necessitatibus architecto, repellat repellendus aliquam voluptatibus nobis distinctio provident voluptatum a eos quisquam sapiente labore pariatur quae id natus! Reprehenderit dolorem, quibusdam molestiae rerum enim voluptatum ab vitae harum!Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aut velit recusandae necessitatibus architecto, repellat repellendus aliquam voluptatibus nobis distinctio provident voluptatum a eos quisquam sapiente labore pariatur quae id natus! Reprehenderit dolorem, quibusdam molestiae rerum enim voluptatum ab vitae harum!Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aut velit recusandae necessitatibus architecto, repellat repellendus aliquam voluptatibus nobis distinctio provident voluptatum a eos quisquam sapiente labore pariatur quae id natus! Reprehenderit dolorem, quibusdam molestiae rerum enim voluptatum ab vitae harum!Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aut velit recusandae necessitatibus architecto, repellat repellendus aliquam voluptatibus nobis distinctio provident voluptatum a eos quisquam sapiente labore pariatur quae id natus! Reprehenderit dolorem, quibusdam molestiae rerum enim voluptatum ab vitae harum!Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aut velit recusandae necessitatibus architecto, repellat repellendus aliquam voluptatibus nobis distinctio provident voluptatum a eos quisquam sapiente labore pariatur quae id natus! Reprehenderit dolorem, quibusdam molestiae rerum enim voluptatum ab vitae harum!');

-- --------------------------------------------------------

--
-- Table structure for table `posts_backup`
--

CREATE TABLE `posts_backup` (
  `id` int(11) NOT NULL,
  `admin_id` int(10) NOT NULL,
  `date` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `title` varchar(300) NOT NULL,
  `category` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `post` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts_backup`
--

INSERT INTO `posts_backup` (`id`, `admin_id`, `date`, `author`, `title`, `category`, `image`, `post`) VALUES
(1, 1, '23/Jun/2020 05:11pm', 'Temilolu Fag', 'Anti money laundering', 'Sports', 'Anti-Money-Laundering-Law-2.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor obcaecati tempora dolores eos delectus reiciendis excepturi error dignissimos provident nemo cumque ducimus accusantium repudiandae culpa assumenda nisi, ut reprehenderit ad!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor obcaecati tempora dolores eos delectus reiciendis excepturi error dignissimos provident nemo cumque ducimus accusantium repudiandae culpa assumenda nisi, ut reprehenderit ad!Lorem ipsum dolor sit am'),
(2, 1, '23/Jun/2020 05:14pm', 'Temilolu Fag', 'Racism', 'Science', 'blacklives.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor obcaecati tempora dolores eos delectus reiciendis excepturi error dignissimos provident nemo cumque ducimus accusantium repudiandae culpa assumenda nisi, ut reprehenderit ad!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor obcaecati tempora dolores eos delectus reiciendis excepturi error dignissimos provident nemo cumque ducimus accusantium repudiandae culpa assumenda nisi, ut reprehenderit ad!Lorem ipsum dolor sit am'),
(3, 4, '23/Jun/2020 05:55pm', 'Felix Tobi O', 'The Art of Protest', 'Science', 'p08gq883.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis officia vero inventore, harum placeat enim sint voluptates est numquam fugiat consequuntur perspiciatis, suscipit assumenda. Omnis amet delectus dicta aliquid voluptatem!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis officia vero inventore, harum placeat enim sint voluptates est numquam fugiat consequuntur perspiciatis, suscipit assumenda. Omnis amet delectus dicta aliquid voluptatem!Lorem ipsum dolor sit amet, '),
(4, 4, '23/Jun/2020 06:16pm', 'Felix Tobi O', 'Salvation', 'Religion', 'grace.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis officia vero inventore, harum placeat enim sint voluptates est numquam fugiat consequuntur perspiciatis, suscipit assumenda. Omnis amet delectus dicta aliquid voluptatem!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis officia vero inventore, harum placeat enim sint voluptates est numquam fugiat consequuntur perspiciatis, suscipit assumenda. Omnis amet delectus dicta aliquid voluptatem!Lorem ipsum dolor sit amet, '),
(5, 3, '23/Jun/2020 06:19pm', 'Ese Okwi', 'Faith of our Fathers', 'Religion', 'law and grace.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis officia vero inventore, harum placeat enim sint voluptates est numquam fugiat consequuntur perspiciatis, suscipit assumenda. Omnis amet delectus dicta aliquid voluptatem!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis officia vero inventore, harum placeat enim sint voluptates est numquam fugiat consequuntur perspiciatis, suscipit assumenda. Omnis amet delectus dicta aliquid voluptatem!Lorem ipsum dolor sit amet, '),
(6, 3, '23/Jun/2020 06:21pm', 'Ese Okwi', 'Savings! one step to Wealth', 'Science', 'savings.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis officia vero inventore, harum placeat enim sint voluptates est numquam fugiat consequuntur perspiciatis, suscipit assumenda. Omnis amet delectus dicta aliquid voluptatem!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis officia vero inventore, harum placeat enim sint voluptates est numquam fugiat consequuntur perspiciatis, suscipit assumenda. Omnis amet delectus dicta aliquid voluptatem!Lorem ipsum dolor sit amet, '),
(7, 1, '23/Jun/2020 06:23pm', 'Temilolu Fag', 'Invvestment', 'Science', 'Savings-Investment-images.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis officia vero inventore, harum placeat enim sint voluptates est numquam fugiat consequuntur perspiciatis, suscipit assumenda. Omnis amet delectus dicta aliquid voluptatem!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis officia vero inventore, harum placeat enim sint voluptates est numquam fugiat consequuntur perspiciatis, suscipit assumenda. Omnis amet delectus dicta aliquid voluptatem!Lorem ipsum dolor sit amet, '),
(8, 1, '23/Jun/2020 06:24pm', 'Temilolu Fag', 'A beginner\'s path to become web developer', 'Technology', 'web3.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis officia vero inventore, harum placeat enim sint voluptates est numquam fugiat consequuntur perspiciatis, suscipit assumenda. Omnis amet delectus dicta aliquid voluptatem!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis officia vero inventore, harum placeat enim sint voluptates est numquam fugiat consequuntur perspiciatis, suscipit assumenda. Omnis amet delectus dicta aliquid voluptatem!Lorem ipsum dolor sit amet, '),
(10, 2, '25/Jun/2020 02:49pm', 'Gilbert Anu', 'Internet of things', 'Technology', 'iot.jpg', 'Internet of Things is the new era of technology Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repudiandae aliquid, quaerat ipsa similique excepturi dicta. Fugiat doloremque beatae consequatur dignissimos officia natus praesentium, mollitia, voluptates, sapiente molestiae illo ducimus tempore!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repudiandae aliquid, quaerat ipsa similique excepturi dicta. Fugiat doloremque beatae consequatur dignissimos officia natus praesentium, '),
(11, 1, '05/Jul/2020 06:29pm', 'Temilolu Fag', 'G.O.A.T(Greatest Of All Time)', 'Sports', 'dembele-watching.jpg', 'The greatest of All time in Football history is no doubt Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum et, quaerat repellat vel tempora minus doloribus blanditiis, impedit cupiditate quos accusantium iusto, qui sit nemo rerum at quisquam possimus maiores.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum et, quaerat repellat vel tempora minus doloribus blanditiis, impedit cupiditate quos accusantium iusto, qui sit nemo rerum at quisquam possimus maiores.Lorem ipsum'),
(13, 3, '18/Aug/2020 02:37pm', 'Ese Okwi', 'Secret of the heart', 'Science', 'programming to learn first.JPG', 'It was on a Sunday morning Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias earum harum praesentium repellendus nesciunt, rem optio omnis unde enim doloremque.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias earum harum praesentium repellendus nesciunt, rem optio omnis unde enim doloremque.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias earum harum praesentium repellendus nesciunt, rem optio omnis unde enim doloremque.\\r\\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Alias earum harum praesentium repellendus nesciunt, rem optio omnis unde enim doloremque.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias earum harum praesentium repellendus nesciunt, rem optio omnis unde enim doloremque.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias earum harum praesentium repellendus nesciunt, rem optio omnis unde enim doloremque.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias earum harum praesentium repellendus nesciunt, rem optio omnis unde enim doloremque.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias earum harum praesentium repellendus nesciunt, rem optio omnis unde enim doloremque.\\r\\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Alias earum harum praesentium repellendus nesciunt, rem optio omnis unde enim doloremque.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias earum harum praesentium repellendus nesciunt, rem optio omnis unde enim doloremque.\\r\\n&amp;nbsp;'),
(14, 3, '27/Aug/2020 11:40am', 'Ese Okwi', 'Depression', 'Science', 'codeNeverLate.jpg', 'Lorem ipsum dolor sit amet consectetur, adipisicing, elit. Quia facilis similique dolorum dignissimos voluptas iure quis quas eaque. Esse, sunt.Lorem ipsum dolor sit amet consectetur, adipisicing, elit. Quia facilis similique dolorum dignissimos voluptas iure quis quas eaque. Esse, sunt.Lorem ipsum dolor sit amet consectetur, adipisicing, elit. Quia facilis similique dolorum dignissimos voluptas iure quis quas eaque. Esse, sunt.Lorem ipsum dolor sit amet consectetur, adipisicing, elit. Quia facilis similique dolorum dignissimos voluptas iure quis quas eaque. Esse, sunt.Lorem ipsum dolor sit amet consectetur, adipisicing, elit. Quia facilis similique dolorum dignissimos voluptas iure quis quas eaque. Esse, sunt.\\r\\nLorem ipsum dolor sit amet consectetur, adipisicing, elit. Quia facilis similique dolorum dignissimos voluptas iure quis quas eaque. Esse, sunt.Lorem ipsum dolor sit amet consectetur, adipisicing, elit. Quia facilis similique dolorum dignissimos voluptas iure quis quas eaque. Esse, sunt.Lorem ipsum dolor sit amet consectetur, adipisicing, elit. Quia facilis similique dolorum dignissimos voluptas iure quis quas eaque. Esse, sunt.\\r\\nLorem ipsum dolor sit amet consectetur, adipisicing, elit. Quia facilis similique dolorum dignissimos voluptas iure quis quas eaque. Esse, sunt.Lorem ipsum dolor sit amet consectetur, adipisicing, elit. Quia facilis similique dolorum dignissimos voluptas iure quis quas eaque. Esse, sunt.');

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
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `posts_backup`
--
ALTER TABLE `posts_backup`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `cms_blog_user`
--
ALTER TABLE `cms_blog_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `password_recovery`
--
ALTER TABLE `password_recovery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `posts_backup`
--
ALTER TABLE `posts_backup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_registration_time`
--
ALTER TABLE `user_registration_time`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
