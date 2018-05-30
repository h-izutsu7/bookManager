<?php include_once 'common/Base.php' ?>

<?php

class Genre extends Base
{
    // カテゴリIDからジャンル情報取得
    public function getGenreToCategoryId ($categoryId) {

        $qry = "SELECT * FROM genre Where category_id = :category_id";

        $bindParams = ['category_id' => $categoryId];

        $genre = $this->getQueryInfo($qry, $bindParams);

        return $genre;
    }
}
