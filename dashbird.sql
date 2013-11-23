-- DashBird SQL


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE IF NOT EXISTS `blogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(300) NOT NULL,
  `url` varchar(300) NOT NULL,
  `theme` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `url`, `theme`) VALUES
(1, 'DashBird', 'default', 'dashbird');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `blog` varchar(300) NOT NULL,
  `filename` varchar(1000) NOT NULL,
  `type` varchar(100) NOT NULL,
  `category` varchar(300) NOT NULL,
  `title` varchar(300) NOT NULL,
  `description` text NOT NULL,
  `order_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blog` varchar(300) NOT NULL,
  `title` varchar(300) NOT NULL,
  `description` text NOT NULL,
  `url` varchar(300) NOT NULL,
  `type` varchar(300) NOT NULL,
  `feed` varchar(500) NOT NULL,
  `static_file` varchar(500) NOT NULL,
  `order_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `blog`, `title`, `description`, `url`, `type`, `feed`, `static_file`, `order_id`) VALUES
(2, 'default', 'Home', '', 'home', 'standard', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `external_id` varchar(1000) NOT NULL,
  `external_link` varchar(800) NOT NULL,
  `external_image` varchar(800) NOT NULL,
  `type` varchar(300) NOT NULL,
  `blog` varchar(300) NOT NULL,
  `page` varchar(300) NOT NULL,
  `col` varchar(300) NOT NULL,
  `anchor` varchar(300) NOT NULL,
  `title` varchar(300) NOT NULL,
  `body` text NOT NULL,
  `extended` text NOT NULL,
  `caption` text NOT NULL,
  `read_more_link` tinyint(2) NOT NULL,
  `url` varchar(500) NOT NULL,
  `image` varchar(500) NOT NULL,
  `config1` text NOT NULL,
  `config2` text NOT NULL,
  `config3` text NOT NULL,
  `config4` text NOT NULL,
  `config5` text NOT NULL,
  `author` varchar(300) NOT NULL,
  `visible` tinyint(2) NOT NULL,
  `publish` tinyint(2) NOT NULL,
  `created` datetime NOT NULL,
  `order_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blog` varchar(300) NOT NULL,
  `name` varchar(300) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `blog`, `name`, `value`) VALUES
(1, 'default', 'title', 'DashBird'),
(3, 'default', 'per_page', '5');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blog` varchar(300) NOT NULL,
  `username` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `email` varchar(500) NOT NULL,
  `level` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `blog`, `username`, `password`, `email`, `level`) VALUES
(2, 'default', 'admin', 'melodynelson', '', 5);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
