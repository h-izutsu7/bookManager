<?php include 'common/bookInformation.php' ?>

<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])
   && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
{

    // Ajaxリクエストの場合のみ処理する
    if (isset($_POST['request'])) {

      $categoryId = $_POST['request'];
      $genreModels = new Genre();
      $genres = $genreModels->getGenreToCategoryId($categoryId);

      echo json_encode($genres);

    } else {
        echo 'The parameter of "request" is not found.';
    }

    // Ajaxリクエストの場合のみ処理する
    if (isset($_POST['book_id'])) {

        $params = $_POST;
        $bookModels = new Book();
        $result = $bookModels->updateFavoFlg($params);

        echo $result;

    } else {
        echo '失敗';
    }
}
?>
