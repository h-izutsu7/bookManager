<?php include_once 'common/Base.php' ?>

<?php

class Author extends Base
{
    // カテゴリー情報取得
    function getAuthor () {

        $qry = "SELECT * FROM author";

        return $this->getQueryInfo($qry);
    }
}

?>
