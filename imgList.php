<?php include 'common/bookInformation.php' ?>
<?php

if ($_GET['book_id']) {
  $bookModels = new Book();
  $bookInfo = $bookModels->getBook($_GET);
  $imgList = getImgList($bookInfo[0]['folder_path']);
}

?>
<!DOCTYPE>
<html>
  <head>
    <title>外部から読み込む</title>
    <meta charset="utf-8"/>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/common.js"></script>
  </head>
<style>
.two-column {
  float : right;
}
img{
  width: 760px;
  height: auto;
}
</style>
<body>
<bdo dir="rtl">
<ul class="two-column">
  <?php foreach ($imgList as $img) : ?>
    <a href="<?php echo $img; ?>" target="_blank"><img src="<?php echo $img; ?>" alt="" /></a>
  <?php endforeach; ?>
</ul>
</bdo>
</body>
</html>
