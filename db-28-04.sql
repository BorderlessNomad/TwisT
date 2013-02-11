# --------------------------------------------------------
# Host:                         127.0.0.1
# Server version:               5.1.41
# Server OS:                    Win32
# HeidiSQL version:             6.0.0.3603
# Date/time:                    2011-04-28 17:03:49
# --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

# Dumping database structure for twist2
CREATE DATABASE IF NOT EXISTS `twist2` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `twist2`;


# Dumping structure for table twist2.buddies
CREATE TABLE IF NOT EXISTS `buddies` (
  `buddyid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sourceid` int(10) unsigned NOT NULL,
  `destinationid` int(10) unsigned NOT NULL,
  `datecreated` datetime DEFAULT NULL,
  `accepted` int(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`buddyid`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

# Dumping data for table twist2.buddies: 9 rows
DELETE FROM `buddies`;
/*!40000 ALTER TABLE `buddies` DISABLE KEYS */;
INSERT INTO `buddies` (`buddyid`, `sourceid`, `destinationid`, `datecreated`, `accepted`) VALUES
	(21, 1, 6, '2011-04-28 12:40:06', 1),
	(3, 1, 4, '2011-04-16 16:30:18', 0),
	(4, 2, 1, '2011-04-16 16:30:49', 0),
	(22, 1, 7, '2011-04-28 12:40:44', 0),
	(19, 1, 5, '2011-04-28 12:35:16', 1);
/*!40000 ALTER TABLE `buddies` ENABLE KEYS */;


# Dumping structure for table twist2.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `categoryid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `categoryparent` int(10) unsigned NOT NULL DEFAULT '0',
  `categoryname` varchar(255) NOT NULL,
  `datecreated` datetime DEFAULT NULL,
  PRIMARY KEY (`categoryid`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

# Dumping data for table twist2.categories: 8 rows
DELETE FROM `categories`;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`categoryid`, `categoryparent`, `categoryname`, `datecreated`) VALUES
	(1, 0, 'Humans', '2011-04-07 19:15:43'),
	(2, 0, 'Animals', '2011-04-07 19:18:06'),
	(3, 0, 'Bollywood', '2011-04-07 19:20:15'),
	(4, 0, 'World\'s Largest things', '2011-04-07 19:33:15'),
	(5, 0, 'India', '2011-04-07 19:40:36'),
	(6, 0, 'Computers', '2011-04-14 09:19:48'),
	(7, 0, 'Science', '2011-04-14 09:21:28'),
	(8, 0, 'Internet', '2011-04-14 11:18:56');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;


# Dumping structure for table twist2.content
CREATE TABLE IF NOT EXISTS `content` (
  `contentid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `categoryid` int(10) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(50000) NOT NULL,
  `source` varchar(255) DEFAULT '0',
  `datecreated` datetime NOT NULL,
  `views` int(10) unsigned NOT NULL DEFAULT '0',
  `likes` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`contentid`)
) ENGINE=MyISAM AUTO_INCREMENT=65 DEFAULT CHARSET=latin1;

# Dumping data for table twist2.content: 64 rows
DELETE FROM `content`;
/*!40000 ALTER TABLE `content` DISABLE KEYS */;
INSERT INTO `content` (`contentid`, `categoryid`, `title`, `description`, `source`, `datecreated`, `views`, `likes`) VALUES
	(1, 1, 'Who Speak More?...', 'A average Women speak about 7000 words a day, The average man averages just over 2000 words a day.', 'http://www.tsiwt.com', '2011-04-07 19:17:13', 11, 3),
	(2, 2, 'Cheetah can run 76 km/s', 'A  cheetah can run 76 kilometres per hour (46 miles per hour) - that\'s really fast! The fastest human beings runs only about 30 kilometres per hour (18 miles per hour).\r\n\r\nA cheetah does not roar like a lion - it purrs like a cat (meow).', 'http://www.tsiwt.com', '2011-04-07 19:19:55', 100, 55),
	(3, 3, 'Why Dilip Kumar never married Madhubala ?', 'The reason Madhubala broke up with Dilip Kumar was B R Chopra\'s film Naya Daur. Madhubala had shot a outdoor shoot to Gwalior. The place was known for dacoits, so her father asked them to change the location. They disagreed because they wanted a hilly ter', 'http://www.tsiwt.com', '2011-04-07 19:24:07', 100, 58),
	(4, 4, 'World\'s largest Circket Ground', 'The world\'s largest cricket ground is in Chail, Himachal Pradesh. \r\nBuilt in 1893 after levelling a hilltop, this cricket pitch is 2444 meters above sea level.', 'http://www.tsiwt.com', '2011-04-07 19:34:04', 0, 0),
	(5, 5, 'Name of India', 'The official Sanskrit name for India is Bharat.\r\nINDIA has been called Bharat even in Satya yuga ( Golden Age ).', 'http://www.tsiwt.com', '2011-04-07 19:42:45', 0, 0),
	(6, 4, 'Largest Employee', 'The largest employer in the world is the Indian railway system, employing over a million people !.  ', 'http://www.tsiwt.com', '2011-04-07 19:43:42', 0, 0),
	(7, 2, 'Chocolate kills dogs.', 'Chocolate kills dogs!  True, chocolate affects a dog\'s heart and nervous system. A few pieces are enough to kill a small dog.', 'http://www.tsiwt.com', '2011-04-07 19:45:27', 1, 0),
	(8, 4, 'Largest Egg', 'The largest bird egg in the world today is that of the ostrich. Ostrich eggs are from 6 to 8 inches long. Because of their size and the thickness of their shells, they take 40 minutes to hard-boil. The average adult male ostrich, the world\'s largest livin', 'http://www.tsiwt.com', '2011-04-07 19:46:07', 0, 0),
	(9, 1, 'Monday is the favored day for suide.', 'According to suicide statistics, Monday is the favored day for self-destruction.\r\n\r\nSuicide \'most likely on Mondays\'\r\n17% of female suicides were on Monday\r\nPeople are more likely to commit suicide on a Monday, a study shows.\r\nThe Office for National Stat', 'http://www.tsiwt.com', '2011-04-07 20:13:24', 3, 0),
	(10, 2, 'Best sense of smell (fish)', 'Shark has best sense of smell. They can detect as little as 1 part blood in 100 million parts of waters.', 'http://www.tsiwt.com', '2011-04-07 20:18:33', 1, 0),
	(11, 3, 'Real Names of stars', 'Meena Kumari Mehjabeen \r\nAkshay Kumar- Rajiv hari Om Bhatia\r\nJeetendra - Ravi Kapoor\r\nRajesh Khanna - Jatin Khanna\r\nSunny Dol - Ajay Sngh Deol\r\nBobby Deol - Vijay Singh Deol\r\nAjay devgan - Vishal Devgan', 'http://www.tsiwt.com', '2011-04-07 20:24:26', 0, 0),
	(12, 5, 'Few Inventions', 'The number system was invented by India. Aryabhatta was the scientist who invented the digit zero.\r\n\r\nSanskrit is considered as the mother of all higher languages. This is because it is the most precise, and therefore suitable language for computer softwa', 'http://www.tsiwt.com', '2011-04-07 20:26:37', 0, 0),
	(13, 4, 'World\'s Tallest Tower', 'Kuala Lumpur\'s Petronas Towers hold the title of the tallest buildings in the world. Both the towers reach a total height of 1,483 feet (452 meters) measured from the ground to the tip of the masts. Is has 29 double-deck passenger elevators in each tower ', 'http://www.tsiwt.com', '2011-04-07 20:28:35', 1, 0),
	(14, 1, 'If you walk and talk with someone, eventually you will synchronize your steps with each other.', 'Interpersonal synchronization of stepping happens when people walk side-by-side. Little is known about this, but it has practical uses in therapy. In 2009, this phenomenon was the subject of a study to help impaired people in rehabilitation. Subjects were', 'http://www.tsiwt.com', '2011-04-07 20:32:00', 1, 0),
	(15, 2, 'Fastest Dog', 'The Fastest Dog is Greyhound who runs at 45 MPH. And Cheetah Reaching speeds of 70 MPH (not long though) ', 'http://www.tsiwt.com', '2011-04-07 20:35:39', 2, 1),
	(16, 3, 'A song is very small.', 'Do u know 4 weeks in Switzerland + London + New Zealand + Canada = 4 minute song in a Hindi movie.', 'http://www.tsiwt.com', '2011-04-07 20:38:06', 0, 0),
	(17, 4, 'World\'s Tallest Building: Who Holds The Title? The Petronas-Sears Controversy ', 'Officially, the World\'s Tallest Buildings are the Petronas Towers in \r\nKuala Lumpur, Malaysia (1483 feet / 452m) -- but put Petronas side by side with the former title holder, Sears Tower, and look again. The casual observer would say Sears Tower is tops,', 'http://www.tsiwt.com', '2011-04-07 20:39:00', 0, 0),
	(18, 4, 'Tallest.', 'The world\'s tallest animal is a giraffe and the world\'s known tallest man is Robert Pershing Wadlow. The giraffe is 5.49m (18 ft.), the man is 2.55m (8ft. 11.1 in.).\r\nThe world\'s tallest woman is Sandy Allen. She is 2.35m (7 ft. 7 in.).', 'http://www.tsiwt.com', '2011-04-07 20:41:57', 0, 0),
	(19, 1, 'People who laugh a lot are much healthier than those who don\'t. ', 'Laughter increases levels of a hormone called beta-endorphines (which elevates mood state) by 27% and increases human growth hormone by 87%. Human growth hormone (HGH) is used to treat patients with hormone deficiencies and has been shown to improve the i', 'http://www.tsiwt.com', '2011-04-07 20:43:18', 0, 0),
	(20, 3, 'Stars before they were stars', 'Dileep kumar: Fruit seller\r\n\r\nRajnikant: Bus Conductor\r\n\r\nSmita patil : News reader\r\n\r\nManoj kumar: Clerk\r\n\r\nAshok kumar : Lab assistant\r\n\r\nShriram lagoo :Doctor\r\n\r\nAmitabh bachchan: Executive\r\n\r\nDevika Rani: Architect\r\n\r\nPran: Photographer\'s Assistant\r\n\r', 'http://www.tsiwt.com', '2011-04-07 20:52:47', 0, 0),
	(21, 2, 'Cats that fall from higher than 7 stories get fewer injuries than those that fall from lower levels.', 'A formal study on the effects of falling from building on cats has never been done (could you imagine scientists chucking cats off of a building, in the name of science?) However, a report in the Journal of American Veterinary Medical Association assemble', 'http://www.tsiwt.com', '2011-04-07 21:02:33', 1, 0),
	(22, 5, 'pi=3.142857', 'The value of "pi" was first calculated by the Indian Mathematician Budhayana, and he explained the concept of what is known as the Pythagorean Theorem. He discovered this in the 6th century, which was long before the European mathematicians.\r\npi is a recu', 'http://www.tsiwt.com', '2011-04-07 21:07:56', 1, 0),
	(23, 3, 'Krissh - The real jadoo', 'In Krissh Hrithik Roshan is away for work for more than 2 years and how does Preeti zinta become pregnant then??? Jadoooo?...', 'http://www.tsiwt.com', '2011-04-07 21:22:21', 0, 0),
	(24, 2, 'In 1945, a chicken by the name of Mike lived 18 months without a head.', 'September 10th, 1945 finds a strapping (but tender) five and a half month old Wyandotte rooster pecking through the dust of Fruita, Colorado.\r\nWhen Olsen found Mike the next morning, sleeping with his "head" under his wing, he decided that if Mike had tha', 'http://www.tsiwt.com', '2011-04-07 21:29:25', 0, 0),
	(25, 1, 'The Average Person Has between 1,460 and 2,190 Dreams A Year.', 'Most people over the age of 10 have 4 to 6 dreams every night. Those numbers times 365 days in one year makes for between 1,460 and 2,190 dreams every year. We dream during REM periods (which is when we have Rapid Eye Movement in our sleep) which can rang', 'http://www.tsiwt.com', '2011-04-07 21:30:43', 0, 0),
	(26, 4, 'Coldest Place on Earth', 'Antarctica. During Night. And the Coldest Temperatures Recorded is Antarctica. -129 degrees F.', 'http://www.tsiwt.com', '2011-04-07 21:32:11', 0, 0),
	(27, 3, 'Pyar To Hona Hi Tha kyon ki toilet jaana hi tha.', 'In movie Pyar To Hona Hi Tha Kajol gets off the train to use the public toilet at the railway station and the train chugs off without her. Poor girl, little did she know that every train compartment has four toilets inside.', 'http://www.tsiwt.com', '2011-04-07 21:34:36', 1, 0),
	(28, 5, 'Snakes and Ladders', 'The game of snakes & ladders was created by the 13th century poet saint Gyandev. It was originally called  \'Mokshapat.\' The ladders in the game represented virtues and the snakes indicated vices. The game was played with cowrie shells and dices. Later thr', 'http://www.tsiwt.com', '2011-04-07 21:35:45', 3, 0),
	(29, 3, 'Baghban Really teaches a lot.', 'Amitabh Bachchan and Hema Malini are separated right after Holi remember Amitabh singing Holi khele Raghubeera?). They are said to be\r\nseparated for six months, ie from March to September. Within that six-month period, they celebrate Valentineâ€™s Day, wh', 'http://www.tsiwt.com', '2011-04-07 21:36:41', 0, 0),
	(30, 4, 'Largest Frog', 'The Largest Frog is African Goliath Frog is about 11 inches and about the size of a rabbit.', 'http://www.tsiwt.com', '2011-04-07 21:39:07', 0, 0),
	(31, 2, 'Fastest Growing Plant', 'Fastest Growing Plant is Bamboo. It can grow at a rate of 3 feet per day. And Fastest Growing Aquatic Plant Caulerpa taxifolia, also known as killer weed grows at 3 inches per day. ', 'http://www.tsiwt.com', '2011-04-07 21:40:51', 0, 0),
	(32, 3, 'Lagaan The Reel Cricketers', 'Lagaan was shot in the late 19th century. At the time, an over in cricket used to consist of 8 balls. But in this movie, an over has 6 balls.\r\nMaybe modern cricket learnt from the movie.', 'http://www.tsiwt.com', '2011-04-07 21:44:21', 0, 0),
	(33, 4, 'Widest Road', '160 cars can drive side by side on the Monumental Axis in Brazil, the world\'s widest road.', 'http://www.tsiwt.com', '2011-04-07 22:08:35', 0, 0),
	(34, 1, 'Hard Stones', 'Human teeth are almost as hard as rocks.\r\nHuman being\'s bones are stronger than concrete. ', 'http://www.tsiwt.com', '2011-04-07 22:13:01', 1, 0),
	(35, 2, 'Horse Legs shows how a person died.', 'If a statue in the park of a person on a horse has both front legs in the air, the person died in battle.\r\nIf the horse has one front leg in the air, the person died as a result of wounds received in battle.\r\nIf the horse has all four legs on the ground, ', 'http://www.tsiwt.com', '2011-04-07 22:14:21', 0, 0),
	(36, 2, 'Music helps for milk.', 'Most cows give more milk when they listen to music. And even Non-dairy creamer is flammable.', 'http://www.tsiwt.com', '2011-04-07 22:17:16', 0, 0),
	(37, 1, 'Bones', 'You\'re born with 300 bones, but when you get to be an adult, you only have 206.\r\nYour ribs move about 5 million times a year, everytime you breathe. Your heart beats over 100,000 times a day. Your right lung takes in more air than your left one does. ', 'http://www.tsiwt.com', '2011-04-07 22:19:06', 0, 0),
	(38, 7, 'Diamonds can only cut Diamonds', 'Diamonds are the hardest substance known to man, and the only thing capable of cutting a diamond is another diamond. Made of pure carbon, diamonds form in the earth for thousands of years, making each diamond unique.\r\n\r\nThe first diamond was discovered 4,', 'http://www.tsiwt.com', '2011-04-14 09:34:29', 6, 3),
	(39, 6, '1st Computer', 'Bill Gates\' house was designed using a Macintosh computer.i.e. Mac!', 'http://www.tsiwt.com', '2011-04-14 10:25:37', 0, 0),
	(40, 1, 'A women with 69 Childrens', 'The most children born to one woman was 69, she was a peasant who lived a 40 year life, in which she had 16 twins, 7 triplets, and 4 quadruplets.', 'http://www.tsiwt.com', '2011-04-14 10:26:12', 1, 0),
	(41, 6, 'Disk Cleanup', 'This program used for cleaning harddisk to offer space\r\nClick : start\r\nThen : run\r\ntype : cleanmgr', 'http://www.tsiwt.com', '2011-04-14 10:26:49', 0, 0),
	(42, 7, 'The lightning bolt is 5 times hotter than the sun.', 'Did you know that a bolt of lightning can reach a temperature of 50,000 degrees? Thatâ€™s five times hotter than the surface of the sun, which is about 10,000 degrees.', 'http://www.tsiwt.com', '2011-04-14 10:51:40', 0, 0),
	(43, 6, 'How to make Exe files.', 'Express\r\nThis Program is for converting your files to EXCUTABLE files\r\nClick : start\r\nThen : run\r\ntype : iexpress', 'http://www.tsiwt.com', '2011-04-14 10:52:22', 0, 0),
	(44, 7, 'Lightning adds to ozone level.', 'Each time lightning strikes, some Ozone gas is produced, thus strengthening the Ozone Layer in the Earth\'s atmosphere.', 'http://www.tsiwt.com', '2011-04-14 10:59:41', 1, 0),
	(45, 6, 'Reparing Windows.', 'Dr Watson\r\nThis program Is for repairing problems in Windows \r\nClick : start\r\nThen : run\r\ntype : drwtsn32', 'http://www.tsiwt.com', '2011-04-14 11:00:07', 0, 0),
	(46, 7, 'Oxygen is the most abundant element in the Earth\'s crust, waters, and atmosphere (about 49.5%) ', 'The chemical composition of the earth is quite a bit different from that of the universe. The most abundant element in the earth\'s crust is oxygen, making up 46.6% of the earth\'s mass. Silicon is the second most abundant element (27.7%), followed by alumi', 'http://www.tsiwt.com', '2011-04-14 11:04:35', 1, 0),
	(47, 6, 'Whatâ€™s with the word â€œCONâ€? ', '1. Try to create a folder anywhere you like (i.e. desktop, my documents).\r\n2. Rename the folder with CON and see what will happen.\r\n3. Try to rename other files (i.e. images, documents) with CON. Still, it doesnâ€™t change right?...\r\n\r\nTry it to believe i', 'http://www.tsiwt.com', '2011-04-14 11:11:41', 1, 0),
	(48, 6, 'Test the strength of your anti-virus', 'Do you want to know if your anti-virus is really protecting your PC? Open your notepad and copy-paste this code â€œX50!P%@AP[4\\PZX54(P^)7CC)7}EICAR-STANDARD-ANTIVIRUS-TEST-FILE!$H+H*â€ without â€œâ€.\r\n\r\nSave the file as eicar.com. If your anti-virus is ', 'http://www.tsiwt.com', '2011-04-14 11:15:41', 0, 0),
	(49, 7, 'Plastic can be decomposed.', 'It is estimated that a plastic container can resist decomposition for as long as 50,000 years.\r\nIt can take between 400-1000 years for a plastic bottle to decompose, though it partially depends on the type of plastic and the conditions in which it is kept', 'http://www.tsiwt.com', '2011-04-14 11:18:18', 0, 0),
	(50, 8, 'Flying Images', 'Go to Google Images.\r\nSearch for anything you want (i.e. dog, baby).\r\nNow, copy and paste the code below in your address bar and hit Enter.\r\n\r\njavascript:R=0; x1=.1; y1=.05; x2=.25; y2=.24; x3=1.6; y3=.24; x4=300; y4=200; x5=300; y5=200; DI=document.getEl', 'http://www.tsiwt.com', '2011-04-14 11:19:29', 0, 0),
	(51, 8, 'Only 16.6% of world population surf the internet.', '35.6% of internet users are Asian.\r\n\r\nIn Afirca, 3 out of 100 surf the Internet.\r\nIn Asia, 10 out of 100 surf the Internet.\r\nIn Europe, 38 out of 100 surf the Internet.\r\nIn North America, 70 out of 100 surf the Internet.\r\nIn Latin America, 16 out of 100 s', 'http://www.tsiwt.com', '2011-04-14 11:33:12', 0, 0),
	(52, 1, 'Human\'s Length = Human\'s Breadth', 'If you fully stretch your arms out, the fingertip to fingertip length is almost exactly your body height.', 'http://www.tsiwt.com', '2011-04-14 11:39:46', 2, 0),
	(53, 7, 'Multiplication and succession: ', '  1 Ã— 8 + 1 = 9\r\n 12 Ã— 8 + 2 = 98\r\n123 Ã— 8 + 3 = 987\r\n\r\nand so on...', 'http://www.tsiwt.com', '2011-04-14 11:42:48', 0, 0),
	(54, 8, 'TOTAL NUMBER OF HOUSEHOLDS ONLINE', 'In 1998\r\nâ€“ 19.1 million online in US\r\nâ€“ 20 million users (â€netizensâ€) worldwide say Internet is indispensable\r\nâ€“ over 1.2 million users in Russia\r\n\r\nIn 2008\r\nâ€“ 215 million online in the U.S.	(71.4% of U.S. population)\r\nâ€“ 1,464 million online', 'http://www.tsiwt.com', '2011-04-14 11:49:34', 0, 0),
	(55, 6, 'Silicon Chip are very small.', 'A chip of silicon a quarter-inch square has the capacity of the original 1949 ENIAC computer, which occupied a city block.', 'http://www.tsiwt.com', '2011-04-14 13:01:33', 0, 0),
	(56, 5, 'Science & Technology in India', 'India is one of the leading nations in the world in terms of science and technology. India has the second largest pool of scientists and engineers in the world. In terms of technological advancements and scientific achievements India is second to none. In', 'http://www.tsiwt.com', '2011-04-14 13:04:13', 1, 1),
	(57, 7, 'Sound travels about 4 times faster in water than in air.', 'Sound travells faster in less dense medium, and air has a density of 1.3g/cm3 while water has a density of 1.0g/cm3, therefore sound travells faster under water because being less dense increases the distance travelled by the sound.', 'http://www.tsiwt.com', '2011-04-14 13:16:03', 0, 0),
	(58, 4, 'Hottest Temperature', 'Talking about the hot stuff - The highest temperature produced in a laboratory was 920,000,000 F (511,000,000 C) at the Tokamak Fusion Test Reactor in Princeton, NJ, USA.', 'http://www.tsiwt.com', '2011-04-14 13:18:51', 0, 0),
	(59, 7, 'A rainbow form a complete circle.', 'You can see this phenomenon if you are at a sufficiently high altitude. It is most easily observed from airplanes, in fact I have seen a circular rainbow once out the window of a commercial airliner. You might also be able to see it from a mountain if you', 'http://www.tsiwt.com', '2011-04-14 13:20:19', 0, 0),
	(60, 7, 'Quick Silver is Mercury.', 'Quick silver is not silver, but it is another name of mercury. It is so heavy that piece of iron floats on its surface.', 'http://www.tsiwt.com', '2011-04-14 13:21:26', 0, 0),
	(61, 4, 'Longest English Word.', 'The longest regularly formed English word is "Praetertranssubstantiationalistically" which contains 37 letters.', 'http://www.tsiwt.com', '2011-04-14 13:22:18', 0, 0),
	(62, 7, 'Nitrous oxide can make you laugh.', 'Nitrous oxide can make you laugh. That is why it is called laughing gas.\r\nNitrous oxide (N2O) is simply a gas which you can breathe in. It has no color, smell, and doesnâ€™t irritate. It was discovered in 1772. Humphrey Davy (1778-1829).', 'http://www.tsiwt.com', '2011-04-14 13:26:10', 1, 0),
	(63, 6, 'Keyboard Shortcuts', 'Shift + F10 = right-clicks.\r\nWin + L (XP Only) = Locks keyboard. Similar to Lock Workstation.\r\nWin + Control + F = Open Find dialog.\r\nWin + U: Open = Utility Manager.\r\nWin + F1: Open = Windows help.\r\nWin + Pause: Open = System Properties dialog.\r\n', 'http://www.tsiwt.com', '2011-04-14 13:38:09', 0, 0),
	(64, 8, 'Top 5 countries for internet users.', 'Top 5 countries for internet users are\r\n1) USA\r\n2) China\r\n3) Japan\r\n4) Germany\r\n5) India - \r\nSource Neilson /netratings', 'http://www.tsiwt.com', '2011-04-14 13:45:35', 1, 1);
/*!40000 ALTER TABLE `content` ENABLE KEYS */;


# Dumping structure for table twist2.interests
CREATE TABLE IF NOT EXISTS `interests` (
  `interestsid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(10) unsigned NOT NULL,
  `categoryid` int(10) unsigned NOT NULL,
  `datecreated` datetime DEFAULT NULL,
  PRIMARY KEY (`interestsid`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

# Dumping data for table twist2.interests: 30 rows
DELETE FROM `interests`;
/*!40000 ALTER TABLE `interests` DISABLE KEYS */;
INSERT INTO `interests` (`interestsid`, `userid`, `categoryid`, `datecreated`) VALUES
	(58, 1, 2, '2011-04-28 17:02:41'),
	(9, 2, 4, '2011-04-18 17:23:11'),
	(56, 1, 4, '2011-04-28 17:02:16'),
	(8, 2, 1, '2011-04-18 17:23:11'),
	(10, 2, 6, '2011-04-18 17:23:11'),
	(11, 2, 7, '2011-04-18 17:23:11'),
	(12, 2, 8, '2011-04-18 17:23:11'),
	(59, 1, 7, '2011-04-28 17:02:42'),
	(21, 5, 1, '2011-04-24 09:31:09'),
	(22, 5, 2, '2011-04-24 09:31:09'),
	(23, 5, 3, '2011-04-24 09:31:09'),
	(24, 5, 4, '2011-04-24 09:31:09'),
	(25, 5, 5, '2011-04-24 09:31:09'),
	(26, 5, 6, '2011-04-24 09:31:09'),
	(28, 5, 8, '2011-04-24 09:31:09'),
	(34, 22, 6, '2011-04-25 18:03:59'),
	(35, 22, 7, '2011-04-25 18:03:59'),
	(36, 22, 8, '2011-04-25 18:03:59'),
	(57, 1, 3, '2011-04-28 17:02:39');
/*!40000 ALTER TABLE `interests` ENABLE KEYS */;


# Dumping structure for table twist2.profile
CREATE TABLE IF NOT EXISTS `profile` (
  `profileid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(10) unsigned NOT NULL,
  `lastupdate` datetime NOT NULL,
  `photo` varchar(255) DEFAULT 'nophoto.png',
  `gender` int(1) unsigned NOT NULL,
  `birthdate` date NOT NULL,
  `website` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `skype` varchar(255) DEFAULT NULL,
  `secemail` varchar(255) DEFAULT NULL,
  `about` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `languages` varchar(255) DEFAULT NULL,
  `school` varchar(255) DEFAULT NULL,
  `highschool` varchar(255) DEFAULT NULL,
  `college` varchar(255) DEFAULT NULL,
  `university` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `religion` varchar(255) DEFAULT NULL,
  `music` varchar(255) DEFAULT NULL,
  `books` varchar(255) DEFAULT NULL,
  `movies` varchar(255) DEFAULT NULL,
  `television` varchar(255) DEFAULT NULL,
  `sports` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`profileid`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

# Dumping data for table twist2.profile: 11 rows
DELETE FROM `profile`;
/*!40000 ALTER TABLE `profile` DISABLE KEYS */;
INSERT INTO `profile` (`profileid`, `userid`, `lastupdate`, `photo`, `gender`, `birthdate`, `website`, `firstname`, `lastname`, `twitter`, `facebook`, `skype`, `secemail`, `about`, `city`, `country`, `languages`, `school`, `highschool`, `college`, `university`, `company`, `religion`, `music`, `books`, `movies`, `television`, `sports`) VALUES
	(1, 1, '2011-04-18 23:54:05', '1303151000.jpg', 1, '1989-12-18', 'http://www.eantrix.com', 'Mayur', 'Ahir', 'ahirmayur', 'ahirmayur', 'ahirmayur', 'ahirmayur@yahoo.com', 'I am Mayur', 'Mumbai', 'India', 'English, Gujarati, Hindi', 'J.H.Poddar High School', 'M.V.L.U. College of Science', 'K.J.Somaiya Institute of Engineering and Information Technology', 'Mumbai University', 'e|antrix', 'Hindu', 'Indian Classical', 'Da Vinci Code', 'MIB', 'Prison Break', 'Cricket'),
	(2, 2, '2011-04-16 16:46:55', '1303134203.jpg', 2, '2003-01-01', NULL, 'Test', 'User', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(3, 4, '2011-04-16 16:47:45', '1303120450.png', 2, '1906-02-28', NULL, 'Test', 'User', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(4, 5, '2011-04-18 19:17:48', '1303134469.jpg', 1, '1989-11-11', NULL, 'Harsh', 'Gadhia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(5, 6, '0000-00-00 00:00:00', 'nophoto.png', 1, '1989-08-22', NULL, 'Alpesh', 'Ahir', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(8, 7, '2011-04-18 15:45:34', '1303134656.jpg', 1, '2009-05-01', '', 'Jatin', 'Patel', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(12, 22, '2011-04-25 18:03:47', 'nophoto.png', 1, '2010-02-02', '', 'Abra', 'kaDabra', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `profile` ENABLE KEYS */;


# Dumping structure for table twist2.suggestions
CREATE TABLE IF NOT EXISTS `suggestions` (
  `suggestionid` int(10) NOT NULL AUTO_INCREMENT,
  `sourceid` int(10) NOT NULL,
  `destinationid` int(10) NOT NULL,
  `mutualcategories` int(10) NOT NULL,
  `mutualcontentsliked` int(10) NOT NULL,
  `connected` int(10) NOT NULL,
  PRIMARY KEY (`suggestionid`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

# Dumping data for table twist2.suggestions: ~15 rows (approximately)
DELETE FROM `suggestions`;
/*!40000 ALTER TABLE `suggestions` DISABLE KEYS */;
INSERT INTO `suggestions` (`suggestionid`, `sourceid`, `destinationid`, `mutualcategories`, `mutualcontentsliked`, `connected`) VALUES
	(1, 2, 1, 2, 0, 0),
	(2, 4, 1, 0, 0, 0),
	(3, 4, 2, 0, 0, 0),
	(11, 5, 1, 3, 0, 0),
	(12, 5, 2, 0, 0, 0),
	(13, 5, 4, 0, 0, 0),
	(16, 6, 1, 0, 0, 0),
	(17, 6, 2, 0, 0, 0),
	(18, 6, 4, 0, 0, 0),
	(19, 6, 5, 0, 0, 0),
	(21, 7, 1, 0, 0, 0),
	(22, 7, 2, 0, 0, 0),
	(23, 7, 4, 0, 0, 0),
	(24, 7, 5, 0, 0, 0),
	(25, 7, 6, 0, 0, 0);
/*!40000 ALTER TABLE `suggestions` ENABLE KEYS */;


# Dumping structure for table twist2.updates
CREATE TABLE IF NOT EXISTS `updates` (
  `updateid` int(10) NOT NULL AUTO_INCREMENT,
  `userid` int(10) NOT NULL,
  `update1` text NOT NULL,
  `time1` datetime NOT NULL,
  `update2` text NOT NULL,
  `time2` datetime NOT NULL,
  `update3` text NOT NULL,
  `time3` datetime NOT NULL,
  `update4` text NOT NULL,
  `time4` datetime NOT NULL,
  `update5` text NOT NULL,
  `time5` datetime NOT NULL,
  `update6` text NOT NULL,
  `time6` datetime NOT NULL,
  `update7` text NOT NULL,
  `time7` datetime NOT NULL,
  `update8` text NOT NULL,
  `time8` datetime NOT NULL,
  `update9` text NOT NULL,
  `time9` datetime NOT NULL,
  `update10` text NOT NULL,
  `time10` datetime NOT NULL,
  `update11` text NOT NULL,
  `time11` datetime NOT NULL,
  `update12` text NOT NULL,
  `time12` datetime NOT NULL,
  PRIMARY KEY (`updateid`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

# Dumping data for table twist2.updates: ~6 rows (approximately)
DELETE FROM `updates`;
/*!40000 ALTER TABLE `updates` DISABLE KEYS */;
INSERT INTO `updates` (`updateid`, `userid`, `update1`, `time1`, `update2`, `time2`, `update3`, `time3`, `update4`, `time4`, `update5`, `time5`, `update6`, `time6`, `update7`, `time7`, `update8`, `time8`, `update9`, `time9`, `update10`, `time10`, `update11`, `time11`, `update12`, `time12`) VALUES
	(4, 4, '', '2011-04-17 19:03:56', '', '2011-04-17 19:03:56', '', '2011-04-17 19:03:56', '', '2011-04-17 19:03:56', '', '2011-04-17 19:03:56', '', '2011-04-17 19:03:56', '', '2011-04-17 19:03:56', '', '2011-04-17 19:03:56', '', '2011-04-17 19:03:56', '', '2011-04-17 19:03:56', '', '2011-04-17 19:03:56', '', '2011-04-17 19:03:56'),
	(5, 7, '<a href="#" title="Content">Mayur Ahir</a> has liked article on <a href="">Quick Silver is Mercury.</a>', '2011-04-18 19:43:31', '<a href="#" title="Content">Mayur Ahir</a> has Read article on <a href="">Quick Silver is Mercury.</a>', '2011-04-18 19:43:31', '<a href="#" title="Content">Mayur Ahir</a> has liked article on <a href="">Flying Images</a>', '2011-04-18 19:43:31', '<a href="#" title="Content">Mayur Ahir</a> has Read article on <a href="">Flying Images</a>', '2011-04-18 19:43:31', '<a href="#" title="Content">Mayur Ahir</a> has liked article on <a href="">A women with 69 Childrens</a>', '2011-04-18 19:43:31', '<a href="#" title="Content">Mayur Ahir</a> has Read article on <a href="">A women with 69 Childrens</a>', '2011-04-18 19:43:31', '<a href="#" title="Content">Mayur Ahir</a> has liked article on <a href="">Largest Frog</a>', '2011-04-18 19:43:31', '<a href="#" title="Content">Mayur Ahir</a> has Read article on <a href="">Largest Frog</a>', '2011-04-18 19:43:31', '<a href="#" title="Content">Mayur Ahir</a> has liked article on <a href="">Stars before they were stars</a>', '2011-04-18 19:43:31', '<a href="#" title="Content">Mayur Ahir</a> has Read article on <a href="">Stars before they were stars</a>', '2011-04-18 19:43:31', '<a href="#" title="Content">Mayur Ahir</a> has liked article on <a href="">Best sense of smell (fish)</a>', '2011-04-18 19:43:31', '<a href="#" title="Content">Mayur Ahir</a> has Read article on <a href="">Best sense of smell (fish)</a>', '2011-04-18 19:43:31'),
	(6, 0, '', '2011-04-18 17:54:34', '', '2011-04-18 17:54:34', '', '2011-04-18 17:54:34', '', '2011-04-18 17:54:34', '', '2011-04-18 17:54:34', '', '2011-04-18 17:54:34', '', '2011-04-18 17:54:34', '', '2011-04-18 17:54:34', '', '2011-04-18 17:54:34', '', '2011-04-18 17:54:34', '', '2011-04-18 17:54:34', '', '2011-04-18 17:54:34'),
	(7, 1, '<a href=#>ishan bhatt</a> is now Friend with <a href="">Mayur Ahir</a>', '2011-04-18 19:07:57', '', '2011-04-18 18:10:15', '', '2011-04-18 18:10:15', '', '2011-04-18 18:10:15', '', '2011-04-18 18:10:15', '', '2011-04-18 18:10:15', '', '2011-04-18 18:10:15', '', '2011-04-18 18:10:15', '', '2011-04-18 18:10:15', '', '2011-04-18 18:10:15', '', '2011-04-18 18:10:15', '', '2011-04-18 18:10:15');
/*!40000 ALTER TABLE `updates` ENABLE KEYS */;


# Dumping structure for table twist2.users
CREATE TABLE IF NOT EXISTS `users` (
  `userid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `datecreated` datetime NOT NULL,
  `online` int(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`userid`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

# Dumping data for table twist2.users: 7 rows
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`userid`, `email`, `password`, `salt`, `firstname`, `lastname`, `datecreated`, `online`) VALUES
	(1, 'ahirmayur@gmail.com', 'ea64c0a53ab47e0a0a129a67a42f4acb62224f0390bc46cfff312646073897180b38ee61f70883d1de38788317984890cc339ea058c028b0e850700883dda494', '278bab7d0b48a868cfd084763b0a2437eda5f4a0d39d136ccfde7f79bd9adcd0d06b82ac78dd3b1f0d2ad33d7faa5fa2a5fcfc5cffbc632e3e9457b6a4a43cee', 'Mayur', 'Ahir', '2011-04-10 11:06:50', 1),
	(2, 'harsh@twist.com', 'bb6f80a85060c37746221a4a5502956fa8ca8810ff12d1870e33a6aea49bb9fa40e8a181b23b3ec416f8443241aafd824f2a27a7e344e3ba68a29615e145ad42', 'bf9c2e8d87d7c67414f538ec070ce0e8e0fce24cc54315c76ad271a9b82f396773adaea204c4674a48e158534c30eb778cc06c1e7c7db96dbcea120e2bdd1e04', 'Harsh', 'Gadhia', '2011-04-12 11:30:26', 1),
	(4, 'alpeshahir31@yahoo.in', 'ce3370fc0116ff47a9ff5a9c493b04fccf6f68a6ab38e705134c1ad812bae49458cd8584b4cc0ee51d41c59a972d8de1924ab4cb61619811dac664de6513ea98', '22f3d6b9e10bf0bc80f5b66feed1871428e1900345bb921c438f485eff15c67963ba140be379d45d8fe9d706c26630cfc52a4a609746881e4b9c48f44e375151', 'Alpesh', 'Ahir', '2011-04-13 00:28:10', 1),
	(5, 'jatin@twist.com', '7511ce8946bdf7e409340b41cb67394426ddecc7d5aa3dbc6658015d20b72179d2569dd92e319a3e4af602f6d5b202ba617e2beefae9a6cb15603f016dbbbb8c', '0c0e9d4eaf29c9bd11ed26ff2d16f132fcaf740b7e46c81fde5be512898a6aa9fb43301eddaee90b92b241e3cba77de3bd1df3b062e8abf610097ab6b4c2d1dc', 'Jatin', 'Patel', '2011-04-18 15:39:34', 1),
	(6, 'jigarmehta@gmail.com', '1de33ccef4ff8441722257fa6fd9948e6bed67baaffe6a6aa894eacdda519ccdbb1e159ce0a92df82d524443fec92bedb25b95e4cc8432a3d39ed62ecce443ef', '89d6eb8fc72754da09337c3da787e2cabd10fcdff7f0217c68efcbb68c95c8ad6aac1dfc616e070acdbfa988e1593565779261c0aa25f478256f00f63e442e9e', 'Jigar', 'Mehta', '2011-04-18 23:43:46', 1),
	(7, 'jagsahir@gmail.com', 'fce4c64965fdce2a96726c754b1d092d8574e57a762bc129dd8c9a55bbf1683c43f5954d775f9ab0e88c3da4b93c3a634f5f17f3ed2fd2e6a9f22e9f9c2b514a', '74ca7fadfb0e595c1f985aaedba73c4f6cbcb3fff69ab385079f2261c5dc9cabbb34e0874510b739a0c1616f0a125b522e2188759fc0febb8c02355282940831', 'Jagruti', 'Ahir', '2011-04-18 15:32:32', 0),
	(22, 'test2@test2.com', 'a62810f4d4e542346210d28697bd3cc20e2b4ac6be6ce853a24e4c10ceb673797319833c29b469aaa95bcb273629bc4ca776cb8f918214b35b43728db28076e9', '3209fb9dffae0a42523adcc333c336ed313b07d5aace065d266ce76fc3788ab75bdce673989f729ad27421c1705d85e96756a73bcf129fba6a9cfad1c0831916', 'Abra', 'kaDabra', '2011-04-25 18:03:47', 0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


# Dumping structure for table twist2.visited
CREATE TABLE IF NOT EXISTS `visited` (
  `visitid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(10) unsigned NOT NULL,
  `contentid` int(10) unsigned NOT NULL,
  `timevisited` datetime NOT NULL,
  `likes` int(1) unsigned NOT NULL,
  PRIMARY KEY (`visitid`)
) ENGINE=MyISAM AUTO_INCREMENT=115 DEFAULT CHARSET=latin1;

# Dumping data for table twist2.visited: 25 rows
DELETE FROM `visited`;
/*!40000 ALTER TABLE `visited` DISABLE KEYS */;
INSERT INTO `visited` (`visitid`, `userid`, `contentid`, `timevisited`, `likes`) VALUES
	(112, 1, 56, '2011-04-28 14:33:10', 1),
	(88, 1, 15, '2011-04-24 11:53:49', 0),
	(89, 1, 28, '2011-04-24 19:45:02', 0),
	(90, 1, 35, '2011-04-24 12:05:54', 0),
	(91, 1, 46, '2011-04-24 12:52:35', 0),
	(92, 1, 7, '2011-04-24 12:58:36', 0),
	(93, 1, 25, '2011-04-24 12:35:14', 0),
	(94, 1, 1, '2011-04-25 20:42:38', 0),
	(95, 1, 34, '2011-04-25 20:43:07', 0),
	(96, 1, 38, '2011-04-24 12:52:33', 0),
	(97, 1, 57, '2011-04-24 12:40:23', 0),
	(98, 1, 9, '2011-04-24 12:45:24', 0),
	(99, 1, 27, '2011-04-24 12:58:44', 0),
	(100, 1, 44, '2011-04-24 12:58:49', 0),
	(101, 1, 47, '2011-04-24 17:43:36', 0),
	(102, 1, 22, '2011-04-24 19:44:44', 0),
	(103, 5, 28, '2011-04-24 19:51:15', 0),
	(104, 4, 13, '2011-04-24 19:51:20', 0),
	(113, 1, 56, '2011-04-28 14:33:10', 0),
	(106, 1, 52, '2011-04-25 18:14:20', 0),
	(107, 1, 40, '2011-04-25 20:38:46', 0),
	(108, 2, 15, '2011-04-25 20:39:01', 0),
	(109, 2, 21, '2011-04-25 20:41:58', 0),
	(110, 1, 14, '2011-04-25 20:42:51', 0),
	(111, 2, 10, '2011-04-25 20:43:01', 0),
	(114, 1, 62, '2011-04-28 16:34:11', 0);
/*!40000 ALTER TABLE `visited` ENABLE KEYS */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
