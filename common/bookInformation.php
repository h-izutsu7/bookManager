<?php include_once 'Models/Book.php' ?>
<?php include_once 'Models/Category.php' ?>
<?php include_once 'Models/Genre.php' ?>
<?php include_once 'Models/Tag.php' ?>
<?php include_once 'Models/Author.php' ?>

<?php

/*----------------- bookテーブル関係 ----------------------*/

// 本情報取得
function getBook () {

  $qryBook = "SELECT * FROM book";

  return getQueryInfo($qryBook);
}

// book_idから本情報取得
function getBookToBookId ($bookId) {

  $sql = "SELECT * FROM book WHERE book_id = :book_id";

  $bindParams = [
    'book_id' => $bookId
  ];
  return getQueryInfo($sql, $bindParams);
}

//一番新しい本IDを取得
function getNewBookId() {

  $qry = "SELECT book_id FROM book ORDER BY book_id DESC LIMIT 1";

  return getQueryInfo($qry)[0]['book_id'];
}

// 本情報登録
function insertBook ($params) {

  $db = dbConnection();

  $sql = "INSERT INTO book (book_name, forder_path, html, thumbnail, del_flg) VALUES (:book_name, :forder_path, :html, :thumbnail, :del_flg)";
  $stmt = $db->prepare($sql);
  $bindParams = array(
    ':book_name' => $params['book_name'],
    ':forder_path' =>  $params['folder_path'],
    ':html' =>  $params['html'],
    ':thumbnail' => $params['thumbnail'],
    ':del_flg' => 0
  );
  $stmt->execute($bindParams);
}

// 本情報更新
function updateBook ($params, $bookId) {

  $db = dbConnection();

  $sql = "UPDATE book SET book_name = :book_name, forder_path = :forder_path, html = :html, thumbnail = :thumbnail, del_flg = :del_flg WHERE book_id = :book_id";
  $stmt = $db->prepare($sql);
  $bindParams = array(
    ':book_id' => $bookId,
    ':book_name' => $params['book_name'],
    ':forder_path' =>  $params['folder_path'],
    ':html' =>  $params['html'],
    ':thumbnail' => $params['thumbnail'],
    ':del_flg' => 0
  );
  $stmt->execute($bindParams);

  header('location: book_create.php?book_id=' . $bookId);exit();
}

// 本情報削除
function deleteBook ($bookId) {

  $db = dbConnection();
  //var_dump($bookId);exit;

  $sql = "DELETE FROM book WHERE book_id = :book_id";
  $stmt = $db->prepare($sql);
  $bindParams = array(
    ':book_id' => $bookId
  );
  $stmt->execute($bindParams);

  header('location: book_index.php');exit();
}
/*----------------- ctegoryテーブル関係 -------------------*/

// カテゴリー情報取得
function getCategory () {

  $db = dbConnection();

  $qry = "SELECT * FROM category";
  $result = $db->query($qry);

  while($row = $result->fetch(PDO::FETCH_ASSOC)){
    $categorys[]=$row;
  }
  $db = null;
  return $categorys;
}

// サイドメニュー情報取得
function getSideMenu () {

  $db = dbConnection();

  $qry ="
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
      c.category_id = g.category_id";

  $result = $db->query($qry);
  while($row3 = $result->fetch(PDO::FETCH_ASSOC)){
    $rows[]=$row3;
  }
  $db = null;
  return $rows;
}
/*----------------- genreテーブル関係 -------------------*/

// ジャンル情報取得
function getGenre () {

  $db = dbConnection();

  $qry = "SELECT * FROM genre";
  $result = $db->query($qry);

  while($row = $result->fetch(PDO::FETCH_ASSOC)){
    $categorys[]=$row;
  }

  $db = null;
  return $getGenre;
}

// カテゴリIDからジャンル情報取得
function getGenreToCategoryId ($categoryId) {

  $db = dbConnection();

  $qry = "SELECT * FROM genre Where category_id = :category_id";
  $stmt = $db->prepare($qry);
  $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_STR);

  // 実行
  $stmt->execute();

  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $getGenre[]=$row;
  }

  $db = null;
  return $getGenre;
}
/*----------------- book_listテーブル関係 -------------------*/

/**
 * 本情報・リストを取得
 *
 * @param  $params: パラメータ
 * @return $bookInfoList: 本情報・リスト
 */
function getBookInfoList ($params = false) {

  $sql =
  "SELECT
    bl.book_list_id,
    bl.book_id,
    bl.category_id,
    bl.genre_id,
    b.book_name,
    b.forder_path,
    b.thumbnail,
    b.html,
    c.category_name,
    g.genre_name,
    bl.del_flg
  FROM
    book_list as bl
  LEFT JOIN book as b ON bl.book_id = b.book_id
  LEFT JOIN category as c ON bl.category_id = c.category_id
  LEFT JOIN genre as g ON bl.genre_id = g.genre_id";

  list($where, $bindParams) = getBookInfoCondition($params);

  $sql .= $where;

  $bookInfoList = getQueryInfo($sql, $bindParams);

  return $bookInfoList;
}

/**
 * パラメータから情報・リスト条件を取得
 *
 * @param  $params: パラメータ
 * @return $where: 条件句
 * @return $bindParams: バインドパラメータ
 */
function getBookInfoCondition ($params) {

  $where = '';
  $bindParams = [];

  if ($params) {
    $where .= ' WHERE bl.del_flg = :del_flg';
    $bindParams['del_flg'] = 0;

    if (isset($params['category']) AND $params['category']) {
      $where .= ' AND c.category_name = :category_name';
      $bindParams['category_name'] = $params['category'];
    }
    if (isset($params['genre']) AND $params['genre']) {
      $where .= ' AND g.genre_name = :genre_name';
      $bindParams['genre_name'] = $params['genre'];
    }
    if (isset($params['book_id']) AND $params['book_id']) {
      $where .= ' AND b.book_id = :book_id';
      $bindParams['book_id'] = $params['book_id'];
    }
  }

  // var_dump($where, $bindParams);

  return array($where, $bindParams);
}















// カテゴリ、ジャンルから本リストを取得する
function getBookToCateGenreId($categoryName, $genreName) {

  $db = dbConnection();

  // 本情報取得
  $sql =
  "SELECT
  bl.book_list_id,
  bl.book_id,
  bl.category_id,
  bl.genre_id,
  b.book_name,
  b.forder_path,
  b.thumbnail,
  b.html,
  c.category_name,
  g.genre_name,
  bl.del_flg
FROM
  book_list as bl
LEFT JOIN book as b ON bl.book_id = b.book_id
LEFT JOIN category as c ON bl.category_id = c.category_id
LEFT JOIN genre as g ON bl.genre_id = g.genre_id
WHERE
  c.category_name = :category_name AND
  g.genre_name = :genre_name";

  $bindParams = [
    'category_name' => $categoryName,
    'genre_name' => $genreName
  ];

  $bookList =  getQueryInfo($sql, $bindParams);

  $db = null;

  return $bookList;
}

// 本情報リスト取得
function getBookListToBookId ($bookId) {

  $db = dbConnection();

  $qry = "SELECT * FROM book_list Where book_id = :book_id";
  $stmt = $db->prepare($qry);
  $stmt->bindParam(':book_id', $bookId, PDO::PARAM_STR);

  // 実行
  $stmt->execute();

  $result = $stmt->fetch(PDO::FETCH_ASSOC);

  $db = null;
  return $result;
}

// 本情報リスト登録
function insertBookList ($bookId, $params) {

  $db = dbConnection();

  $sql = "INSERT INTO book_list (book_id, category_id, genre_id) VALUES (:book_id, :category_id, :genre_id)";
  $stmt = $db->prepare($sql);
  $bindParams = array(
    ':book_id' => $bookId,
    ':category_id' =>  $params['category_id'],
    ':genre_id' =>  $params['genre_id'],
  );
  $stmt->execute($bindParams);
}

// 本情報更新
function updateBookList ($bookListId, $params) {

  $db = dbConnection();

  $sql = "UPDATE book_list SET category_id = :category_id, genre_id = :genre_id WHERE book_list_id = :book_list_id";
  $stmt = $db->prepare($sql);

  $stmt->bindParam(':book_list_id', $bookListId, PDO::PARAM_STR);
  $stmt->bindParam(':category_id', $params['category_id'], PDO::PARAM_STR);
  $stmt->bindParam(':genre_id', $params['genre_id'], PDO::PARAM_STR);

  $stmt->execute();
}

/*----------------- 共通処理 ----------------------*/


// ブックリスト整形
function getBookInfoListCustom($params = false) {

  $books = getBookInfoList($params);
  $bookInfoList = array();
  foreach ($books as $book) {

    if (!$book['html']) {
      $html = '/sisaku/imgList.php?book_id=' . $book['book_id'];
    } else {
      $html = $book['forder_path'] . $book['html'];
    }

    $bookInfoList[] = array(
      'book_list_id' => $book['book_list_id'],
      'book_id' => $book['book_id'],
      'book_name' => $book['book_name'],
      'thumbnail' => $book['forder_path'] . $book['thumbnail'],
      'folder_path' => $book['forder_path'],
      'html' => $html,
      'category_id' => $book['category_id'],
      'category_name' => $book['category_name'],
      'genre_id' => $book['genre_id'],
      'genre_name' => $book['genre_name']
    );
  }
  return $bookInfoList;
}

// サイドメニュー整形
function getSideMenyuList() {

  $categorys = getCategory();
  $genreCategorys = getSideMenu();
  $sideMenu = array();
  foreach ($categorys as $categoryKey => $category) {

    $sideMenu[$categoryKey]['category'] = $category['category_name'];

    $genre = array();
    foreach ($genreCategorys as $row) {
      if($category['category_id'] == $row['category_id']) {
        $genre[] = $row['genre_name'];
      }
    }
    $sideMenu[$categoryKey]['genre'] = $genre;
  }
  return $sideMenu;
}


// ディレクトリ内のIMGファイル取得
function getImgList($folderPath) {

  $dir = '..' . $folderPath;
  $files1 =  scandir($dir);

  $imgList = array();
  foreach ($files1 as $file) {
    if ( preg_match('/jpg/', $file) ) {
      $imgList[] = $folderPath . $file;
    }
  }
  return $imgList;
}

// ページャー用配列生成
function getPagerList($list, $pageNum, $displayNum) {

  $start = (($pageNum * $displayNum) - $displayNum );
  $end = $displayNum;
  $resultList = array_slice($list, $start, $end);
  return $resultList;

}

function dbConnection() {

  $dbname = "mysql:host=localhost;dbname=test;charset=utf8";
  $username = "root";
  $psword = "";
  $db = new PDO($dbname, $username, $psword);

  return $db;
}

function getQueryInfo ($query, $bindParams = false) {

  $db = dbConnection();

  if ($bindParams) {

    $result = $db->prepare($query);
    $result->execute($bindParams);
  } else {
    $result = $db->query($query);
  }

  while($row = $result->fetch(PDO::FETCH_ASSOC)){
    $queryInfo[]=$row;
  }
  $db = null;

  return (isset($queryInfo)) ? $queryInfo : '';
}

?>
