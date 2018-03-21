SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: pong
--
CREATE DATABASE IF NOT EXISTS pong DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE pong;

-- --------------------------------------------------------

--
-- Table structure for table leaderboard
--

CREATE TABLE leaderboard (
  user varchar(50) NOT NULL,
  win int(11) NOT NULL,
  lost int(11) NOT NULL,
  ratio decimal(2,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table users
--

CREATE TABLE users (
  username varchar(50) NOT NULL,
  email varchar(50) NOT NULL,
  password varchar(50) NOT NULL,
  trn_date datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Triggers users
--
DELIMITER $$
CREATE TRIGGER `leaderboard_init` AFTER INSERT ON `users` FOR EACH ROW INSERT INTO leaderboard (user, win, lost, ratio) VALUES (NEW.username, 0, 0, 0)
$$
DELIMITER ;

--
-- Indexes for table leaderboard
--
ALTER TABLE leaderboard
  ADD PRIMARY KEY (user),
  ADD UNIQUE KEY username (user);

--
-- Indexes for table users
--
ALTER TABLE users
  ADD PRIMARY KEY (username),
  ADD UNIQUE KEY username (username),
  ADD UNIQUE KEY email (email);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
