CREATE TABLE `cache` (
  `url` varchar(255) NOT NULL,
  `html` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;