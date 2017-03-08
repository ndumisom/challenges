CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `text_message` text,
  `messages_title` varchar(50) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

