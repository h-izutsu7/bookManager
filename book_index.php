<?php include_once 'common/bookInformation.php' ?>
<?php

/*---------- 情報取得 ----------*/

$bookModels = new Book();

if ($_GET && (isset($_GET['category']) || isset($_GET['favo'])) ) {
  $bookInfoList = $bookModels->getBook($_GET);
} else {
  $bookInfoList = $bookModels->getBook();
}
$bookInfoList = $bookInfoList ? $bookModels->getBookInfoListCustom($bookInfoList) : [];

$categoryModels = new Category();
$sideMenu = $categoryModels->getSideMenyuList();

/* ------------------ページャー---------------------- */
session_start();
if($_POST) {
  $_SESSION['display_num'] = intval($_POST['display_num']);
  // $_SESSION['color'] = $_POST['color'];
}

$pageNum =  ( isset($_GET['page']) ) ? $_GET['page'] : 1;
$displayNum = ( isset($_SESSION['display_num']) ) ? $_SESSION['display_num'] : 24;
$color = ( isset($_SESSION['color']) ) ? $_SESSION['color'] : '#FF69A3';

$resultList = getPagerList($bookInfoList, $pageNum, $displayNum);

$countAll = count($bookInfoList);
$pageAll = ceil($countAll / $displayNum);
$displayNumList = [12, 24, 36, 48, 60];

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

// var_dump($resultList);exit;

/* ---------------------------------------- */

?>
<!DOCTYPE>
<html>
<head>
    <title>新デザイン</title>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="NewDesign/NewDesign.js"></script>
    <link rel="stylesheet" type="text/css" href="NewDesign/NewDesign.css">
</head>
<body>
    <form action="book_index.php" method="post" id="book_index-form">
      <div id="contents">
          <div id="header"><span>BOOK管理機能</span></div>
          <div id="body" class="clearfix">
              <?php include 'common/side_menu.php' ?>
              <div id="main_wrap">
                  <div id="main">
                      <div id="main_title" class="clearfix">
                          <div><span>タイトル</span></div>
                          <div>
                              <select id="displayNum" name="display_num">
                                <?php foreach ($displayNumList as $value): ?>
                                  <option value="<?php echo $value; ?>" <?php if ($value == $displayNum): ?>selected="true"<?php endif; ?>><?php echo $value; ?></option>
                                <?php endforeach; ?>
                              </select>
                              <input type="text" placeholder="検索">
                              <input type="button" value="検索">
                          </div>
                      </div>
                      <div id="main_box_wrap">
                          <?php include 'common/pager.php' ?>
                          <div id="main_box" class="clearfix">
                              <?php foreach ($resultList as $book) : ?>
                                  <div class="box">
                                    <a href="<?php echo $book['html']; ?>" target="_blank"><img src="<?php echo $book['thumbnail']; ?>"></a>
                                    <a href="/bookManager/book_create.php?book_id=<?php echo $book['book_id']; ?>"><p><?php echo $book['book_name']; ?></p></a>
                                    <img class="favo" id="book_id<?php echo $book['book_id']; ?>" src="<?php if ($book['favo_flg']): ?>images/favo-ok.png<?php else: ?>images/favo-no.png<?php endif; ?>">
                                  </div>
                              <?php endforeach; ?>
                          </div>
                          <?php include 'common/pager.php' ?>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </form>
</body>
</html>
