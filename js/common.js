$(document).ready(function(){

  $('.header').click(function(){
    location.href = '/bookManager/book_index.php';
  });

  //alert($('#header').height());
  var height = $('#body').height() - $('#header').height() -5;
  var sideHeight = $('#side_wrap').height() + $('#main_title').height();

  $('#body').height(height);
  // $('#side_wrap').height(sideHeight)

  // 画像比率
  // var resize = 1;
  // $('.box img').height($('.box img').height() * resize);
  // $('.box img').width($('.box img').width() * resize);

  // console.log(imgHeight, imgWidth);

  //画像ファイルプレビュー表示のイベント追加 fileを選択時に発火するイベントを登録
  $('#thumnail-file').change(function(e) {
    var file = e.target.files[0],
        reader = new FileReader(),
        $preview = $("#preview-img");
        t = this;

    // 画像ファイル以外の場合は何もしない
    if(file.type.indexOf("image") < 0){
      return false;
    }

    // ファイル読み込みが完了した際のイベント登録
    reader.onload = (function(file) {
      return function(e) {
        //既存のプレビューを削除
        $preview.empty();

        // .prevewの領域の中にロードした画像を表示するimageタグを追加
        $('#preview-img').prop('src', e.target.result);

        var regex = /\\|\\/;
        var imgPath = $('#thumnail-file').val();
        var imgPath = imgPath.split(regex);

        $('#thumbnail').val(imgPath[imgPath.length - 1]);

      };
    })(file);

    reader.readAsDataURL(file);
  });

  // タイトル名が変更されたとき
  $('#title').change(function(){
    var title = $('#title').val();

    $('#preview-title').html(title);
  });

  // フォルダ名が変更されたとき
  $('#folder_path').change(function(){
    var folderPath = $('#folder_path').val();

    var result = folderPath.replace(/\\/g, '/');
    console.log(result);

    $('#folder_path').val(result + '/');
  });

  // html名が変更されたとき
  $('#html-file').change(function(e) {

    var html = $('#html-file').val();
    var regex = /\\|\\/;
    var result = html.split(regex);
    $('#html').val(result[result.length - 1]);
  });

  // フォルダ画像をクリックしたとき
  $('#thumbnail-img').click(function(){
    $('#thumnail-file').click();
  });
  $('#html-img').click(function(){
    $('#html-file').click();
  });

  $('#category').change(function(){

    getGenreList();
  });

  // TOP表示セレクト数が変更されたとき
  $('#displayNum').change(function(){
    $('#book_index-form').submit();
  });

  // カラーパレットをクリックした時
  $('.color-palette').click(function(){

    var color = $(this).css('background');
    $('.header').css('background', color);
    $('label').css('background', color);
    $('#color-hidden').val(color);
  });

  getGenreList();
});

function getGenreList () {

   var categoryId = $('#category').val();
   var genreId = $('#genre-select').val();
   var option = '<option>選択してください</option>';

   if(categoryId) {
	   // POSTメソッドで送るデータを定義します var data = {パラメータ名 : 値};
	   var data = {'request' : categoryId};

	   $.ajax({
	     type: "POST",
	     url: "ajax.php",
	     data: data,
	   }).success(function(data, dataType) {
	    // successのブロック内は、Ajax通信が成功した場合に呼び出される

	     // PHPから返ってきたデータの表示
	     var genres = JSON.parse(data);
       console.log(genres);

	     $.each(genres, function(index, value) {

	       if( genreId == value['genre_id'] ) {
             option += '<option selected="true" value=' + value['genre_id'] + '>' + value['genre_name'] + '</option>';
           } else {
             option += '<option value=' + value['genre_id'] + '>' + value['genre_name'] + '</option>';
           }
         });
         $('#genre').html(option);
	   }).error(function(XMLHttpRequest, textStatus, errorThrown) {
	     // 通常はここでtextStatusやerrorThrownの値を見て処理を切り分けるか、単純に通信に失敗した際の処理を記述します。

	     // this;
	     // thisは他のコールバック関数同様にAJAX通信時のオプションを示します。

	     // エラーメッセージの表示
	     alert('Error : ' + errorThrown);
	   });
   }
   $('#genre').html(option);
   $('#genre-select').val('');
}
