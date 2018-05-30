ALTER TABLE ero.book ADD category_id int AFTER book_id;
ALTER TABLE ero.book ADD genre_id int AFTER book_id;
ALTER TABLE ero.book ADD author_id int AFTER category_id;
ALTER TABLE ero.book ADD tag1 int AFTER author_id;
ALTER TABLE ero.book ADD tag2 int AFTER tag1;
ALTER TABLE ero.book ADD tag3 int AFTER tag2;

CREATE TABLE `category` (
  `id` int(11) AUTO_INCREMENT,
  `category_id` int(11) unsigned NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `del_flg` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`category_id`),
  KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8

CREATE TABLE `genre` (
  `id` int(11) AUTO_INCREMENT,
  `genre_id` int(11) unsigned NOT NULL,
  `category_id` int(11) unsigned NOT NULL,
  `genre_name` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `del_flg` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`genre_id`),
  KEY (`id`),
  FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8

CREATE TABLE `author` (
  `id` int(11) AUTO_INCREMENT,
  `author_id` int(11) unsigned NOT NULL,
  `author_name` varchar(255) NOT NULL,
  `introduction` varchar(1000) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `del_flg` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`author_id`),
  KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8

CREATE TABLE `tag` (
  `id` int(11) AUTO_INCREMENT,
  `tag_id` int(11) unsigned NOT NULL,
  `tag_name` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `del_flg` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tag_id`),
  KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8














drop table book;

CREATE TABLE `book` (
  `id` int(11) AUTO_INCREMENT,
  `book_id` int(11) unsigned NOT NULL,
  `genre_id` int(11) unsigned NOT NULL DEFAULT 0,
  `category_id` int(11) unsigned NOT NULL DEFAULT 0,
  `author_id` int(11) unsigned NOT NULL DEFAULT 0,
  `tag1` int(11) NOT NULL DEFAULT 0,
  `tag2` int(11) NOT NULL DEFAULT 0,
  `tag3` int(11) NOT NULL DEFAULT 0,
  `book_name` varchar(255) NOT NULL,
  `introduction` varchar(1000) NOT NULL,
  `folder_path` varchar(255) NOT NULL,
  `html` varchar(255) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `del_flg` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`book_id`),
  KEY (`id`),
  FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`),
  FOREIGN KEY (`genre_id`) REFERENCES `genre` (`genre_id`),
  FOREIGN KEY (`author_id`) REFERENCES `author` (`author_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8

INSERT INTO `book` (`book_id`, `genre_id`, `category_id`, `author_id`, `tag1`, `tag2`, `tag3`, `book_name`, `folder_path`, `html`, `thumbnail`, `created`, `updated`, `del_flg`) VALUES
(1, 0, 0, 0, 0, 0, 0, 'もんはんのえろほん1', '/エロ漫画/MonsterHunter/もんはんのえろほん1/', 'mh_ero1.html', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(2, 0, 0, 0, 0, 0, 0, 'もんはんのえろほん2', '/エロ漫画/MonsterHunter/もんはんのえろほん2/', 'mh_ero2.html', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(3, 0, 0, 0, 0, 0, 0, 'もんはんのえろほん3', '/エロ漫画/MonsterHunter/もんはんのえろほん3/', 'mh_ero3.html', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(4, 0, 0, 0, 0, 0, 0, 'もんはんのえろほん4', '/エロ漫画/MonsterHunter/もんはんのえろほん4/', 'mh_ero4.html', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(5, 0, 0, 0, 0, 0, 0, 'もんはんのえろほん5', '/エロ漫画/MonsterHunter/もんはんのえろほん5/', 'mh_ero5.html', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(6, 0, 0, 0, 0, 0, 0, 'もんはんのえろほん6', '/エロ漫画/MonsterHunter/もんはんのえろほん6/', 'mh_ero6.html', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(7, 0, 0, 0, 0, 0, 0, 'もんはんのえろほん7', '/エロ漫画/MonsterHunter/もんはんのえろほん7/', 'mh_ero7.html', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(8, 0, 0, 0, 0, 0, 0, 'もんはんのえろほん8', '/エロ漫画/MonsterHunter/もんはんのえろほん8/', 'mh_ero8.html', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(9, 0, 0, 0, 0, 0, 0, 'もんはんのえろほん9', '/エロ漫画/MonsterHunter/もんはんのえろほん9/', 'mh_ero9.html', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(10, 0, 0, 0, 0, 0, 0, 'もんはんのえろほん10', '/エロ漫画/MonsterHunter/もんはんのえろほん10/', 'mh_ero10.html', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(11, 0, 0, 0, 0, 0, 0, 'もんはんのえろほん11', '/エロ漫画/MonsterHunter/もんはんのえろほん11/', 'mh_ero11.html', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(12, 0, 0, 0, 0, 0, 0, 'もんはんのえろほん12', '/エロ漫画/MonsterHunter/もんはんのえろほん12/', 'mh_ero12.html', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(13, 0, 0, 0, 0, 0, 0, 'もんはんのえろほん13', '/エロ漫画/MonsterHunter/もんはんのえろほん13/', 'mh_ero13.html', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(14, 0, 0, 0, 0, 0, 0, 'もんはんのえろほん14', '/エロ漫画/MonsterHunter/もんはんのえろほん14/', 'mh_ero14.html', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(15, 0, 0, 0, 0, 0, 0, 'もんはんのえろほん外伝', '/エロ漫画/MonsterHunter/もんはんのえろほん外伝/', 'mh_ero外伝.html', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(16, 0, 0, 0, 0, 0, 0, 'おっぱいでイカサマ２', '/エロ漫画/咲/nodoka/', 'oppao.html', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(17, 0, 0, 0, 0, 0, 0, 'おっぱいでイカサマ２', '/エロ漫画/咲/おっぱいでイカサマ(Comic1☆3)(修正版)[瞬間最大風速]/', 'oppao2.html', '01.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(20, 0, 0, 0, 0, 0, 0, 'のどか日和', '/エロ漫画/咲/(C76) (同人誌) [かに家] 和日和 (咲 -Saki-)/', 'noifo.html', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(21, 0, 0, 0, 0, 0, 0, 'のどかぺんぎん', '/エロ漫画/咲/(同人誌) [from SCRATCH] のどかなペンギン/', 'pengin.html', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(22, 0, 0, 0, 0, 0, 0, 'いとこ兄と凛ちゃん！①', '/エロ漫画/LoveLive!/itoko_rin1/', 'itoko.html', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(23, 0, 0, 0, 0, 0, 0, 'いとこ兄と凛ちゃん！②', '/エロ漫画/LoveLive!/itoko_rin2/', 'rinn.html', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(24, 0, 0, 0, 0, 0, 0, 'スピリチュアルライブ', '/エロ漫画/LoveLive!/umi/', 'result.htm', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(27, 0, 0, 0, 0, 0, 0, '秘密', '/エロ漫画//eva/himitu/', 'mogu2.html', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(28, 0, 0, 0, 0, 0, 0, '綾波レイ00', '/エロ漫画/eva/mogudan00/', '', '8568848_1261910364_1.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(29, 0, 0, 0, 0, 0, 0, '綾波レイ1', '/エロ漫画//eva/mogudan1/', 'ayanami4.html', '8569219_1261911306_1.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(30, 0, 0, 0, 0, 0, 0, '綾波レイ3.5', '/エロ漫画//eva/mogudan3_5/', 'ayanami2.html', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(31, 0, 0, 0, 0, 0, 0, '綾波レイ5', '/エロ漫画//eva/mogudan5/', 'ayaya.html', 'ayanami5kai_001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(32, 0, 0, 0, 0, 0, 0, 'Hな健康診断', '/エロ漫画/\\THE IDOLM@STER CINDERELLA GIRLS/all/', 'ろりろり.html', '01_01.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(33, 0, 0, 0, 0, 0, 0, 'Secret Live After', '/エロ漫画/\\THE IDOLM@STER CINDERELLA GIRLS/mayu1/', 'mayuyu3.html', '00001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(34, 0, 0, 0, 0, 0, 0, 'まゆにおまかせ', '/エロ漫画/\\THE IDOLM@STER CINDERELLA GIRLS/mayu2/', 'mayuyu.html', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(35, 0, 0, 0, 0, 0, 0, 'どすけべミナミ', '/エロ漫画/\\THE IDOLM@STER CINDERELLA GIRLS/minami1/', 'みなみ１.html', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(36, 0, 0, 0, 0, 0, 0, 'どすけべミナミ3', '/エロ漫画/THE IDOLM@STER CINDERELLA GIRLS/minami3/', 'みなみ３.html', 'sc001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(37, 0, 0, 0, 0, 0, 0, 'どすけべリン', '/エロ漫画/\\THE IDOLM@STER CINDERELLA GIRLS/siburin_p/', 'rinnnn.html', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(38, 0, 0, 0, 0, 0, 0, 'ヤク漬けリンちゃん', '/エロ漫画/\\THE IDOLM@STER CINDERELLA GIRLS/siburin_yaku/', 'siburin.html', '000.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(39, 0, 0, 0, 0, 0, 0, '追加オッパイ×２', '/エロ漫画/\\THE IDOLM@STER CINDERELLA GIRLS/tuika_oppai/', '追加パイ.html', '0001_001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(40, 0, 0, 0, 0, 0, 0, '壊れ卯月', '/エロ漫画/\\THE IDOLM@STER CINDERELLA GIRLS/uduki/', 'uduki.html', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(41, 0, 0, 0, 0, 0, 0, 'スイートデリバリー', '/eromangaList/kaniya/delibary/', 'copy.html', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(42, 0, 0, 0, 0, 0, 0, 'カードになりませんか？', '/eromangaList/kaniya/itigo/', 'copy.html', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(43, 0, 0, 0, 0, 0, 0, 'ビッチにかしこま！？', '/eromangaList/kaniya/kasikoma/', 'copy.html', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(44, 0, 0, 0, 0, 0, 0, 'きららのプリンスレッスン！', '/eromangaList/kaniya/lesson/', 'copy.html', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(45, 0, 0, 0, 0, 0, 0, 'リコちゃんのHなアルバイト', '/eromangaList/kaniya/rikoH/', 'copy.html', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(46, 0, 0, 0, 0, 0, 0, 'きせかえりかちゃん', '/eromangaList/kaniya/rp_245842/', 'copy.html', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(47, 0, 0, 0, 0, 0, 0, 'おいでませ！！幻想郷?', '/eromangaList/toho/toho_huuzoku/', '', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(48, 0, 0, 0, 0, 0, 0, '秘密', '/eromangaList/original/himitu/', '', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(49, 0, 0, 0, 0, 0, 0, '淫乱遺伝子', '/eromangaList/original/savan_inran/', '', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(50, 0, 0, 0, 0, 0, 0, 'riba-siburu', '/eromangaList/original/savan_river/', '', '319.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(51, 0, 0, 0, 0, 0, 0, 'ハーレムハーレム', '/eromangaList/original/ha-remu/', '', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(52, 0, 0, 0, 0, 0, 0, '擬似調教', '/eromangaList/original/tyokyo-yasu/', '', '00001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(53, 0, 0, 0, 0, 0, 0, 'つながるつながり', '/eromangaList/original/tunagaru-yasu/', '', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(54, 0, 0, 0, 0, 0, 0, '教え子', '/eromangaList/original/syozyo-yasu/', '', '00001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(55, 0, 0, 0, 0, 0, 0, 'はなまる', '/eromangaList/original/hanamaru-yasu/', '', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(56, 0, 0, 0, 0, 0, 0, 'ジカセイフウゾク', '/eromangaList/original/zisekai-yasu/', '', '00001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(57, 0, 0, 0, 0, 0, 0, 'お母さん帰ってくる前に', '/eromangaList/original/mother/', '', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(58, 0, 0, 0, 0, 0, 0, '女子高セイバー', '/eromangaList/fate/seiba-/', '', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(59, 0, 0, 0, 0, 0, 0, 'ゆうちゃん', '/eromangaList/original/yuutyan/', '', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(60, 0, 0, 0, 0, 0, 0, '鹿島と', '/eromangaList/kankore/ehentai_16050/', '', '00001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(61, 0, 0, 0, 0, 0, 0, 'さんた鈴谷', '/eromangaList/kankore/nh_3175/', '', '00001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(62, 0, 0, 0, 0, 0, 0, 'あの霊夢と', '/eromangaList/toho/HAMMER_HEAD/', '', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(63, 0, 0, 0, 0, 0, 0, '夜戦', '/eromangaList/toho/HAMMER-HEAD-bomei/', '', '01__IMG000.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(64, 0, 0, 0, 0, 0, 0, '鶴', '/eromangaList/kankore/HAMMER_HEAD-hasituru/', '', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(65, 0, 0, 0, 0, 0, 0, '妖夢', '/eromangaList/toho/[HAMMER_HEAD] -yomu/', '', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(66, 0, 0, 0, 0, 0, 0, 'アヤヤ', '/eromangaList/toho/[HAMMER_HEAD-ayaya/', '', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(67, 0, 0, 0, 0, 0, 0, '全部', '/eromangaList/toho/[HAMMER_HEAD-all/', '', '0000.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(69, 0, 0, 0, 0, 0, 0, '星空マリンライン高画質', '/eromangaList/lovelive/rin_ringo2/', '', 'img001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(70, 0, 0, 0, 0, 0, 0, '姉妹はフェラピュア', '/eromangaList/original/fera1/', '', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(71, 0, 0, 0, 0, 0, 0, '姉妹はフェラピュア', '/eromangaList/original/fera2/', '', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(72, 0, 0, 0, 0, 0, 0, '姉妹はフェラピュア3', '/eromangaList/original/fera3//', '', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(73, 0, 0, 0, 0, 0, 0, '姉妹はフェラピュア5', '/eromangaList/original/fera5//', '', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(74, 0, 0, 0, 0, 0, 0, '姉妹はフェラピュア6', '/eromangaList/original/fera6/', '', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(75, 0, 0, 0, 0, 0, 0, '姉妹はフェラピュアR', '/eromangaList/original/feraR/', '', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(76, 0, 0, 0, 0, 0, 0, 'JK飼育日記', '/eromangaList/original/jk/', '', '475.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(77, 0, 0, 0, 0, 0, 0, '姉妹はフェラピュア3', '/eromangaList/original/fera3//', '', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(78, 0, 0, 0, 0, 0, 0, '姉妹はフェラピュア3', '/eromangaList/original/fera3//', '', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(79, 0, 0, 0, 0, 0, 0, '姉妹はフェラピュア3', '/eromangaList/original/fera3//', '', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(82, 0, 0, 0, 0, 0, 0, '無題', '/eromangaList/original/zero_maimama/', '', '000.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(83, 0, 0, 0, 0, 0, 0, '無題', '/eromangaList/original/zero_maimama/', '', '000.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(84, 0, 0, 0, 0, 0, 0, '無題', '/eromangaList/original/zero_maimama/', '', '000.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(85, 0, 0, 0, 0, 0, 0, '無題', '/eromangaList/original/nakama/', '', '1.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(86, 0, 0, 0, 0, 0, 0, 'maplepoison', '/eromangaList/IDOLMASTER/rp_601873/', '', 'tt00001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(87, 0, 0, 0, 0, 0, 0, '無題', '/eromangaList/IDOLMASTER/rp_624295/', '', 'tt001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(88, 0, 0, 0, 0, 0, 0, '無題', '/eromangaList/IDOLMASTER/[LAMINARIA]Unhappy Ladies/', '', '001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(89, 0, 0, 0, 0, 0, 0, '無題', '/eromangaList/original/ehentai_9811/', '', '00001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0),
(90, 0, 0, 0, 0, 0, 0, '無題', '/eromangaList/original/ehentai_16441//', '', '00001.jpg', '2017-12-23 16:33:41', '0000-00-00 00:00:00', 0);