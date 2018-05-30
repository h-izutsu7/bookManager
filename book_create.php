<?php include_once 'common/bookInformation.php' ?>
<?php

/*---------- 初期値 ----------*/
$bookInfo = array (
  'book_id' => '',
  'book_name' => '無題',
  'folder_path' => '',
  'html' => '',
  'thumbnail' => '',
  'category_id' => '',
  'category_name' => '',
  'genre_id' => '',
  'genre_name' => '',
  'author_id' => 0,
  'tag1' => 0,
  'tag2' => 0,
  'tag3' => 0,
);
$imageUrl = 'images/no-image.png';

/*---------- 情報取得 ----------*/
$bookModels = new Book();
if ($_GET) {
  $bookInfo = $bookModels->getBook($_GET)[0];
  $imageUrl = $bookInfo['folder_path'] . $bookInfo['thumbnail'];
}

$categoryModels = new Category();
$sideMenu = $categoryModels->getSideMenyuList();
$categorys = $categoryModels->getCategory();
session_start();
$color = ( isset($_SESSION['color']) ) ? $_SESSION['color'] : '#FF69A3';

$tagModels = new Tag();
$authorModels = new Author();
// var_dump($tagModels->getTag(), $authorModels->getAuthor(), $bookInfo);

// $genreModels = new Genre();
// $genreModels->getGenreToCategoryId($bookInfo['category_id']);

/*---------- 登録/更新/削除処理 ----------*/

if ($_POST) {
  $params = $_POST;
  // var_dump($params);exit;
  // 削除処理
  if ($params['delete_flg']) {
    $bookModels->deleteBook($params['delete_flg']);
  }

  // 新規登録・更新処理
  if ($params['book_id']) {
    $bookModels->updateBook($params);
  } else {
    $bookModels->insertBook($params);
  }
}

?>
<!DOCTYPE>
<html>
  <head>
    <title>外部から読み込む</title>
    <meta charset="utf-8"/>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/common.js"></script>
    <script type="text/javascript" src="js/book_create.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/book_create.css">
  </head>
  <body>
    <div class="clealfix" id="container">
      <?php include_once 'common/header.php' ?>
      <?php include_once 'common/side_menu.php' ?>
      <div class="fl-l" id="main">
        <div id="img-title"><span id="img-title-txt">本情報登録</span></div>
        <form action="book_create.php" id="form" method="post">
        <div class="img-list book-update">
          <div class="clealfix">
            <div class="fl-l preview-box">
              <img src="<?php echo $imageUrl; ?>" id="preview-img">
              <p id="preview-title"><?php echo $bookInfo['book_name']; ?></p>
            </div>
            <div class="book-info-wrap fl-l">
              <div>
                <table class="information-table" cellspacing="10">
                  <tr>
                    <td>タイトル</td>
                    <td><input type="text" name="book_name" id="title" value="<?php echo $bookInfo['book_name']; ?>"></td>
                  </tr>
                  <tr>
                    <td>フォルダパス</td>
                    <td><input type="text" name="folder_path" id="folder_path" value="<?php echo $bookInfo['folder_path']; ?>"></td>
                  </tr>
                  <tr>
                    <td>サムネイル</td>
                    <td>
                      <input type="text" name="thumbnail" id="thumbnail" value="<?php echo $bookInfo['thumbnail']; ?>">
                      <img src="images/folder.png" title="参照" id="thumbnail-img">
                      <input type="file" id="thumnail-file" style="display: none;">
                    </td>
                  </tr>
                  <tr>
                    <td>HTML</td>
                    <td>
                      <input type="text" name="html" id="html" value="<?php echo $bookInfo['html']; ?>">
                      <img src="images/folder.png" title="参照" id="html-img">
                      <input type="file" id="html-file" style="display: none;">
                    </td>
                  </tr>
                  <tr>
                    <td>カテゴリ</td>
                    <td>
                      <select name="category_id" id="category">
                        <option value="">選択してください</option>
                        <?php foreach ($categorys as $category) : ?>

                          <?php if ($category['category_id'] == $bookInfo['category_id']) : ?>
                            <option value="<?php echo $category['category_id']; ?>" selected="true"><?php echo $category['category_name']; ?></option>
                          <?php else: ?>
                            <option value="<?php echo $category['category_id']; ?>" ><?php echo $category['category_name']; ?></option>
                          <?php endif; ?>

                        <?php endforeach; ?>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td>ジャンル</td>
                    <td>
                      <select name="genre_id" id="genre"><option value="">選択してください</option></select>
                      <input type="hidden" id="genre-select" value="<?php echo $bookInfo['genre_id']; ?>">
                    </td>
                  </tr>
                  <tr>
                    <td>作者</td>
                      <td>
                        <select name="author_id" id="author_id">
                          <?php foreach ($authorModels->getAuthor() as $author) : ?>
                            <?php if ($author['author_id'] == $bookInfo['author_id']) : ?>
                              <option value="<?php echo $author['author_id']; ?>" selected="true"><?php echo $author['author_name']; ?></option>
                            <?php else: ?>
                              <option value="<?php echo $author['author_id']; ?>" ><?php echo $author['author_name']; ?></option>
                            <?php endif; ?>
                          <?php endforeach; ?>
                        </select>
                      </td>
                  </tr>
                  <tr>
                    <td>タグ１</td>
                      <td>
                        <select name="tag1" id="tag1">
                          <?php foreach ($tagModels->getTag() as $tag) : ?>
                            <?php if ($tag['tag_id'] == $bookInfo['tag1']) : ?>
                              <option value="<?php echo $tag['tag_id']; ?>" selected="true"><?php echo $tag['tag_name']; ?></option>
                            <?php else: ?>
                              <option value="<?php echo $tag['tag_id']; ?>" ><?php echo $tag['tag_name']; ?></option>
                            <?php endif; ?>
                          <?php endforeach; ?>
                        </select>
                      </td>
                  </tr>
                  <tr>
                    <td>タグ２</td>
                    <td>
                      <select name="tag2" id="tag2">
                        <?php foreach ($tagModels->getTag() as $tag) : ?>
                          <?php if ($tag['tag_id'] == $bookInfo['tag2']) : ?>
                            <option value="<?php echo $tag['tag_id']; ?>" selected="true"><?php echo $tag['tag_name']; ?></option>
                          <?php else: ?>
                            <option value="<?php echo $tag['tag_id']; ?>" ><?php echo $tag['tag_name']; ?></option>
                          <?php endif; ?>
                        <?php endforeach; ?>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td>タグ３</td>
                    <td>
                      <select name="tag3" id="tag3">
                        <?php foreach ($tagModels->getTag() as $tag) : ?>
                          <?php if ($tag['tag_id'] == $bookInfo['tag3']) : ?>
                            <option value="<?php echo $tag['tag_id']; ?>" selected="true"><?php echo $tag['tag_name']; ?></option>
                          <?php else: ?>
                            <option value="<?php echo $tag['tag_id']; ?>" ><?php echo $tag['tag_name']; ?></option>
                          <?php endif; ?>
                        <?php endforeach; ?>
                      </select>
                    </td>
                  </tr>
                </table>
              </div>
              <input type="hidden" name="book_id" id="update_flg" value="<?php echo $bookInfo['book_id']; ?>">
              <input type="hidden" name="delete_flg" id="delete_flg" value="">
              <div class="button-wrap clealfix">
                <div class="fl-l"><input type="button" value="クリア" class="reset button google-btn"></div>
                <div class="fl-r"><input type="submit" value="登録" class="button google-btn" id="insert"></div>
                <div class="fl-r"><input type="button" value="削除" class="button google-btn" id="delete"></div>
              </div>
            </div>
          </form>
        </div>
      </div>

    </div>
  </body>
</html>
