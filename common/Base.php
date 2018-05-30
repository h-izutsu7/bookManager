<?php

class Base
{
    protected function test() {
        return 'test';
    }

    // DB接続処理
    public function dbConnection() {

        $dbname = "mysql:host=localhost;dbname=bookManager;charset=utf8";
        $username = "root";
        $psword = "";
        $db = new PDO($dbname, $username, $psword);

        return $db;
    }

    public function getQueryInfo ($query, $bindParams = false) {

        $db = $this->dbConnection();

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
}

 ?>
