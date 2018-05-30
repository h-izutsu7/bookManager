UPDATE category SET category_name  = '同人' WHERE category_id = 1;

INSERT INTO category (category_id, category_name, del_flg) VALUES('0', '', '0');
INSERT INTO genre (genre_id, genre_name, category_id, del_flg) VALUES('0', '', 0, 0);
INSERT INTO category (category_name, del_flg) VALUES('同人', '0');
INSERT INTO category (category_name, del_flg) VALUES('二次元', '0');
INSERT INTO genre (genre_name, category_id, del_flg) VALUES('モンハン', 4, 0);
INSERT INTO genre (genre_name, category_id, del_flg) VALUES('咲', 4, 0);
INSERT INTO genre (genre_name, category_id, del_flg) VALUES('デレマス', 4, 0);
INSERT INTO genre (genre_name, category_id, del_flg) VALUES('姉妹', 5, 0);
INSERT INTO book_list (book_id, category_id, genre_id) VALUES(1, 1, 1);

INSERT INTO book_list (book_id, category_id, genre_id) VALUES(32, 1, 6);
INSERT INTO book_list (book_id, category_id, genre_id) VALUES(33, 1, 6);
INSERT INTO book_list (book_id, category_id, genre_id) VALUES(34, 1, 6);
INSERT INTO book_list (book_id, category_id, genre_id) VALUES(35, 1, 6);
INSERT INTO book_list (book_id, category_id, genre_id) VALUES(36, 1, 6);
INSERT INTO book_list (book_id, category_id, genre_id) VALUES(37, 1, 6);
INSERT INTO book_list (book_id, category_id, genre_id) VALUES(38, 1, 6);
INSERT INTO book_list (book_id, category_id, genre_id) VALUES(39, 1, 6);
INSERT INTO book_list (book_id, category_id, genre_id) VALUES(40, 1, 6);





DELETE FROM category where category_id = 2;
DELETE FROM book where category_id = 2;
DELETE FROM book where book_id in (18, 19);
SELECT * FROM category;

INSERT INTO book (book_name, forder_path, html, thumbnail, del_flg) VALUES('もんはんのえろほん1', '/エロ漫画/MonsterHunter/もんはんのえろほん1/', 'mh_ero1.html', '001.jpg', 0);
INSERT INTO book (book_name, forder_path, html, thumbnail, del_flg) VALUES('もんはんのえろほん1', '/エロ漫画/MonsterHunter/もんはんのえろほん2/', 'mh_ero2.html', '001.jpg', 0);
INSERT INTO book (book_name, forder_path, html, thumbnail, del_flg) VALUES('もんはんのえろほん1', '/エロ漫画/MonsterHunter/もんはんのえろほん3/', 'mh_ero3.html', '001.jpg', 0);
INSERT INTO book (book_name, forder_path, html, thumbnail, del_flg) VALUES('もんはんのえろほん1', '/エロ漫画/MonsterHunter/もんはんのえろほん4/', 'mh_ero4.html', '001.jpg', 0);
INSERT INTO book (book_name, forder_path, html, thumbnail, del_flg) VALUES('もんはんのえろほん1', '/エロ漫画/MonsterHunter/もんはんのえろほん5/', 'mh_ero5.html', '001.jpg', 0);
INSERT INTO book (book_name, forder_path, html, thumbnail, del_flg) VALUES('もんはんのえろほん1', '/エロ漫画/MonsterHunter/もんはんのえろほん6/', 'mh_ero6.html', '001.jpg', 0);
INSERT INTO book (book_name, forder_path, html, thumbnail, del_flg) VALUES('もんはんのえろほん1', '/エロ漫画/MonsterHunter/もんはんのえろほん7/', 'mh_ero7.html', '001.jpg', 0);
INSERT INTO book (book_name, forder_path, html, thumbnail, del_flg) VALUES('もんはんのえろほん1', '/エロ漫画/MonsterHunter/もんはんのえろほん8/', 'mh_ero8.html', '001.jpg', 0);
INSERT INTO book (book_name, forder_path, html, thumbnail, del_flg) VALUES('もんはんのえろほん1', '/エロ漫画/MonsterHunter/もんはんのえろほん9/', 'mh_ero9.html', '001.jpg', 0);
INSERT INTO book (book_name, forder_path, html, thumbnail, del_flg) VALUES('もんはんのえろほん1', '/エロ漫画/MonsterHunter/もんはんのえろほん10/', 'mh_ero10.html', '001.jpg', 0);
INSERT INTO book (book_name, forder_path, html, thumbnail, del_flg) VALUES('もんはんのえろほん1', '/エロ漫画/MonsterHunter/もんはんのえろほん11/', 'mh_ero11.html', '001.jpg', 0);
INSERT INTO book (book_name, forder_path, html, thumbnail, del_flg) VALUES('もんはんのえろほん1', '/エロ漫画/MonsterHunter/もんはんのえろほん12/', 'mh_ero12.html', '001.jpg', 0);
INSERT INTO book (book_name, forder_path, html, thumbnail, del_flg) VALUES('もんはんのえろほん1', '/エロ漫画/MonsterHunter/もんはんのえろほん13/', 'mh_ero13.html', '001.jpg', 0);
INSERT INTO book (book_name, forder_path, html, thumbnail, del_flg) VALUES('もんはんのえろほん1', '/エロ漫画/MonsterHunter/もんはんのえろほん14/', 'mh_ero14.html', '001.jpg', 0);
INSERT INTO book (book_name, forder_path, html, thumbnail, del_flg) VALUES('もんはんのえろほん1', '/エロ漫画/MonsterHunter/もんはんのえろほん外伝/', 'mh_ero外伝.html', '001.jpg', 0);

UPDATE book SET book_name  = 'もんはんのえろほん2' WHERE book_id = 2;
UPDATE book SET book_name  = 'もんはんのえろほん3' WHERE book_id = 3;
UPDATE book SET book_name  = 'もんはんのえろほん4' WHERE book_id = 4;
UPDATE book SET book_name  = 'もんはんのえろほん5' WHERE book_id = 5;
UPDATE book SET book_name  = 'もんはんのえろほん6' WHERE book_id = 6;
UPDATE book SET book_name  = 'もんはんのえろほん7' WHERE book_id = 7;
UPDATE book SET book_name  = 'もんはんのえろほん8' WHERE book_id = 8;
UPDATE book SET book_name  = 'もんはんのえろほん9' WHERE book_id = 9;
UPDATE book SET book_name  = 'もんはんのえろほん10' WHERE book_id = 10;
UPDATE book SET book_name  = 'もんはんのえろほん11' WHERE book_id = 11;
UPDATE book SET book_name  = 'もんはんのえろほん12' WHERE book_id = 12;
UPDATE book SET book_name  = 'もんはんのえろほん13' WHERE book_id = 13;
UPDATE book SET book_name  = 'もんはんのえろほん14' WHERE book_id = 14;
UPDATE book SET book_name  = 'もんはんのえろほん外伝' WHERE book_id = 15;
UPDATE book SET forder_path  = '/エロ漫画/咲/nodoka/' WHERE book_id = 16;

SELECT
  c.category_id,
  c.category_name,
  g.genre_id,
  g.genre_name
FROM 
  category as c
LEFT JOIN
  genre as g
ON
  c.category_id = g.category_id
  

create database ero default character set utf8; 