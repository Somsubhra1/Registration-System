SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+05:30";



CREATE TABLE IF NOT EXISTS users (
  `id` int(11) NOT NULL,
  `name` varchar(1040) NOT NULL,
  `lname` varchar(1040) NOT NULL,
  `uname` varchar(1040) NOT NULL,
  `email` varchar(1040) NOT NULL,
  `password` varchar(1132) NOT NULL,
  `picture` varchar(1040) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;


INSERT INTO `users` (`id`, `name`, `lname`, `uname`, `email`, `password`, `picture`) VALUES
(1, 'sam', 'sharma', 'sammy', 'sam@samsharma.co', '202cb962ac59075b964b07152d234b70', 'Koala.jpg'),
(2, 'rome', 'verma', 'romy', 'rome@romeverma.co', '202cb962ac59075b964b07152d234b70', 'Chrysanthemum.jpg'),
(3, 'ram', 'karma', 'ramy', 'ram@ramkarma.co', '202cb962ac59075b964b07152d234b70', '');

ALTER TABLE `users`
ADD PRIMARY KEY (`id`);
 
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4; 
 

