-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2018 年 08 月 20 日 18:56
-- 服务器版本: 5.5.53-log
-- PHP 版本: 5.4.45

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `user`
--

-- --------------------------------------------------------

--
-- 表的结构 `delfiles`
--

CREATE TABLE IF NOT EXISTS `delfiles` (
  `orderId` char(32) NOT NULL,
  `time` char(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `delfiles`
--

INSERT INTO `delfiles` (`orderId`, `time`) VALUES
('e28135544292a1ba4a8054b6704090d4', '1534679653'),
('35fb5a0a11e95a35d01788ce89edd356', '1534679654'),
('fc1d9c00f892c1480b01a7f8a38b009a', '1534679666'),
('e48295ee7f5c08927f024349ffbc8c25', '1534688275'),
('94162d89d2c193cfa9480be11be91ea4', '1534688276'),
('ff341d3d6569ed444d952bb17c969b5f', '1534688363'),
('f3644f6b2d20c9b521d94b27982a2fb0', '1534688547'),
('e2c6eb078dfc3d3496b8a7abf88e2fef', '1534688552'),
('b571cef8ff9e6b5d2dc4a35e16938d49', '1534688560'),
('b58d68f8f6c75d39ec77811a2cc6753f', '1534688571'),
('a1009c94ab4429168d7b413ba48890cd', '1534688599'),
('07bb8d079771c51bb7a990cb85f197f7', '1534688612'),
('7e35a522af3da1405d066f81641226ba', '1534688615'),
('ab12271d73d40225bf2dff5af02f0f6f', '1534688817'),
('36a68515c61477fdf91a34303824778e', '1534688843'),
('f9be5e0288e4603e1c29e4c8d8391749', '1534688958'),
('1c16b447b0bfb2f7a28c479ca76af108', '1534689100'),
('8b0b9a06e137b0dcd3958ea24bb77c47', '1534689109'),
('11fe844d4b51dc2f63744132c0e7edfa', '1534689129'),
('de121b2df7efb2528570903984e7e086', '1534689329'),
('04876e0599a992a4e358b58126796d5a', '1534689379'),
('e9d140d7b84300a15b4c449ac1ec4865', '1534689415'),
('e07c854ff46dc6b1342b0705b63a46d7', '1534689434'),
('17a0b005ace82cce7370a3d87b122523', '1534689474'),
('4a2efef07eec3dc2c418294c9f6d9aad', '1534689499'),
('00bf51ad2375cfefa1dba026bc53249b', '1534689566'),
('b8870122a5551d45bbb9470ccb6e3ea0', '1534689602'),
('e7faef668a97d519747777778fe40847', '1534689626'),
('834bb65c6710d32d278a454755903106', '1534689662'),
('37e3ff6dbe5bd6d51a4ff748e9156243', '1534689686'),
('0d2f7ca321a507d2a22fcfe8cf6c4cb6', '1534689701'),
('0bf8c97933d86dee2d77bc67be257fa9', '1534689727'),
('c3134a472f8ee75c1d9f1d2e56c7f399', '1534689765'),
('2584bdc95cd387b04e5df22180294303', '1534689830'),
('51082f002096fe6bc70f57167df8b995', '1534689868'),
('b409df8e8da101b9505a2f8b0cdf984c', '1534689901'),
('d6e198af06c9b8b370f24041a29f9bda', '1534689957'),
('e684bcb61a2e4820686753a43282013d', '1534690039'),
('66132fdd9871ee41f638f868823688c0', '1534690052'),
('98940159017a9a80e340de9a37f286e3', '1534690103'),
('9a266c5f663c974604168682baaa136c', '1534690119'),
('c71c41a0143e8096a7c44699e5defa08', '1534690139'),
('9d6fa2a5c96a50a02e73b74d47f90177', '1534690159'),
('cd7442e613794cf6827935573807774b', '1534690167'),
('caab337d3d75753c86b148563502a64a', '1534690176'),
('b8e3a3e0482a8fd34d22fea798dbab95', '1534690183'),
('08dc1d5fbe9a362e1a9bab775baecf6d', '1534690191'),
('74e556bcd07ca1b1e5f9490fb1852931', '1534690197'),
('825f27fe1d2e7733b17317bfefab9c73', '1534690215'),
('01d242a6d6adc954802441858137133c', '1534690256'),
('0b2bdbdd9db64a290d8d17ceb0da5de3', '1534690279'),
('d97d8d88b0707c5d0789dd7e76940f02', '1534690294'),
('94de8d9f53af4f29ad21c934e3f23616', '1534690312'),
('056a14b91242619666f2bc3ba704023f', '1534690326'),
('f2de18b742eb9a535b93e44e51b3e251', '1534690338'),
('756f04d190c56dd371687ebb3e88b9db', '1534690351'),
('52abe0db9ad94fb0997b61c7d450c77f', '1534690381'),
('04a61ede846a8f1d89d763a7126475c0', '1534690406'),
('1a0612178641a678b8c2c5ff8335329f', '1534690416'),
('88219f31daf8b38ca789e69697f8dec4', '1534690435'),
('6cc7f80cf6a3ed22875a89f2229f949a', '1534690449'),
('04338e99a2827a8bab87e3f79c099a94', '1534690463'),
('c3b1d03ae8d613dc1f4aac7357f229ce', '1534690649'),
('598321ff9a299be0a1e9d04212a6f07e', '1534690666'),
('4d9658a078ffb8d40cf0f61e37db71a9', '1534690679'),
('4062bec68217bd2047cc9d8d96f7f897', '1534691098'),
('62c405a84c7161fa97639c4f272cab4f', '1534691139'),
('8032b637bd4098ebefbff182ebcd28d6', '1534691158'),
('df5365ea2770f1aeba866c2061a33c23', '1534691272'),
('b294aa2c9741667836022ad773130b46', '1534691378'),
('8380a9693974ecb3ae0f8bfde462ed48', '1534691402'),
('4aefebadd93edca6ece6f3bb46379c97', '1534691515'),
('2bf3702f40610301f6e5cc200cc5e128', '1534691680'),
('40f55cc2b905792d4ee0d525401b63cb', '1534691700'),
('d3135195713e52169541deb14ed8acf1', '1534691812'),
('5f4f4f367b3fb45b4b8753625e5f5f20', '1534691972'),
('1d7635c0d6942fd0d538ff7f4f38fd45', '1534692011'),
('6dc7dbe7678f76cd6565a258d05d6d7f', '1534692073'),
('a27b9830ac2d4335266f9576f2841f6e', '1534692115'),
('b85fd43c389dcd1686eecd59f014ed7c', '1534692127'),
('5a3f2cf6184c91801505e914f6e6e74e', '1534692304'),
('29e15f17b3730306089165794af8b5c4', '1534692323'),
('3a5d906b5b3d6929bbe43376746e539d', '1534692377'),
('115d03c19fdff5f873c862fe13fe9f8d', '1534692391'),
('8e7f65a667d30db7ef7ab75b50a7db5d', '1534728318'),
('3bb58cf5473e06ff64f2b286e4338ba6', '1534754150'),
('79e6cfa56d587b77885837876c4c3e65', '1534755613'),
('48517f065a3cec40643435bb1ac30584', '1534756188'),
('845480b72d53a86f574eee2b7a86858c', '1534757440'),
('cdb4a050d3e7a2c11734e1a08393b6a2', '1534757441'),
('f00794d324fece79c1f799d943cc6e0e', '1534757492'),
('176b23d85a1af1aa32a9bb1ce4c9f138', '1534758672');

-- --------------------------------------------------------

--
-- 表的结构 `fileinfo`
--

CREATE TABLE IF NOT EXISTS `fileinfo` (
  `orderId` char(32) NOT NULL,
  `filePath` varchar(100) NOT NULL,
  `color` char(1) NOT NULL DEFAULT '1',
  `num` int(11) NOT NULL DEFAULT '1',
  `paperType` int(11) NOT NULL DEFAULT '8',
  `filename` varchar(1000) NOT NULL,
  `otherInfo` varchar(500) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `fileinfo`
--

INSERT INTO `fileinfo` (`orderId`, `filePath`, `color`, `num`, `paperType`, `filename`, `otherInfo`) VALUES
('fc1d9c00f892c1480b01a7f8a38b009a', 'upload/21d882772742c10003f9e982966a5d1528d75537f4ca8c3c812f251e68411517.ics', '1', 1, 8, '%5BLeetCode%5D_Weekly%20Contest%2095%20%281%29.ics', ''),
('b58d68f8f6c75d39ec77811a2cc6753f', 'upload/e4ea7f6fac9d4b44b0cd256109dd3ab26111cb4241f7585d60dc671be66f9561.c', '1', 1, 8, '1.c', ''),
('ab12271d73d40225bf2dff5af02f0f6f', 'upload/e4ea7f6fac9d4b44b0cd256109dd3ab26111cb4241f7585d60dc671be66f9561.c', '1', 1, 8, '1.c', ''),
('36a68515c61477fdf91a34303824778e', 'upload/e4ea7f6fac9d4b44b0cd256109dd3ab26111cb4241f7585d60dc671be66f9561.c', '1', 1, 8, '1.c', ''),
('f9be5e0288e4603e1c29e4c8d8391749', 'upload/edfb5fbb6374b090dd2087d68793a4cb172a24d8d1e1a8266f82570a7763cd59.c', '1', 1, 8, '2.c', ''),
('1c16b447b0bfb2f7a28c479ca76af108', 'upload/edfb5fbb6374b090dd2087d68793a4cb172a24d8d1e1a8266f82570a7763cd59.c', '1', 1, 8, '2.c', ''),
('11fe844d4b51dc2f63744132c0e7edfa', 'upload/edfb5fbb6374b090dd2087d68793a4cb172a24d8d1e1a8266f82570a7763cd59.c', '1', 1, 8, '2.c', ''),
('de121b2df7efb2528570903984e7e086', 'upload/e4ea7f6fac9d4b44b0cd256109dd3ab26111cb4241f7585d60dc671be66f9561.c', '1', 1, 8, '1.c', ''),
('04876e0599a992a4e358b58126796d5a', 'upload/e4ea7f6fac9d4b44b0cd256109dd3ab26111cb4241f7585d60dc671be66f9561.c', '1', 1, 8, '1.c', ''),
('4a2efef07eec3dc2c418294c9f6d9aad', 'upload/edfb5fbb6374b090dd2087d68793a4cb172a24d8d1e1a8266f82570a7763cd59.c', '1', 1, 8, '2.c', ''),
('834bb65c6710d32d278a454755903106', 'upload/edfb5fbb6374b090dd2087d68793a4cb172a24d8d1e1a8266f82570a7763cd59.c', '1', 1, 8, '2.c', ''),
('37e3ff6dbe5bd6d51a4ff748e9156243', 'upload/e4ea7f6fac9d4b44b0cd256109dd3ab26111cb4241f7585d60dc671be66f9561.c', '1', 1, 8, '1.c', ''),
('0d2f7ca321a507d2a22fcfe8cf6c4cb6', 'upload/edfb5fbb6374b090dd2087d68793a4cb172a24d8d1e1a8266f82570a7763cd59.c', '1', 1, 8, '2.c', ''),
('0bf8c97933d86dee2d77bc67be257fa9', 'upload/edfb5fbb6374b090dd2087d68793a4cb172a24d8d1e1a8266f82570a7763cd59.c', '1', 1, 8, '2.c', ''),
('c3134a472f8ee75c1d9f1d2e56c7f399', 'upload/edfb5fbb6374b090dd2087d68793a4cb172a24d8d1e1a8266f82570a7763cd59.c', '1', 1, 8, '2.c', ''),
('2584bdc95cd387b04e5df22180294303', 'upload/7fbc3c70019973cb43e24bd47ad4c7577f9fe10929cf4e873c17262624ed9f1c.py', '1', 1, 8, 'o.py', ''),
('51082f002096fe6bc70f57167df8b995', 'upload/7fbc3c70019973cb43e24bd47ad4c7577f9fe10929cf4e873c17262624ed9f1c.py', '1', 1, 8, 'o.py', ''),
('b409df8e8da101b9505a2f8b0cdf984c', 'upload/edfb5fbb6374b090dd2087d68793a4cb172a24d8d1e1a8266f82570a7763cd59.c', '1', 1, 8, '2.c', ''),
('825f27fe1d2e7733b17317bfefab9c73', 'upload/e4ea7f6fac9d4b44b0cd256109dd3ab26111cb4241f7585d60dc671be66f9561.c', '1', 1, 8, '1.c', ''),
('01d242a6d6adc954802441858137133c', 'upload/edfb5fbb6374b090dd2087d68793a4cb172a24d8d1e1a8266f82570a7763cd59.c', '1', 1, 8, '2.c', ''),
('0b2bdbdd9db64a290d8d17ceb0da5de3', 'upload/edfb5fbb6374b090dd2087d68793a4cb172a24d8d1e1a8266f82570a7763cd59.c', '1', 1, 8, '2.c', ''),
('d97d8d88b0707c5d0789dd7e76940f02', 'upload/7fbc3c70019973cb43e24bd47ad4c7577f9fe10929cf4e873c17262624ed9f1c.py', '1', 1, 8, 'o.py', ''),
('94de8d9f53af4f29ad21c934e3f23616', 'upload/7fbc3c70019973cb43e24bd47ad4c7577f9fe10929cf4e873c17262624ed9f1c.py', '1', 1, 8, 'o.py', ''),
('056a14b91242619666f2bc3ba704023f', 'upload/7fbc3c70019973cb43e24bd47ad4c7577f9fe10929cf4e873c17262624ed9f1c.py', '1', 1, 8, 'o.py', ''),
('f2de18b742eb9a535b93e44e51b3e251', 'upload/7fbc3c70019973cb43e24bd47ad4c7577f9fe10929cf4e873c17262624ed9f1c.py', '1', 1, 8, 'o.py', ''),
('756f04d190c56dd371687ebb3e88b9db', 'upload/7fbc3c70019973cb43e24bd47ad4c7577f9fe10929cf4e873c17262624ed9f1c.py', '1', 1, 8, 'o.py', ''),
('598321ff9a299be0a1e9d04212a6f07e', 'upload/7fbc3c70019973cb43e24bd47ad4c7577f9fe10929cf4e873c17262624ed9f1c.py', '1', 1, 8, 'o.py', ''),
('4d9658a078ffb8d40cf0f61e37db71a9', 'upload/7fbc3c70019973cb43e24bd47ad4c7577f9fe10929cf4e873c17262624ed9f1c.py', '1', 1, 8, 'o.py', ''),
('4062bec68217bd2047cc9d8d96f7f897', 'upload/edfb5fbb6374b090dd2087d68793a4cb172a24d8d1e1a8266f82570a7763cd59.c', '1', 1, 8, '2.c', ''),
('62c405a84c7161fa97639c4f272cab4f', 'upload/7fbc3c70019973cb43e24bd47ad4c7577f9fe10929cf4e873c17262624ed9f1c.py', '1', 1, 8, 'o.py', ''),
('8032b637bd4098ebefbff182ebcd28d6', 'upload/7fbc3c70019973cb43e24bd47ad4c7577f9fe10929cf4e873c17262624ed9f1c.py', '1', 1, 8, 'o.py', ''),
('df5365ea2770f1aeba866c2061a33c23', 'upload/7fbc3c70019973cb43e24bd47ad4c7577f9fe10929cf4e873c17262624ed9f1c.py', '1', 1, 8, 'o.py', ''),
('b294aa2c9741667836022ad773130b46', 'upload/7fbc3c70019973cb43e24bd47ad4c7577f9fe10929cf4e873c17262624ed9f1c.py', '1', 1, 8, 'o.py', ''),
('8380a9693974ecb3ae0f8bfde462ed48', 'upload/7fbc3c70019973cb43e24bd47ad4c7577f9fe10929cf4e873c17262624ed9f1c.py', '1', 1, 8, 'o.py', ''),
('5a3f2cf6184c91801505e914f6e6e74e', 'upload/e4ea7f6fac9d4b44b0cd256109dd3ab26111cb4241f7585d60dc671be66f9561.c', '1', 1, 8, '1.c', '');

-- --------------------------------------------------------

--
-- 表的结构 `orderids`
--

CREATE TABLE IF NOT EXISTS `orderids` (
  `orderId` char(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `orderids`
--

INSERT INTO `orderids` (`orderId`) VALUES
('e28135544292a1ba4a8054b6704090d4'),
('35fb5a0a11e95a35d01788ce89edd356'),
('fc1d9c00f892c1480b01a7f8a38b009a'),
('e48295ee7f5c08927f024349ffbc8c25'),
('94162d89d2c193cfa9480be11be91ea4'),
('ff341d3d6569ed444d952bb17c969b5f'),
('f3644f6b2d20c9b521d94b27982a2fb0'),
('e2c6eb078dfc3d3496b8a7abf88e2fef'),
('b571cef8ff9e6b5d2dc4a35e16938d49'),
('b58d68f8f6c75d39ec77811a2cc6753f'),
('a1009c94ab4429168d7b413ba48890cd'),
('07bb8d079771c51bb7a990cb85f197f7'),
('7e35a522af3da1405d066f81641226ba'),
('ab12271d73d40225bf2dff5af02f0f6f'),
('36a68515c61477fdf91a34303824778e'),
('f9be5e0288e4603e1c29e4c8d8391749'),
('1c16b447b0bfb2f7a28c479ca76af108'),
('8b0b9a06e137b0dcd3958ea24bb77c47'),
('11fe844d4b51dc2f63744132c0e7edfa'),
('de121b2df7efb2528570903984e7e086'),
('04876e0599a992a4e358b58126796d5a'),
('e9d140d7b84300a15b4c449ac1ec4865'),
('e07c854ff46dc6b1342b0705b63a46d7'),
('17a0b005ace82cce7370a3d87b122523'),
('4a2efef07eec3dc2c418294c9f6d9aad'),
('00bf51ad2375cfefa1dba026bc53249b'),
('b8870122a5551d45bbb9470ccb6e3ea0'),
('e7faef668a97d519747777778fe40847'),
('834bb65c6710d32d278a454755903106'),
('37e3ff6dbe5bd6d51a4ff748e9156243'),
('0d2f7ca321a507d2a22fcfe8cf6c4cb6'),
('0bf8c97933d86dee2d77bc67be257fa9'),
('c3134a472f8ee75c1d9f1d2e56c7f399'),
('2584bdc95cd387b04e5df22180294303'),
('51082f002096fe6bc70f57167df8b995'),
('b409df8e8da101b9505a2f8b0cdf984c'),
('d6e198af06c9b8b370f24041a29f9bda'),
('e684bcb61a2e4820686753a43282013d'),
('66132fdd9871ee41f638f868823688c0'),
('98940159017a9a80e340de9a37f286e3'),
('9a266c5f663c974604168682baaa136c'),
('c71c41a0143e8096a7c44699e5defa08'),
('9d6fa2a5c96a50a02e73b74d47f90177'),
('cd7442e613794cf6827935573807774b'),
('caab337d3d75753c86b148563502a64a'),
('b8e3a3e0482a8fd34d22fea798dbab95'),
('08dc1d5fbe9a362e1a9bab775baecf6d'),
('74e556bcd07ca1b1e5f9490fb1852931'),
('825f27fe1d2e7733b17317bfefab9c73'),
('01d242a6d6adc954802441858137133c'),
('0b2bdbdd9db64a290d8d17ceb0da5de3'),
('d97d8d88b0707c5d0789dd7e76940f02'),
('94de8d9f53af4f29ad21c934e3f23616'),
('056a14b91242619666f2bc3ba704023f'),
('f2de18b742eb9a535b93e44e51b3e251'),
('756f04d190c56dd371687ebb3e88b9db'),
('52abe0db9ad94fb0997b61c7d450c77f'),
('04a61ede846a8f1d89d763a7126475c0'),
('1a0612178641a678b8c2c5ff8335329f'),
('88219f31daf8b38ca789e69697f8dec4'),
('6cc7f80cf6a3ed22875a89f2229f949a'),
('04338e99a2827a8bab87e3f79c099a94'),
('c3b1d03ae8d613dc1f4aac7357f229ce'),
('598321ff9a299be0a1e9d04212a6f07e'),
('4d9658a078ffb8d40cf0f61e37db71a9'),
('4062bec68217bd2047cc9d8d96f7f897'),
('62c405a84c7161fa97639c4f272cab4f'),
('8032b637bd4098ebefbff182ebcd28d6'),
('df5365ea2770f1aeba866c2061a33c23'),
('b294aa2c9741667836022ad773130b46'),
('8380a9693974ecb3ae0f8bfde462ed48'),
('4aefebadd93edca6ece6f3bb46379c97'),
('2bf3702f40610301f6e5cc200cc5e128'),
('40f55cc2b905792d4ee0d525401b63cb'),
('d3135195713e52169541deb14ed8acf1'),
('5f4f4f367b3fb45b4b8753625e5f5f20'),
('1d7635c0d6942fd0d538ff7f4f38fd45'),
('6dc7dbe7678f76cd6565a258d05d6d7f'),
('a27b9830ac2d4335266f9576f2841f6e'),
('b85fd43c389dcd1686eecd59f014ed7c'),
('5a3f2cf6184c91801505e914f6e6e74e'),
('29e15f17b3730306089165794af8b5c4'),
('3a5d906b5b3d6929bbe43376746e539d'),
('115d03c19fdff5f873c862fe13fe9f8d'),
('8e7f65a667d30db7ef7ab75b50a7db5d'),
('3bb58cf5473e06ff64f2b286e4338ba6'),
('79e6cfa56d587b77885837876c4c3e65'),
('48517f065a3cec40643435bb1ac30584'),
('845480b72d53a86f574eee2b7a86858c'),
('cdb4a050d3e7a2c11734e1a08393b6a2'),
('f00794d324fece79c1f799d943cc6e0e'),
('176b23d85a1af1aa32a9bb1ce4c9f138');

-- --------------------------------------------------------

--
-- 表的结构 `orderinfo`
--

CREATE TABLE IF NOT EXISTS `orderinfo` (
  `orderId` char(32) NOT NULL,
  `consumer` char(15) NOT NULL,
  `business` char(15) NOT NULL,
  `deadline` varchar(13) NOT NULL,
  `orderState` int(11) NOT NULL,
  `orderInfo` varchar(400) NOT NULL,
  `exCode` char(6) NOT NULL,
  PRIMARY KEY (`orderId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `printerinfo`
--

CREATE TABLE IF NOT EXISTS `printerinfo` (
  `username` char(15) NOT NULL,
  `color` char(1) NOT NULL,
  `paperType` int(11) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `username` char(15) NOT NULL,
  `password` varchar(16) NOT NULL,
  `type` char(1) NOT NULL,
  `province` char(50) NOT NULL,
  `city` char(50) NOT NULL,
  `area` char(50) NOT NULL,
  `other` varchar(400) NOT NULL,
  `lo` varchar(15) NOT NULL,
  `la` varchar(15) NOT NULL,
  `state` char(1) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`username`, `password`, `type`, `province`, `city`, `area`, `other`, `lo`, `la`, `state`) VALUES
('lxs0401', 'wslzd9877', '1', '', '', '', '', '', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
