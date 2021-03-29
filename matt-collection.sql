# ************************************************************
# Sequel Pro SQL dump
# Version 5446
#
# https://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.33)
# Database: matt-collection
# Generation Time: 2021-03-29 10:54:42 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table games
# ------------------------------------------------------------

DROP TABLE IF EXISTS `games`;

CREATE TABLE `games` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `bgg-id` int(11) unsigned NOT NULL,
  `name` varchar(80) NOT NULL DEFAULT '',
  `description` text,
  `year-published` year(4) DEFAULT NULL,
  `player-count-min` int(4) NOT NULL,
  `player-count-max` int(4) NOT NULL,
  `play-time-min` int(4) NOT NULL,
  `play-time-max` int(4) NOT NULL,
  `rating` float(3,1) NOT NULL,
  `complexity` float(3,2) NOT NULL,
  `image-url` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `games` WRITE;
/*!40000 ALTER TABLE `games` DISABLE KEYS */;

INSERT INTO `games` (`id`, `bgg-id`, `name`, `description`, `year-published`, `player-count-min`, `player-count-max`, `play-time-min`, `play-time-max`, `rating`, `complexity`, `image-url`)
VALUES
	(1,127023,'Kemet','In Kemet, players each deploy the troops of an Egyptian tribe and use the mystical powers of the gods of ancient Egypt ? along with their powerful armies ? to score points in glorious battles or through invasion of rich territories. A game is typically played to 8 or 10 victory points, which may be accrued through winning attacks, controlling temples, controlling fully-developed pyramids, sacrificing to the gods, and wielding particular magical powers.\n\nThe conquest for the land of Kemet takes place over two phases: Day and Night. During the day, choose an action amongst the nine possible choices provided by your player mat and perform it immediately. Once every player has taken five actions, night falls, with players gathering Prayer Points from their temples, drawing Divine Intervention cards, and determining the turn order before the start of the new day.\n\nAs the game progresses, they can use Prayer Points to acquire power tiles. Some of these enroll magical creatures and have them join their troops. In addition to intimidating enemies, these creatures provide special powers!\n\nDetailed miniature components represent the combat units and the supernatural creatures that are summoned to enhance them. Combat is resolved through cards chosen from a diminishing six-card hand and enhanced by bonuses.','2012',2,5,90,120,7.7,3.00,'https://cf.geekdo-images.com/RmZjhy7_6REp8IaXh9Zqwg__original/img/kRFfkVnQRsBDcbO46TKS6PcT6aE=/0x0/filters:format(jpeg)/pic3979527.jpg'),
	(2,244521,'The Quacks of Quedlinburg','In The Quacks of Quedlinburg, players are charlatans ? or quack doctors ? each making their own secret brew by adding ingredients one at a time. Take care with what you add, though, for a pinch too much of this or that will spoil the whole mixture!\n\nEach player has their own bag of ingredient chips. During each round, they simultaneously draw chips from their bags and add them to their pots. The higher the face value of the drawn chip, the further it is placed in the pot\'s swirling pattern, increasing how much the potion will be worth. Push your luck as far as you can, but if you add too many cherry bombs, your pot will explode!\n\nAt the end of each round, players gain victory points and coins to spend on new ingredients, depending on how well they managed to fill up their pots. But players whose pots have exploded must choose points or coins ? not both! The player with the most victory points at the end of nine rounds wins the game.','2018',2,4,45,45,7.8,1.94,'https://cf.geekdo-images.com/tdnjJI31M1S12L36kw8Yyg__original/img/YTBnULOhyHnCShzYMwikuOFbVO0=/0x0/filters:format(jpeg)/pic4474567.jpg'),
	(3,36218,'Dominion','\"You are a monarch, like your parents before you, a ruler of a small pleasant kingdom of rivers and evergreens. Unlike your parents, however, you have hopes and dreams! You want a bigger and more pleasant kingdom, with more rivers and a wider variety of trees. You want a Dominion! In all directions lie fiefs, freeholds, and feodums. All are small bits of land, controlled by petty lords and verging on anarchy. You will bring civilization to these people, uniting them under your banner.\n\nBut wait! It must be something in the air; several other monarchs have had the exact same idea. You must race to get as much of the unclaimed land as possible, fending them off along the way. To do this you will hire minions, construct buildings, spruce up your castle, and fill the coffers of your treasury. Your parents wouldn\'t be proud, but your grandparents, on your mother\'s side, would be delighted.\"\n\n?description from the back of the box\n\nIn Dominion, each player starts with an identical, very small deck of cards. In the center of the table is a selection of other cards the players can \"buy\" as they can afford them. Through their selection of cards to buy, and how they play their hands as they draw them, the players construct their deck on the fly, striving for the most efficient path to the precious victory points by game end.\n\nDominion is not a CCG, but the play of the game is similar to the construction and play of a CCG deck. The game comes with 500 cards. You select 10 of the 25 Kingdom card types to include in any given play?leading to immense variety.\n\n?user summary','2008',2,4,30,30,7.6,2.36,'https://cf.geekdo-images.com/j6iQpZ4XkemZP07HNCODBA__original/img/96COuakNiLRrjDLc1sM4Zxsw4WE=/0x0/filters:format(jpeg)/pic394356.jpg'),
	(4,237182,'Root','Root is a game of adventure and war in which 2 to 4 (1 to 6 with the \'Riverfolk\' expansion) players battle for control of a vast wilderness.\n\nThe nefarious Marquise de Cat has seized the great woodland, intent on harvesting its riches. Under her rule, the many creatures of the forest have banded together. This Alliance will seek to strengthen its resources and subvert the rule of Cats. In this effort, the Alliance may enlist the help of the wandering Vagabonds who are able to move through the more dangerous woodland paths. Though some may sympathize with the Alliance?s hopes and dreams, these wanderers are old enough to remember the great birds of prey who once controlled the woods.\n\nMeanwhile, at the edge of the region, the proud, squabbling Eyrie have found a new commander who they hope will lead their faction to resume their ancient birthright. The stage is set for a contest that will decide the fate of the great woodland. It is up to the players to decide which group will ultimately take root.\n\nRoot represents the next step in our development of asymmetric design. Like Vast: The Crystal Caverns, each player in Root has unique capabilities and a different victory condition. Now, with the aid of gorgeous, multi-use cards, a truly asymmetric design has never been more accessible.\n\nThe Cats play a game of engine building and logistics while attempting to police the vast wilderness. By collecting Wood they are able to produce workshops, lumber mills, and barracks. They win by building new buildings and crafts.\n\nThe Eyrie musters their hawks to take back the Woods. They must capture as much territory as possible and build roosts before they collapse back into squabbling.\n\nThe Alliance hides in the shadows, recruiting forces and hatching conspiracies. They begin slowly and build towards a dramatic late-game presence--but only if they can manage to keep the other players in check.\n\nMeanwhile, the Vagabond plays all sides of the conflict for their own gain, while hiding a mysterious quest. Explore the board, fight other factions, and work towards achieving your hidden goal.\n\nIn Root, players drive the narrative, and the differences between each role create an unparalleled level of interaction and replayability. Leder Games invites you and your family to explore the fantastic world of Root!','2018',2,4,60,90,8.1,3.68,'https://cf.geekdo-images.com/JUAUWaVUzeBgzirhZNmHHw__original/img/E0s2LvtFA1L5YKk-_44D4u2VD2s=/0x0/filters:format(jpeg)/pic4254509.jpg'),
	(5,199792,'Everdell','Within the charming valley of Everdell, beneath the boughs of towering trees, among meandering streams and mossy hollows, a civilization of forest critters is thriving and expanding. From Everfrost to Bellsong, many a year have come and gone, but the time has come for new territories to be settled and new cities established. You will be the leader of a group of critters intent on just such a task. There are buildings to construct, lively characters to meet, events to host?you have a busy year ahead of yourself. Will the sun shine brightest on your city before the winter moon rises?\n\nEverdell is a game of dynamic tableau building and worker placement.\n\nOn their turn a player can take one of three actions:\n\na) Place a Worker: Each player has a collection of Worker pieces. These are placed on the board locations, events, and on Destination cards. Workers perform various actions to further the development of a player\'s tableau: gathering resources, drawing cards, and taking other special actions.\n\nb) Play a Card: Each player is building and populating a city; a tableau of up to 15 Construction and Critter cards. There are five types of cards: Travelers, Production, Destination, Governance, and Prosperity. Cards generate resources (twigs, resin, pebbles, and berries), grant abilities, and ultimately score points. The interactions of the cards reveal numerous strategies and a near infinite variety of working cities.\n\nc) Prepare for the next Season: Workers are returned to the players supply and new workers are added. The game is played from Winter through to the onset of the following winter, at which point the player with the city with the most points wins.','2018',1,4,40,80,8.1,2.81,'https://cf.geekdo-images.com/fjE7V5LNq31yVEW_yuqI-Q__original/img/HQ1ti16wT9lqja5_h3gUfHUIcVI=/0x0/filters:format(png)/pic3918905.png'),
	(6,30549,'Pandemic','In Pandemic, several virulent diseases have broken out simultaneously all over the world! The players are disease-fighting specialists whose mission is to treat disease hotspots while researching cures for each of four plagues before they get out of hand.\n\nThe game board depicts several major population centers on Earth. On each turn, a player can use up to four actions to travel between cities, treat infected populaces, discover a cure, or build a research station. A deck of cards provides the players with these abilities, but sprinkled throughout this deck are Epidemic! cards that accelerate and intensify the diseases\' activity. A second, separate deck of cards controls the \"normal\" spread of the infections.\n\nTaking a unique role within the team, players must plan their strategy to mesh with their specialists\' strengths in order to conquer the diseases. For example, the Operations Expert can build research stations which are needed to find cures for the diseases and which allow for greater mobility between cities; the Scientist needs only four cards of a particular disease to cure it instead of the normal five?but the diseases are spreading quickly and time is running out. If one or more diseases spreads beyond recovery or if too much time elapses, the players all lose. If they cure the four diseases, they all win!\n\nThe 2013 edition of Pandemic includes two new characters?the Contingency Planner and the Quarantine Specialist?not available in earlier editions of the game.','2008',2,4,45,45,7.6,2.41,'https://cf.geekdo-images.com/S3ybV1LAp-8SnHIXLLjVqA__original/img/IsrvRLpUV1TEyZsO5rC-btXaPz0=/0x0/filters:format(jpeg)/pic1534148.jpg'),
	(7,172225,'Exploding Kittens','Exploding Kittens is a kitty-powered version of Russian Roulette. Players take turns drawing cards until someone draws an exploding kitten and loses the game. The deck is made up of cards that let you avoid exploding by peeking at cards before you draw, forcing your opponent to draw multiple cards, or shuffling the deck.\n\nThe game gets more and more intense with each card you draw because fewer cards left in the deck means a greater chance of drawing the kitten and exploding in a fiery ball of feline hyperbole.','2015',2,5,15,15,6.0,1.07,'https://cf.geekdo-images.com/N8bL53-pRU7zaXDTrEaYrw__original/img/0ciN1VZYifUd0qIDO0e8cGXmiss=/0x0/filters:format(png)/pic2691976.png');

/*!40000 ALTER TABLE `games` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
