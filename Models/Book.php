<?php include_once 'common/Base.php' ?>

<?php

class Book extends Base
{
    public function foo()
    {
        return $this->test();
    }

    // 本情報取得
    function getBook ($params = '') {

        $sql =
        "SELECT
          b.book_id,
          b.genre_id,
          b.category_id,
          b.author_id,
          b.tag1,
          b.tag2,
          b.tag3,
          c.category_name,
          g.genre_name,
          a.author_name,
          b.book_name,
          b.introduction,
          b.folder_path,
          b.thumbnail,
          b.html,
          b.del_flg
        FROM
          book as b
        LEFT JOIN category as c ON b.category_id = c.category_id
        LEFT JOIN genre as g ON b.genre_id = g.genre_id
        LEFT JOIN author as a ON b.author_id = a.author_id";

        list($where, $bindParams) = $this->getBookInfoCondition($params);

        $sql .= $where;

        // var_dump($sql);exit;

        $bookInfoList = $this->getQueryInfo($sql, $bindParams);

        return $bookInfoList;
    }

    /**
     * パラメータから情報・リスト条件を取得
     *
     * @param  $params: パラメータ
     * @return $where: 条件句
     * @return $bindParams: バインドパラメータ
     */
    function getBookInfoCondition ($params) {

        $where = ' WHERE b.del_flg = :del_flg';
        $bindParams = [];
        $bindParams['del_flg'] = 0;
        if ($params) {

          if (isset($params['category']) AND $params['category']) {
            $where .= ' AND c.category_name = :category_name';
            $bindParams['category_name'] = $params['category'];
          }
          if (isset($params['genre']) AND $params['genre']) {
            $where .= ' AND g.genre_name = :genre_name';
            $bindParams['genre_name'] = $params['genre'];
          }
          if (isset($params['book_id']) AND $params['book_id']) {
            $where .= ' AND b.book_id = :book_id';
            $bindParams['book_id'] = $params['book_id'];
          }
        }

        return array($where, $bindParams);
    }

    // 本情報を整形する
    function getBookInfoListCustom($books) {

        $bookInfoList = [];
        foreach ($books as $book) {

          if (!$book['html']) {
            $html = '/bookManager/imgList.php?book_id=' . $book['book_id'];
          } else {
            $html = $book['folder_path'] . $book['html'];
          }

          $bookInfoList[] = [
              'book_id' => $book['book_id'],
              'category_id' => $book['category_id'],
              'category_name' => $book['category_name'],
              'genre_id' => $book['genre_id'],
              'genre_name' => $book['genre_name'],
              'tag1' => $book['tag1'],
              'tag2' => $book['tag2'],
              'tag3' => $book['tag3'],
              'book_name' => $book['book_name'],
              'introduction' => $book['introduction'],
              'thumbnail' => $book['folder_path'] . $book['thumbnail'],
              'folder_path' => $book['folder_path'],
              'html' => $html,
          ];
      }
      return $bookInfoList;
    }

    // 本情報登録
    public function insertBook ($params) {

        $db = $this->dbConnection();

        $sql = "INSERT INTO book (book_id, category_id, genre_id, author_id, tag1, tag2, tag3, book_name, introduction, folder_path, html, thumbnail, del_flg)
        VALUES (:book_id, :category_id, :genre_id, :author_id, :tag1, :tag2, :tag3, :book_name, :introduction, :folder_path, :html, :thumbnail, :del_flg)";
        $genre = ($params['genre_id'] != '選択してください' AND  $params['genre_id']) ? $params['genre_id'] : 0;
        $stmt = $db->prepare($sql);
        $bindParams = [
            ':book_id' => $this->getNewBookId() + 1,
            ':category_id' => $params['category_id'],
            ':genre_id' => ($params['genre_id'] != '選択してください' AND  $params['genre_id']) ? $params['genre_id'] : 0,
            ':author_id' => $params['author_id'],
            ':tag1' => $params['tag1'],
            ':tag2' => $params['tag2'],
            ':tag3' => $params['tag3'],
            ':book_name' => $params['book_name'],
            ':introduction' => '',
            ':folder_path' =>  $params['folder_path'],
            ':html' =>  $params['html'],
            ':thumbnail' => $params['thumbnail'],
            ':del_flg' => 0
        ];
        $stmt->execute($bindParams);
    }

    // 本情報更新
    public function updateBook ($params) {

        $db = $this->dbConnection();
        // var_dump($params);exit;
        $sql = "UPDATE book SET book_id = :book_id,
                                category_id = :category_id,
                                genre_id = :genre_id,
                                author_id = :author_id,
                                tag1 = :tag1,
                                tag2 = :tag2,
                                tag3 = :tag3,
                                book_name = :book_name,
                                introduction = :introduction,
                                folder_path = :folder_path,
                                html = :html,
                                thumbnail = :thumbnail,
                                del_flg = :del_flg WHERE book_id = :book_id";
        $stmt = $db->prepare($sql);
        $bindParams = [
            ':book_id' => $params['book_id'],
            ':category_id' => $params['category_id'],
            ':genre_id' => ($params['genre_id'] != '選択してください' AND  $params['genre_id']) ? $params['genre_id'] : 0,
            ':author_id' => $params['author_id'],
            ':tag1' => $params['tag1'],
            ':tag2' => $params['tag2'],
            ':tag3' => $params['tag3'],
            ':book_name' => $params['book_name'],
            ':introduction' => '',
            ':folder_path' =>  $params['folder_path'],
            ':html' =>  $params['html'],
            ':thumbnail' => $params['thumbnail'],
            ':del_flg' => 0
        ];
        $result = $stmt->execute($bindParams);
        // var_dump($result);exit;
        header('location: book_create.php?book_id=' . $params['book_id']);exit();
    }

    // 本情報削除
    public function deleteBook ($bookId) {
        // var_dump($bookId);exit;
        $db = $this->dbConnection();

        $sql = "DELETE FROM book WHERE book_id = :book_id";
        $stmt = $db->prepare($sql);
        $bindParams = [':book_id' => $bookId];
        $stmt->execute($bindParams);

        header('location: book_index.php');exit();
    }

    // book_idから本情報取得
    //一番新しい本IDを取得
    public function getNewBookId() {

      $qry = "SELECT book_id FROM book ORDER BY book_id DESC LIMIT 1";

      return $this->getQueryInfo($qry)[0]['book_id'];
    }
}

?>
