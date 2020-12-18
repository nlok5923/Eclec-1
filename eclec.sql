
-- Database: `eclec`
--

-- --------------------------------------------------------

--
-- Table structure for table `equipment`


CREATE TABLE `equipment` (
  `id` int(11) NOT NULL,
  `user` varchar(120) DEFAULT NULL,
  `equipment` varchar(120) DEFAULT NULL,
  `min_hrs` varchar(200) DEFAULT NULL,
  `max_hrs` varchar(250) DEFAULT NULL,
  `priority` varchar(200) DEFAULT NULL,
  `watt_consumption` varchar(250) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Table structure for table `images`

CREATE TABLE `images` (
  `time` date DEFAULT NULL,
  `username` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id` int(11) NOT NULL,
  `image` longblob NOT NULL,
  `uploaded` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `signupid`
--

CREATE TABLE `signupid` (
  `id` int(11) NOT NULL,
  `Name` varchar(120) DEFAULT NULL,
  `Username` varchar(120) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Password` varchar(250) DEFAULT NULL,
  `expenses` int(128) NOT NULL,
  `income` int(128) NOT NULL,
  `firstname` varchar(128) NOT NULL,
  `lastname` varchar(128) NOT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


