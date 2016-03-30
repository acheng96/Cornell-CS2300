-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2016 at 03:45 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cs2300-hw3`
--

-- --------------------------------------------------------

--
-- Table structure for table `adventure`
--

CREATE TABLE IF NOT EXISTS `adventure` (
  `label` int(11) NOT NULL,
  `story-line` varchar(255) DEFAULT NULL,
  `choice1-plot` varchar(255) DEFAULT NULL,
  `choice1-button` varchar(255) DEFAULT NULL,
  `choice2-plot` varchar(255) DEFAULT NULL,
  `choice2-button` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `location-label` varchar(255) DEFAULT NULL,
  `choice1-result` int(11) NOT NULL,
  `choice2-result` int(11) NOT NULL,
  PRIMARY KEY (`label`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adventure`
--

INSERT INTO `adventure` (`label`, `story-line`, `choice1-plot`, `choice1-button`, `choice2-plot`, `choice2-button`, `location`, `location-label`, `choice1-result`, `choice2-result`) VALUES
(0, 'It''s your first day at Hogwarts! It''s almost time for the sorting; are you ready?', 'You''re been waiting for this your entire life. You wonder what house you''ll be placed in?', 'Enter Great Hall', 'You realize that you''re a filthy-mudblood and you don''t want to go to Hogwarts anyway. It was all a dream! Magic isn''t real for a muggle like you!', 'Ditch em', '56.8762977,-5.4343785', 'Approximate location of Hogwarts', 1, 6),
(1, 'Oh shoot, you''re the first one in the line, and you''re super nervous, but you want to get this over with. The Hat calls out to you. You step forward.', 'You slap the hat off its stool. You''ve always wanted to do that.', 'Punch the Sorting Hat', 'You put the hat on, and close your eyes.', 'Put the Hat on', '56.8762977,-5.4343785', 'Google Maps doesn''t display Hogwarts. How disappointing.', 2, 3),
(2, 'You push through the students, running as fast from Hogwarts as you can.', 'A professor catches you, and sends you back home. The End.', 'START OVER', 'You grab a random jug, which turns out to be a PortKey, and you somehow end up 3 miles from home. It''s like they KNEW you were gonna leave. The End.', 'START OVER', '42.444709, -76.483856', 'Cornell University', 0, 0),
(3, 'The hat deliberates. You start thinking about what you want.', 'You''re placed in Slytherin! ', 'Accept Slytherin', 'You have long admired the great men and women of Gryffyndor, so that''s what the hat gives you.', 'Accept Gryffondor', '56.8762977,-5.4343785', 'Same map.', 4, 5),
(4, 'You grow up to serve He-Who-Must-Not-Be-Named the Second.', 'You die one day because Voldy got bored of you. The End.', 'START OVER', 'You are the best underdog with ambitions. One day, you overtake He-Who-Must-Not-Be-Named and become the next Dark Lord! The End.', 'START OVER', '51.5287718,-0.2416802', 'London. You did it in London.', 0, 0),
(5, 'You work really hard and excel in your studies.', 'You become an Auror and fight new Death Eaters. The End.', 'START OVER', 'Your name got put in the Triward Tournament, and you die because a dragon eats you. The End.', 'START OVER', '51.5287718,-0.2416802', 'London, but underground.', 0, 0),
(6, 'As you walk tearfully away towards what you think is the exit, you notice a glowing globlet of fire next to the library. You''re curious, and inch closer.', 'You have this weird urge to write a name on a piece of paper and put it into the goblet.', 'Put a name into the goblet.', 'The goblet just spit out something that looks like burning paper.', 'Try to catch the paper.', '42.447663,-76.484898', 'The Hogwarts Library ;)', 6, 7),
(7, 'Pieces of paper are hovering over the edge of the goblet. If you don''t catch one soon, it''ll fall back in.', 'You''re had a long day, you''re curious.', 'Catch and open a piece of paper.', 'You''re done with this madness. You go back to the Great Hall and put on the Sorting Hat.', 'Get Sorted.', '42.4449594,-76.4857402', 'Duffield is the best place to put a goblet of fire, after all.', 7, 3);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
