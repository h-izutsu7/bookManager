<?php include_once 'common/bookInformation.php' ?>
<?php

/*---------- 初期値 ----------*/

$books = [
  'html' => '',
  'thumbnail' => '',
  'folder_path' => '',
  'book_id' => '',
  'book_name' => ''
];

/*---------- 情報取得 ----------*/

$bookModels = new Book();

// var_dump($bookModels->getBook());exit;

if ($_GET AND isset($_GET['category']) ) {
  $bookInfoList = getBookInfoListCustom($_GET);
} else {
  $bookInfoList = $bookModels->getBookInfoListCustom($bookModels->getBook());
}

$categoryModels = new Category();
$sideMenu = $categoryModels->getSideMenyuList();

// var_dump($sideMenu);exit;

/* ------------------ページャー---------------------- */
session_start();
if($_POST) {
  $_SESSION['display_num'] = intval($_POST['display_num']);
  $_SESSION['color'] = $_POST['color'];
}

$pageNum =  ( isset($_GET['page']) ) ? $_GET['page'] : 1;
$displayNum = ( isset($_SESSION['display_num']) ) ? $_SESSION['display_num'] : 10;
$color = ( isset($_SESSION['color']) ) ? $_SESSION['color'] : '#FF69A3';

$resultList = getPagerList($bookInfoList, $pageNum, $displayNum);

$countAll = count($bookInfoList);
$pageAll = ceil($countAll / $displayNum);
$displayNumList = [10, 20, 30, 40, 50];

$back = 0;
$next = 2;
$selectPage = 1;

if ($_GET AND isset($_GET['page'])) {
  if ( $_GET['page'] > $pageAll ) {
    header('Location: book_index.php');exit;
  }
  $back = $_GET['page'] - 1;
  $next = $_GET['page'] + 1;
  $selectPage = $_GET['page'];
}

/* ---------------------------------------- */

?>
<!DOCTYPE>
<html>
  <head>
    <title>BOOK管理システム</title>
    <meta charset="utf-8"/>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/common.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/book_index.css">
  </head>
  <body>
    <div class="clealfix" id="container">
      <?php include_once 'common/header.php' ?>
      <?php include_once 'common/side_menu.php' ?>
      <div class="fl-l" id="main">
        <div id="img-title"><span id="img-title-txt">タイトル</span></div>
        <form action="book_index.php" method="post" id="book_index-form">
        <div class="">
          検索結果:<?php echo $countAll; ?>件
          <select id="displayNum" name="display_num">
            <?php foreach ($displayNumList as $value): ?>
              <option value="<?php echo $value; ?>" <?php if ($value == $displayNum): ?>selected="true"<?php endif; ?>><?php echo $value; ?></option>
            <?php endforeach; ?>
          </select>
          <a href="book_create.php">新規作成</a>
          <span class="color-palette" style="background: #FF69A3;"></span>
          <span class="color-palette" style="background: #36c0e2;"></span>
          <span class="color-palette" style="background: rgb(56, 133, 23);"></span>
          <span class="color-palette" style="background: #e2d600;"></span>
          <input type="submit" value="変更" class="button google-btn">
          <input type="hidden" name="color" id="color-hidden" value="<?php echo $color; ?>">
        </div>
        <?php if($bookInfoList): ?>
          <?php include 'common/pager.php' ?>
          <div class="img-list bookList clealfix">
            <?php foreach ($resultList as $book) : ?>
              <div class="img-box fl-l">
                <a href="<?php echo $book['html']; ?>" target="_blank"><img src="<?php echo $book['thumbnail']; ?>"></a>
                <a href="/bookManager/book_create.php?book_id=<?php echo $book['book_id']; ?>"><span><?php echo $book['book_name']; ?></span></a>
              </div>
            <?php endforeach; ?>
          </div>
          <?php include 'common/pager.php' ?>
        <?php endif; ?>
        </form>
      </div>
    </div>
  </body>
</html>
