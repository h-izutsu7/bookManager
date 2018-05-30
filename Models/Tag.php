<?php include_once 'common/Base.php' ?>

<?php

class Tag extends Base
{
    // カテゴリー情報取得
    function getTag () {

        $qry = "SELECT * FROM tag";

        return $this->getQueryInfo($qry);
    }
}

?>
