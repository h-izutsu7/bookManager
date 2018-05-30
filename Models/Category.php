<?php include_once 'common/Base.php' ?>

<?php

class Category extends Base
{
    // カテゴリー情報取得
    function getCategory () {

        $qry = "SELECT * FROM category";
        
        return $this->getQueryInfo($qry);
    }

    // サイドメニュー情報取得
    function getSideMenu () {

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

        return $this->getQueryInfo($qry);;
    }

    // サイドメニュー整形
    function getSideMenyuList() {

        $categorys = $this->getCategory();
        $genreCategorys = $this->getSideMenu();
        $sideMenu = [];
        foreach ($categorys as $categoryKey => $category) {

            $sideMenu[$categoryKey]['category'] = $category['category_name'];

            $genre = [];
            foreach ($genreCategorys as $row) {
                if($category['category_id'] == $row['category_id']) {
                  $genre[] = $row['genre_name'];
                }
            }
            $sideMenu[$categoryKey]['genre'] = $genre;
        }
        return $sideMenu;
    }
}
